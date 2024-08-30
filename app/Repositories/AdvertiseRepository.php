<?php


namespace App\Repositories;


use App\Interfaces\IBaseRepositoryInterface;
use Modules\Advertise\Entities\Advertise;
use Modules\Advertise\Entities\AdvertisePage;
use Modules\Article\Entities\Article;
use Modules\Page\Entities\Page;
use Modules\Setting\Entities\Setting;

class  AdvertiseRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(Advertise $model)
    {
        parent::__construct($model);
    }

}
