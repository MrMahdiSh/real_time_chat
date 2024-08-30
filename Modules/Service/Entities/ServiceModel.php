<?php

namespace Modules\Service\Entities;

use App\Helper\Core;
use App\Media;
use App\Status;
use Illuminate\Database\Eloquent\Model;
use Modules\Doctor\Entities\Doctor;

class ServiceModel extends Model
{
    protected $guarded = [];

    protected $table = 'services_model';

    public function rate()
    {

        return $this->hasMany(ServiceRate::class, 'service_id', 'id')->where('status', Status::True)->with('patient');

    }


    public function orders()
    {
        return $this->hasMany(ServiceReserve::class, 'service_id', 'id');
    }


    public function media()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'Service');
    }

    public function category()
    {
        return $this->hasOne(ServiceCategory::class, 'id', 'category_id')->with('parent');
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
