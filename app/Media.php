<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class Media extends Model
{
    protected $guarded;
    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return url("storage/image/md") ."/". $this->full_name;
        return route('show_img', [
            'filename' => "{$this->full_name}"
        ]);
    }

    public function getFullNameAttribute()
    {
        return "{$this->file_name}.{$this->extension}";
    }

    public function show($file_name, $size = "md", $type = 'image')
    {

        if ($type == 'image') {
            $path = storage_path("app/public/image/$size/" . $file_name);
        } else {
            $path = storage_path("app/public/files/" . $file_name);
        }

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }


    public function remove($file, $type = 'image')
    {

        if ($type == 'image') {
            unlink(storage_path('app/public/image/md/' . $file));

        } else {

            unlink(storage_path('app/public/files/' . $file));

        }


        return true;
    }


}
