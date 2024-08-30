<?php


namespace App\Repositories\Service;


use App\Interfaces\IBaseRepositoryInterface;
use App\Repositories\BaseRepository;
use Modules\Service\Entities\ServiceCategory;
use Modules\Service\Entities\ServiceReserve;

class ServiceReserveRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(ServiceReserve $model)
    {
        parent::__construct($model);
    }

    public function UpdateOrder($order_id, $status)
    {
        $order = $this->model->find($order_id);
        return $order->update(['status' => $status]);
    }
}
