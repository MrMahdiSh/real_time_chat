<?php

namespace Modules\Doctor\Entities;

use App\Media;
use Illuminate\Database\Eloquent\Model;

class DoctorSetting extends Model
{
    protected $guarded = [];

    protected $table = 'doctor_settings';


    public function media()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'DoctorFactorMedia');
    }

}
