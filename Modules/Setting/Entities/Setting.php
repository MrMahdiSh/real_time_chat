<?php

namespace Modules\Setting\Entities;

use App\Media;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];

    public function logo()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'LOGO');
    }

    public function about()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'About');
    }
}
