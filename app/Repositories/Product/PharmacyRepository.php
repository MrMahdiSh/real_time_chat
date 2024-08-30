<?php


namespace App\Repositories\Product;


use App\Interfaces\IBaseRepositoryInterface;
use App\Repositories\BaseRepository;
use Modules\Product\Entities\Pharmacy;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;

class PharmacyRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(Pharmacy $model)
    {
        parent::__construct($model);
    }

}
