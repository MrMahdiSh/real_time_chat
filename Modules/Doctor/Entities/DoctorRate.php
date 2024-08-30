<?php

namespace Modules\Doctor\Entities;

use App\Helper\Core;
use Illuminate\Database\Eloquent\Model;
use Modules\Patient\Entities\Patient;

class DoctorRate extends Model
{
    protected $guarded = [];


    public function patient()
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id')->with('media');

    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'id', 'doc_id')->with('media');

    }

    public function getFaDateAttribute(): string
    {

        return Core::persianDate($this->created_at, false);

    }

    public function getFaDateDocAttribute(): string
    {
        return Core::persianDate($this->updated_at, false);
    }
}
