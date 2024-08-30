<?php

namespace Modules\Patient\Entities;

use App\Helper\Core;
use App\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Article\Entities\ArticleComment;
use Modules\Doctor\Entities\DoctorRate;
use Modules\Doctor\Entities\DoctorReserved;
use Modules\Doctor\Entities\FavoriteDoctor;
use Modules\Product\Entities\Card;
use Modules\Product\Entities\ProductFavorite;
use Modules\Product\Entities\ProductSetting;
use Modules\State\Entities\City;
use Modules\State\Entities\State;

class Patient extends Authenticatable
{
    protected $guarded = [];

    protected $guard = 'patient';
    use Notifiable;

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function media()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'PatientAvatar');
    }

    public function hasFavProduct($id)
    {
        $user_id = $this->id;
        $item = ProductFavorite::where(['user_id' => $user_id, 'product_id' => $id])->first();

        if (isset($item))
            return true;

        return false;
    }

    public function getFaBirthDayAttribute()
    {
        return Core::persianDate($this->birth_day, false);

    }

    public function Cards()
    {
        return $this->hasMany(Card::class, 'user_id', 'id')->with('product');
    }

    public function getAmountProductPrice()
    {
        $amount = 0;
        $data = $this->cards()->get();
        if ($data->count() < 1)
            return 0;

        foreach ($data as $item) {
            if (isset($item->product)) {
                $amount += (int)$item->product->offer_price * (int)$item->count;
            }
        }
        return $amount;
    }

    public function TotalPriceProduct()
    {

        $setting = ProductSetting::first();

        $amount = $this->getAmountProductPrice();
        if ($amount < 1 || empty($setting))
            return 0;
        $tax_price = $setting->tax_price;
        $transfer_price = $setting->transfer_price;

        $amount += $transfer_price;

        $amount += Core::PercentPrice($amount, $tax_price);

        return $amount;
    }


    public function getFaCreatedAtAttribute()
    {
        return Core::persianDate($this->created_at, false);

    }

    public function favorite()
    {
        return $this->hasMany(FavoriteDoctor::class, 'user_id', 'id');
    }

    public function ArticleComments()
    {
        return $this->hasMany(ArticleComment::class, 'user_id', 'id')->orderBy('id', 'desc')->with('article');
    }

    public function DoctorRates()
    {
        return $this->hasMany(DoctorRate::class, 'patient_id', 'id')->orderBy('id', 'desc')->with('doctor');
    }

    public function reserves()
    {
        return $this->hasMany(DoctorReserved::class, 'client_id', 'id');
    }

    public function getFullNameAttribute()
    {
        return "$this->name $this->family";
    }

    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }


    public function getFullTownAttribute()
    {
        $city = !empty($this->city()->first()) ? $this->city()->first()->title : '';
        $state = !empty($this->state()->first()) ? $this->state()->first()->title : '';
        return "$state - $city";
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
