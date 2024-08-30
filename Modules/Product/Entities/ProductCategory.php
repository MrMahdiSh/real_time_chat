<?php

namespace Modules\Product\Entities;

use App\Media;
use App\Status;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $guarded = [];

    public function media()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'ProductCategory');
    }

    public function products()
    {
        return $this->hasOne(Product::class, 'category_id', 'id')->where('status', Status::True);
    }
}
