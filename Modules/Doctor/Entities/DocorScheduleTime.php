<?php

namespace Modules\Doctor\Entities;

use App\Helper\Core;
use Illuminate\Database\Eloquent\Model;

class DocorScheduleTime extends Model
{
    protected $guarded = [];

    public function getSTimeAttribute()
    {
        return Core::calculate_time($this->begin_time);

    }

    public function getETimeAttribute()
    {
        return Core::calculate_time($this->end_time);

    }

}
