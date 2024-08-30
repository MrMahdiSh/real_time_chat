<?php

namespace Modules\Page\Entities;

use App\Helper\Core;
use App\Media;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    public function GetDateAttribute(): string
    {
        return   Core::ArticleDate($this->created_at, false);


    }

    public function media()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'Pages');
    }
}
