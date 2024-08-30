<?php


namespace App\Repositories\Product;


use App\Interfaces\IBaseRepositoryInterface;
use App\Interfaces\ICardRepository;
use App\Interfaces\IOrderRepository;
use App\OrderStatus;
use App\Repositories\BaseRepository;
use App\Repositories\PatientRepository;
use App\Status;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Card;
use Modules\Product\Entities\OrderProduct;
use Modules\Product\Entities\OrderProductDetail;
use Modules\Product\Entities\Product;
use mysql_xdevapi\Exception;

class OrderRepository  extends  BaseRepository implements IOrderRepository
{

    protected $orderProduct;
    protected $orderProductDetail;
    protected $card;
    protected $patient;

    public function __construct(OrderProduct $orderProduct, OrderProductDetail $orderProductDetail, CardRepository $card, PatientRepository $patient)
    {
        $this->orderProduct = $orderProduct;
        $this->orderProductDetail = $orderProductDetail;
        $this->card = $card;
        $this->patient = $patient;
        parent::__construct($orderProduct);

    }


    public function AddOrder($user_id, $detail_user)
    {
        try {
            $user = $this->patient->getById($user_id);

            if ($user->TotalPriceProduct() < 1000)
                return Status::False;

            $order_product_data = [
                'client_id' => $user_id,
                'number' => rand(1111, 99999),
                'price' => $user->TotalPriceProduct(),
                'address' => $detail_user,
                'status' => OrderStatus::Unpaid,
            ];
            $order = $this->orderProduct->create($order_product_data);
            $basket = $this->card->GetBasket($user_id)->get();
            foreach ($basket as $item) {
                if ($item->product) {
                    $product = $item->product;
                    $order_detail = [
                        'title' => $product->title,
                        'order_id' => $order->id,
                        'doctor_id' => $product->doctor_id,
                        'product_id' => $product->id,
                        'price' => $product->offer_price,
                        'count' => $item->count,
                        'description' => '<hr> سایز ' . $product->size . '<hr> ساخت کشور ' . $product->country . '  <hr>  شناسه ' . $product->number
                    ];
                    $this->orderProductDetail->create($order_detail);
                }
            }
            return $order;
        } catch (Exception $e) {
            return Status::False;
        }

    }

    public function UpdateOrder($order_id, $status)
    {
        $order = $this->orderProduct->find($order_id);
        return $order->update(['status' => $status]);
    }

    public function GetUserOrders($user_id)
    {
        return $this->orderProduct->where('client_id', $user_id)->with('detail')->orderBy('updated_at', 'desc');
    }

    public function GetAllOrder()
    {
        return $this->orderProduct->with('detail')->orderBy('updated_at', 'desc');

    }
}
