<?php


namespace App\Repositories\Service;


use App\Interfaces\IBaseRepositoryInterface;
use App\Repositories\BaseRepository;
use Modules\Service\Entities\ServiceCategory;

class ServiceCategoryRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(ServiceCategory $model)
    {
        parent::__construct($model);
    }

    public function GetCategories()
    {
        return $this->Get()->where('parent_id', '<>', 0)->has('parent');
    }
}
