<?php


namespace App\Repositories\Service;


use App\Interfaces\IBaseRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Status;
use Modules\Service\Entities\ServiceCategory;
use Modules\Service\Entities\ServiceModel;

class ServiceModelRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(ServiceModel $model)
    {
        parent::__construct($model);
    }

    public function getPaginate($paginate = 20)
    {
        return $this->model->where('status', Status::True);
    }
}
