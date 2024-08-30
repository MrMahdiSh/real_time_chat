<?php


namespace App\Repositories\Product  ;




use App\Interfaces\IBaseRepositoryInterface;
use App\Repositories\BaseRepository;
use Modules\Product\Entities\ProductSetting;

class ProductSettingRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(ProductSetting $model)
    {
        parent::__construct($model);
    }
}
