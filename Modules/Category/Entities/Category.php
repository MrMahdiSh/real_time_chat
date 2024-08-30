<?php

namespace Modules\Category\Entities;

use App\Media;
use Illuminate\Database\Eloquent\Model;
use Modules\Doctor\Entities\Doctor;

class Category extends Model
{
    protected $guarded = [];

    public function doctors()
    {

        return $this->hasMany(Doctor::class, 'category_id', 'id')->with('media');


    }

    public function media()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'Category');
    }
}
