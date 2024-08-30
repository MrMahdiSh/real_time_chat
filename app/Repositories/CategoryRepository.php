<?php


namespace App\Repositories;


use App\Interfaces\IBaseRepositoryInterface;
use Modules\Article\Entities\Article;
use Modules\Category\Entities\Category;

class CategoryRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(Category $user)
    {
        parent::__construct($user);
    }

}
