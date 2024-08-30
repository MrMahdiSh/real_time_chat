<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Doctor\Entities\Doctor;

class OrderProductDetail extends Model
{
    protected $guarded = [];

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');
    }

    public function order()
    {
        return $this->hasOne(OrderProduct::class, 'id', 'order_id');
    }
}
