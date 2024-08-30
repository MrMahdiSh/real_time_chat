<?php

namespace Modules\Doctor\Entities;

use App\Helper\Core;
use Illuminate\Database\Eloquent\Model;
use Modules\Patient\Entities\Patient;

class Chat extends Model
{
    protected $guarded = [];

    public function doctor()
    {

        return $this->hasOne(Doctor::class, 'id', 'doc_id');

    }

    public function patient()
    {

        return $this->hasOne(Patient::class, 'id', 'patient_id');

    }


    public function getFaCreatedAtAttribute()
    {

        return explode(',', Core::ChatDate($this->created_at, false));

    }
}
