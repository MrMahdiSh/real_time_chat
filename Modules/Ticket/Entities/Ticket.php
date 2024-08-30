<?php

namespace Modules\Ticket\Entities;

use App\Helper\Core;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Doctor\Entities\Doctor;

class Ticket extends Model
{
    protected $guarded = [];

    public function doc()
    {

        return $this->hasOne(Doctor::class, 'id', 'doc_id');

    }

    public function user()
    {

        return $this->hasOne(User::class, 'id', 'user_id');

    }

    public function getFaCreatedAtAttribute()
    {

        return explode(',', Core::ChatDate($this->created_at, false));

    }

    public function getUrlAttribute()
    {

        return url('files/' . $this->file_name);

    }

    public function getFaDateAttribute()
    {

        return Core::persianDate($this->created_at, false);

    }
}
