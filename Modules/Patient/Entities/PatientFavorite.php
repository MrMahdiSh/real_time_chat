<?php

namespace Modules\Patient\Entities;

use App\Helper\Core;
use App\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PatientFavorite extends Model
{
    protected $guarded = [];


    protected $table='patient_favorites';
}
