<?php

namespace Modules\Clinic\Entities;

use App\Media;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $guarded = [];

    protected $table = 'clinincs';

    public function gallery()
    {
        return $this->hasMany(Media::class, 'media_id', 'id')->where('media_title', 'ClinicGallery');
    }
}
