<?php

namespace Modules\Doctor\Entities;

use Illuminate\Database\Eloquent\Model;

class DoctorAccount extends Model
{
    protected $guarded = [];

    public function getDetailAttribute()
    {
        return "$this->name ---  $this->number -- $this->bank_name";
    }

}
