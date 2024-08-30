<?php


namespace App\Repositories\Service;


use App\Interfaces\IBaseRepositoryInterface;
use App\Repositories\BaseRepository;
use Modules\Service\Entities\ServiceCategory;
use Modules\Service\Entities\ServiceModel;
use Modules\Service\Entities\ServiceSetting;

class ServiceSettingRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(ServiceSetting $model)
    {
        parent::__construct($model);
    }

}
