<?php


namespace App\Repositories;


use App\Interfaces\IBaseRepositoryInterface;
use Modules\State\Entities\City;
use Modules\State\Entities\State;

class CityRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(City $model)
    {
        parent::__construct($model);
    }
}
