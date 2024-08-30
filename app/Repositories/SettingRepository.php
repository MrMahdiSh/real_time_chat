<?php


namespace App\Repositories;


use App\Interfaces\IBaseRepositoryInterface;
use Modules\Article\Entities\Article;
use Modules\Setting\Entities\Setting;

class SettingRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(Setting $setting)
    {
        parent::__construct($setting);
    }

}
