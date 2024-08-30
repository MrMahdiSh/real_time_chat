<?php

namespace Modules\Service\Entities;

use App\Helper\Core;
use Illuminate\Database\Eloquent\Model;
use Modules\Doctor\Entities\Doctor;
use Modules\Patient\Entities\Patient;

class ServiceRate extends Model
{

    protected $table = 'service_rates';
    protected $guarded = [];

    public function patient()
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }

    public function service()
    {
        return $this->hasOne(ServiceModel::class, 'id', 'service_id');
    }

    public function getFaCreatedAtAttribute()
    {
        return Core::persianDate($this->created_at, false);
    }
}
