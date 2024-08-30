<?php

namespace Modules\Special\Entities;

use App\Media;
use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
    protected $guarded = [];

    public function media()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'Special');
    }
}
