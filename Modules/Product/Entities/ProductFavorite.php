<?php

namespace Modules\Product\Entities;

use App\Status;
use Illuminate\Database\Eloquent\Model;

class ProductFavorite extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id')->where('status', Status::True);
    }

}
