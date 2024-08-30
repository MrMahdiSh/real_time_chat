<?php


namespace App\Repositories;


use App\Interfaces\IBaseRepositoryInterface;
use Modules\Article\Entities\Article;
use Modules\Doctor\Entities\Doctor;
use Modules\Page\Entities\Page;
use Modules\Setting\Entities\Setting;
use PhpParser\Comment\Doc;

class DoctorRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(Doctor $setting)
    {
        parent::__construct($setting);
    }

    public function GetProducts($user_id)
    {
        $item = $this->model->with('products')->find($user_id);

        return $item->products;
    }
}
