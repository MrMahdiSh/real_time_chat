<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Doctor\Entities\Doctor;
use Modules\Doctor\Entities\FavoriteDoctor;

class OrderProduct extends Model
{
    protected $guarded = [];

    public function detail()
    {
        return $this->hasMany(OrderProductDetail::class, 'order_id', 'id');
    }


}
