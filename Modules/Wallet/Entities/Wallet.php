<?php

namespace Modules\Wallet\Entities;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $guarded = [];

    protected $table = "wallet_patients";
}
