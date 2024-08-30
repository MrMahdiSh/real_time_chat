<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['name', 'creator_user_id'];
}
