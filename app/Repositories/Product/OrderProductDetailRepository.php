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

class OrderProductDetailRepository extends BaseRepository
{

    protected $orderProductDetail;


    public function __construct(OrderProductDetail $orderProductDetail)
    {
        $this->orderProductDetail = $orderProductDetail;
        parent::__construct($orderProductDetail);
    }


}
