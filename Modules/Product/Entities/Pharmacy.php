<?php

namespace Modules\Product\Entities;

use App\Media;
use Illuminate\Database\Eloquent\Model;
use Modules\State\Entities\City;

class Pharmacy extends Model
{
    protected $guarded = [];


    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id')->with('state');

    }


    public function media()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'Pharmacy');
    }


    public function getCityStateAttribute()
    {
        return $this->city ? "{$this->city->title} - {$this->city->state->title}" : '';

    }
}
