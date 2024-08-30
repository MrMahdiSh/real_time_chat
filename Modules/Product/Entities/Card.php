<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $guarded = [];


    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id')->with('media');
    }
}
