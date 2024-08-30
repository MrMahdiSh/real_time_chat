<?php

namespace Modules\Doctor\Entities;

use Illuminate\Database\Eloquent\Model;

class FavoriteDoctor extends Model
{
    protected $guarded = [];

    public function doctor()
    {

        return $this->hasOne(Doctor::class, 'id', 'doc_id');

    }
}
