<?php

namespace Modules\Product\Entities;

use App\Helper\Core;
use Illuminate\Database\Eloquent\Model;
use Modules\Doctor\Entities\Doctor;

class CertificatePharmacy extends Model
{
    protected $guarded = [];

    public function getFaCreatedAtAttribute()
    {
        return Core::persianDate($this->created_at, false);

    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');
    }

    public function pharmacy()
    {
        return $this->hasOne(Pharmacy::class, 'id', 'p_id')->with('city');
    }





}
