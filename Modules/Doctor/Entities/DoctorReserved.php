<?php

namespace Modules\Doctor\Entities;

use App\Helper\Core;
use Illuminate\Database\Eloquent\Model;
use Modules\Patient\Entities\Patient;

class DoctorReserved extends Model
{
    protected $guarded = [];


    public function getLastPriceAttribute()
    {

        $tax = $this->setting_pay() ? $this->setting_pay->tax_price : 0;
        $price = $this->price;


        $temp = ($price / 100) * $tax;
        return $price ;
      //  return $price + $temp;
    }

    public function setting_pay()
    {
        return $this->hasOne(DoctorSetting::class, 'doc_id', 'user_id');

    }

    public function doctor()
    {

        return $this->hasOne(Doctor::class, 'id', 'user_id');

    }


    public function patient()
    {

        return $this->hasOne(Patient::class, 'id', 'client_id');

    }


    public function getFaCreatedAtAttribute()
    {

        return Core::ArticleDate($this->created_at, false);

    }


    public function getStAttribute()
    {

        return Core::status_reserve($this->status);

    }

    public function getResDateAttribute()
    {
        $date = Core::ArticleDate($this->date, false);
        return $date . ' ساعت ' . $this->time;
    }

    public function getResDateArrAttribute(): array
    {
        $date = Core::ArticleDate($this->date, false);
        $time = $this->time;
        return array($date,$time);
    }
}
