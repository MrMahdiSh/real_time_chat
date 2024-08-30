<?php

namespace Modules\Article\Entities;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $guarded = [];


    public function posts()
    {

        return $this->hasMany(Article::class, 'category_id', 'id')->where('status', '1');

    }
}
