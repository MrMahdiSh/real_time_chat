<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['type', 'data', 'sender_user_id', 'conversations_id'];
}
