<?php


namespace App\Repositories;


use App\Interfaces\IBaseRepositoryInterface;
use Modules\Article\Entities\Article;
use Modules\Special\Entities\Special;

class SpecialRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(Special $user)
    {
        parent::__construct($user);
    }

}
