<?php

namespace Modules\Payment\Entities;

use App\Helper\Core;
use Illuminate\Database\Eloquent\Model;
use Modules\Doctor\Entities\Doctor;

class Payment extends Model
{
    protected $guarded = [];


    public function getFaCreatedAtAttribute()
    {
        return explode(',', Core::ChatDate($this->created_at, false));
    }

    public function getDateAttribute()
    {
        return Core::ChatDate($this->created_at, false);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'id', 'doc_id');
    }

    public function getFaUpdatedAtAttribute()
    {
        return explode(',', Core::ChatDate($this->updated_at, false));
    }
}
