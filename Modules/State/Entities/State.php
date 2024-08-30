<?php

namespace Modules\State\Entities;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $guarded = [];

    public function cities()
    {

        return $this->hasMany(City::class, 'state_id', 'id')->orderBy('title','asc');

    }
}
