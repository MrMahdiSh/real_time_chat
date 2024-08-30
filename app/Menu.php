<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    const CREATED_AT = 'created_at' ;
    const UPDATED_AT = 'updated_at' ;
    protected $guarded = [] ;

    public function sub_menus() {
        return $this->hasMany(self::class, 'parent_id');
    }
}
