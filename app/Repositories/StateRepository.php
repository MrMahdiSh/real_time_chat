<?php


namespace App\Repositories;


use App\Interfaces\IBaseRepositoryInterface;
use Modules\State\Entities\State;

class StateRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(State $model)
    {
        parent::__construct($model);
    }
}
