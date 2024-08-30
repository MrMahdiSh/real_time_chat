<?php


namespace App\Repositories\Product;


use App\Interfaces\IBaseRepositoryInterface;
use App\Repositories\BaseRepository;
use Modules\Product\Entities\Product;

class ProductRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

}
