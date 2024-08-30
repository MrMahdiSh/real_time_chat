<?php


namespace App\Repositories;


use App\Interfaces\IBaseRepositoryInterface;
use Modules\Advertise\Entities\AdvertisePage;
use Modules\Article\Entities\Article;
use Modules\Page\Entities\Page;
use Modules\Setting\Entities\Setting;

class AdvertisePageRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(AdvertisePage $model)
    {
        parent::__construct($model);
    }

}
