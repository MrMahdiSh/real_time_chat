<?php

namespace Modules\Article\Entities;

use App\Helper\Core;
use App\Media;
use Illuminate\Database\Eloquent\Model;
use Modules\Doctor\Entities\Doctor;
use Modules\Team\Entities\Team;

class Article extends Model
{
    protected $guarded = [];

    public function getTagTextAttribute()
    {
        $text = null;
        $tags = json_decode($this->tags);
        foreach ($tags as $val) {
            $item = ArticleTag::find($val);

            if (isset($item)) {

                $text .= $item->title . ' | ';
            }
        }
        return $text;
    }


    public function getFaDateAttribute()
    {
        return Core::ArticleDate($this->created_at, false);
    }

    public function user()
    {
        return $this->hasOne(Team::class, 'id', 'writer_id')->select('name', 'degree', 'id');
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'id', 'writer_id');
    }

    public function category()
    {
        return $this->hasOne(ArticleCategory::class, 'id', 'category_id');
    }

    public function comments()
    {
        return $this->hasOne(ArticleComment::class, 'blog_id', 'id')->where('status', '1');
    }

    public function all_comments()
    {
        return $this->hasOne(ArticleComment::class, 'blog_id', 'id');
    }

    public function media()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'Article');
    }
}
