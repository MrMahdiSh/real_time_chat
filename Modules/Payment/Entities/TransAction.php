<?php

namespace Modules\Payment\Entities;

use App\Helper\Core;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Doctor\Entities\DoctorReserved;
use Modules\Package\Entities\Package;
use Modules\Package\Entities\UserInstallment;
use Modules\Package\Entities\UserPackage;
use Modules\Patient\Entities\Patient;

class TransAction extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->hasOne(Patient::class, 'id', 'user_id');
    }

    public function order()
    {
        return $this->hasOne(DoctorReserved::class, 'id', 'package_id');
    }


    public function getFaDateAttribute()
    {

        return Core::persianDate($this->created_at, false);
    }

    public function getDateAttribute()
    {

        return Core::ArticleDate($this->created_at, false);
    }


}
