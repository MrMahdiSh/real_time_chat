<?php

namespace Modules\Product\Entities;

use App\Helper\Core;
use App\Media;
use Illuminate\Database\Eloquent\Model;
use Modules\Doctor\Entities\Doctor;
use PhpParser\Comment\Doc;

class Product extends Model
{
    protected $guarded = [];

    public function media()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'Product');
    }


    public function category()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'category_id');

    }

    public function brand()
    {
        return $this->hasOne(ProductBrand::class, 'id', 'brand_id');

    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');

    }


    public function getOfferPriceAttribute()
    {
        $price = $this->price;
        $offer = $this->offer;
        if ((int)$offer > 0) {

            $temp = ($price * $offer) / 100;

            $price -= $temp;

            return $price;
        } else
            return $price;

    }

    public function getFaCreatedAtAttribute()
    {
        return Core::persianDate($this->created_at, false);
    }

}
