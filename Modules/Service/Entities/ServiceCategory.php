<?php

namespace Modules\Service\Entities;

use App\Media;
use App\Status;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $guarded = [];

    public function media()
    {
        return $this->hasOne(Media::class, 'media_id', 'id')->where('media_title', 'ServiceCategory');
    }

    public function parent()
    {
        return $this->hasOne(ServiceCategory::class, 'id', 'parent_id')->where('status', Status::True);
    }


    public function child()
    {
        return $this->hasMany(ServiceCategory::class, 'parent_id', 'id')->where('status', Status::True);
    }

}
