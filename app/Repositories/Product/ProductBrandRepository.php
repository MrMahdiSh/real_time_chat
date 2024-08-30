<?php


namespace App\Repositories\Product;


use App\Interfaces\IBaseRepositoryInterface;
use App\Repositories\BaseRepository;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductBrand;

class ProductBrandRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(ProductBrand $model)
    {
        parent::__construct($model);
    }

}
