<?php

namespace Modules\Article\Entities;

use App\Helper\Core;
use Illuminate\Database\Eloquent\Model;
use Modules\Patient\Entities\Patient;

class ArticleComment extends Model
{
    protected $guarded = [];

    public function getFaDateAttribute()
    {
        return Core::persianDate($this->created_at, false);
    }

    public function getFaDate2Attribute()
    {
        return Core::persianDate($this->updated_at, false);
    }

    public function article()
    {

        return $this->hasOne(Article::class, 'id', 'blog_id');

    }

    public function user()
    {

        return $this->hasOne(Patient::class, 'id', 'user_id');

    }
}
