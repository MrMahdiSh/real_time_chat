<?php

namespace Modules\Doctor\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\State\Entities\City;
use Modules\State\Entities\State;

class DoctorContact extends Model
{
    protected $guarded = [];

    protected $table = 'doctor_contactss';

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
