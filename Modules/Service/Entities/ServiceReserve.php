<?php

namespace Modules\Service\Entities;

use App\Helper\Core;
use Illuminate\Database\Eloquent\Model;
use Modules\Doctor\Entities\Doctor;
use Modules\Doctor\Entities\DoctorSetting;
use Modules\Patient\Entities\Patient;

class ServiceReserve extends Model
{
    protected $guarded = [];


    public function service()
    {

        return $this->hasOne(ServiceModel::class, 'id', 'service_id')->with('doctor');

    }

    public function doctor()
    {
        $item = $this->service->doctor();
        return $item ? $item : '';
    }


    public function patient()
    {

        return $this->hasOne(Patient::class, 'id', 'patient_id');

    }


    public function getLastPriceAttribute()
    {
        $tax = 0;
        $price = $this->price;
        $temp = ($price / 100) * $tax;
        return $price;
    }

    public function getResDateAttribute()
    {
        $date = Core::ArticleDate($this->date, false);
        return $date . ' ساعت ' . $this->time;
    }

    public function getFaCreatedAtAttribute()
    {

        return Core::ArticleDate($this->created_at, false);

    }

    public function getResDateArrAttribute()
    {
        $date = Core::ArticleDate($this->date, false);
        $time = $this->time;
        return array($date, $time);
    }
}
