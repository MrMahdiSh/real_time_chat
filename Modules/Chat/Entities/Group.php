<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'creator_user_id'];
}
