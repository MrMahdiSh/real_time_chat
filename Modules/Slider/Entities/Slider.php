<?php

namespace Modules\Slider\Entities;

use App\Media;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $guarded = [];

    public function media()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'Slider');
    }
}
