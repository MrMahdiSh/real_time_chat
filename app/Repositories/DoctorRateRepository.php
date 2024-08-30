<?php


namespace App\Repositories;


use App\Interfaces\IBaseRepositoryInterface;
use Modules\Article\Entities\Article;
use Modules\Category\Entities\Category;
use Modules\Doctor\Entities\DoctorRate;

class DoctorRateRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(DoctorRate $model)
    {
        parent::__construct($model);
    }

}
