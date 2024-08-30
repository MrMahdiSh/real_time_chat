<?php


namespace App\Repositories\Service;




use App\Interfaces\IBaseRepositoryInterface;
use App\Repositories\BaseRepository;
use Modules\Service\Entities\ServiceRate;
use Modules\Service\Entities\ServiceReserve;

class ServiceOrderRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(ServiceReserve $model)
    {
        parent::__construct($model);
    }

}
