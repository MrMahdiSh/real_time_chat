<?php


namespace App\Repositories;


use App\Interfaces\IBaseRepositoryInterface;
use Modules\Article\Entities\Article;

class ArticleRepository extends BaseRepository implements IBaseRepositoryInterface
{
    public function __construct(Article $user)
    {
        parent::__construct($user);
    }

}
