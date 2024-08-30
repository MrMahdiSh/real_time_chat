<?php

namespace Modules\Advertise\Entities;

use App\Media;
use Illuminate\Database\Eloquent\Model;

class AdvertisePage extends Model
{
    protected $guarded = [];

    public function media()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'AdvertisePage');
    }

}
