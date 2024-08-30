<?php


namespace App\Repositories\Product;


use App\Interfaces\IBaseRepositoryInterface;
use App\Interfaces\ICardRepository;
use App\PaymentType;
use App\Repositories\BaseRepository;
use App\Repositories\ProfitAdminRepository;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Card;
use Modules\Product\Entities\Product;

class CardRepository implements ICardRepository
{

    protected $model;
    protected $product;
    protected $profitAdminRepository;

    public function __construct(Card $model, ProductRepository $product, profitAdminRepository $profitAdminRepository)
    {
        $this->model = $model;
        $this->product = $product;
        $this->profitAdminRepository = $profitAdminRepository;
    }


    public function RemoveBasket($user_id, $transaction = null)
    {
        $data = $this->model->where('user_id', $user_id);
        $delete = $this->model->where('user_id', $user_id);

        foreach ($data->get() as $item) {


            $product = $this->product->getById($item->product_id);

            if (isset($transaction)) {
                $this->profitAdminRepository->DoctorProfit($product->doctor_id, $product->offer_price, PaymentType::ADDProduct);
            }

            $count = (int)$product->count;
            $count = $count - (int)$item->count;
            $this->product->update($item->product_id, ['count' => $count]);
        }

        $delete->
        delete();
    }

    public function AddToBasket($user_id, $product_id, $count = 1)
    {

        $product = $this->product->getById($product_id);
        $item = $this->model
            ->updateOrCreate(
                ['user_id' => $user_id, 'product_id' => $product_id],
                ['user_id' => $user_id, 'product_id' => $product_id]
            );


        $countCard = (int)$item->count + $count;

        if ($countCard <= (int)$product->count) {
            return $item->update(['count' => $countCard]);
        }
        return null;
    }

    public function RemoveFromBasket($user_id, $product_id, $count = 1)
    {

        $item = $this->model->where(['user_id' => $user_id, 'product_id' => $product_id])->first();

        $countCard = (int)$item->count - $count;
        $item->update(['count' => $countCard]);


        if ((int)$countCard < 1)
            return $item->delete();


        return true;
    }

    public function GetBasket($user_id)
    {
        return $this->model->where(['user_id' => $user_id]);
    }
}
