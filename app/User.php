<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Modules\Doctor\Entities\FavoriteDoctor;
use Modules\Ticket\Entities\Ticket;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{


    use HasRoles;
    use  Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password', 'username', 'family', 'mobile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getFullNameAttribute()
    {

        return $this->name . ' ' . $this->family;
    }

    public function scopeUnseenChat()
    {
        return Ticket::where('seen', 1)->where('user_id', $this->id)->where('sender_id', $this->id);
    }

    public function scopeLastTicket()
    {
        return Ticket::where('user_id', $this->id)->orderBy('id', 'desc');
    }


    public function media()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'avatar_admin');
    }

    public function gallery()
    {
        return $this->hasMany(Media::class, 'media_id', 'id')->where('media_title', 'gallery');
    }
}
