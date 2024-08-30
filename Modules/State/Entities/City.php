<?php

namespace Modules\State\Entities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    protected $table = 'cities';


    public function state()
    {

        return $this->hasOne(State::class, 'id', 'state_id');

    }
}
