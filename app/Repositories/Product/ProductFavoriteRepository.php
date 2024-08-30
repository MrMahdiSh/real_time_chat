<?php


namespace App\Repositories\Product;


use App\Interfaces\IBaseRepositoryInterface;
use App\Repositories\BaseRepository;
use Modules\Product\Entities\ProductFavorite;

class ProductFavoriteRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(ProductFavorite $model)
    {
        parent::__construct($model);
    }


    public function AddProduct($params)
    {
        return $this->model->updateOrCreate($params);
    }

    public function RemoveProduct($params)
    {
        return $this->model->where($params)->delete();
    }
}
