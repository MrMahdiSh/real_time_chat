<?php


namespace App\Repositories\Service;




use App\Interfaces\IBaseRepositoryInterface;
use App\Repositories\BaseRepository;
use Modules\Service\Entities\ServiceRate;

class ServiceRateRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(ServiceRate $model)
    {
        parent::__construct($model);
    }

}
