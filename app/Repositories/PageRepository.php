<?php


namespace App\Repositories;


use App\Interfaces\IBaseRepositoryInterface;
use Modules\Article\Entities\Article;
use Modules\Page\Entities\Page;
use Modules\Setting\Entities\Setting;

class PageRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(Page $setting)
    {
        parent::__construct($setting);
    }

}
