<?php

namespace Modules\Doctor\Entities;

use App\Helper\Core;
use App\Media;
use App\Status;
use App\TypeModelTransAction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Article\Entities\Article;
use Modules\Category\Entities\Category;
use Modules\Clinic\Entities\Clinic;
use Modules\Payment\Entities\Payment;
use Modules\Payment\Entities\TransAction;
use Modules\Product\Entities\CertificatePharmacy;
use Modules\Product\Entities\Product;
use Modules\Service\Entities\ServiceModel;
use Modules\Service\Entities\ServiceReserve;
use Modules\Setting\Entities\Setting;
use Modules\State\Entities\City;
use Modules\State\Entities\State;
use Modules\Ticket\Entities\Ticket;

class Doctor extends Authenticatable
{
    protected $guarded = [];

    protected $guard = 'doctor';
    use Notifiable;

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function ticket()
    {
        return $this->hasOne(Ticket::class, 'doc_id', 'id')->orderBy('id', 'desc');

    }

    public function services()
    {
        return $this->hasMany(ServiceModel::class, 'doctor_id', 'id')->with('orders');
    }

    public function setting()
    {
        return $this->hasOne(DoctorSetting::class, 'doc_id', 'id');
    }

    public function getFaDateTicketAttribute()
    {
        return $this->ticket ? Core::ArticleDate($this->ticket->created_at, false) : '';


    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'doc_id', 'id')->orderBy('id', 'desc');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'doctor_id', 'id')->orderBy('id', 'desc');
    }

    public function getFaBirthDayAttribute()
    {
        return Core::persianDate($this->birth_day, false);
    }

    public function setting_pay()
    {
        return $this->hasOne(Setting::class, 'id', 'id')->orWhere('id', 1);
    }

    public function getFullNameAttribute()
    {
        return  " دکتر {$this->name}  {$this->family} ";
    }

    public function media()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'DoctorAvatar');
    }


    public function contact()
    {
        return $this->hasOne(DoctorContact::class, 'doc_id', 'id');
    }


    public function schedule()
    {

        return $this->hasMany(DocorScheduleTime::class, 'doc_id', 'id');
    }


    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }


    public function rate()
    {
        return $this->hasMany(DoctorRate::class, 'doc_id', 'id')->where('status', Status::Success);
    }

    public function clinic()
    {
        return $this->hasOne(Clinic::class, 'id', 'clinic_id')->with('gallery');
    }

    public function getStarsAttribute()
    {
        $count = $this->rate()->avg('star');

        return $count != 0 ? (int)$count : 0;
    }

    public function getAddressInfoAttribute()
    {

        if ($this->contact)
            return $this->contact->city->title . ' - ' . $this->contact->state->title;
        else
            return 'نامشخص';

    }


    public function education()
    {
        return $this->hasOne(DoctorEducation::class, 'doc_id', 'id');
    }


    public function reserves()
    {
        return $this->hasMany(DoctorReserved::class, 'user_id', 'id');
    }

    public function exprience()
    {
        return $this->hasOne(DoctorExpience::class, 'doc_id', 'id');
    }

    public function reward()
    {
        return $this->hasOne(DoctorAchivment::class, 'doc_id', 'id');
    }

    public function account()
    {
        return $this->hasOne(DoctorAccount::class, 'doc_id', 'id');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, 'doc_id', 'id');
    }


    public function getPaymentsAttribute()
    {

        return $this->payment()->where('status', 1)->sum('price');

    }

    public function articles()
    {

        return $this->hasMany(Article::class, 'writer_id', 'id');

    }

    public function getAllPaymentsAttribute()
    {

        return $this->payment()->sum('price');

    }

    public function getRequestPaymentsAttribute()
    {
        return $this->payment()->where('status', 0)->sum('price');

    }

    public function getCheckoutAttribute()
    {

        $price = (int)$this->creditor - (int)$this->all_payments;

        return $price;

    }

    public function getCreditorAttribute()
    {
        $transACtions = TransAction::where(['user_id' => $this->id, 'type_model' => TypeModelTransAction::Doctor])->get();
        return $transACtions->sum('price');
    }

    public function getGetEducationAttribute()
    {
        $data = $this->education()->first();

        return $data ? json_decode($data->detail, false) : '';

    }

    public function certificate()
    {
        return $this->hasOne(CertificatePharmacy::class, 'doctor_id', 'id');
    }

    public function certificateDragStore()
    {
        $item = $this->certificate()->first();

        if (!isset($item))
            return false;

        return $item->status == Status::True ? true : false;
    }

    public function getFaCreatedAtAttribute()
    {
        return Core::persianDate($this->created_at, false);

    }

    public function getGetExperienceAttribute()
    {
        $data = $this->exprience()->first();

        return $data ? json_decode($data->detail, false) : '';

    }

    public function getGetRewardAttribute()
    {
        $data = $this->reward()->first();

        return $data ? json_decode($data->detail, false) : '';

    }
}
