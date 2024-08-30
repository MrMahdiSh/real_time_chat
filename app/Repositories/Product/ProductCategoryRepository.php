<?php


namespace App\Repositories\Product;



use App\Interfaces\IBaseRepositoryInterface;
use App\Repositories\BaseRepository;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;

class ProductCategoryRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(ProductCategory $model)
    {
        parent::__construct($model);
    }

}
