<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    //
    public function show($size = 'md', $filename)
    {

        $media = Media::where('file_name', explode('.', $filename)[0])->first();
        $file_name = $filename . '.' . $media->extension;


//        return  $media->type;
        if ($media->type == 'image') {

            return $media->show($file_name, $size);

        } else {
            return $media->show($file_name, $size, 'files');


        }
    }

    public function destroy(Request $request)
    {

        $medium = Media::where('file_name', $request->key)->first();
        $file = $medium->file_name . '.' . $medium->extension;

        if ($medium->type == 'video') {

            try {
                if ($medium->first()->remove($file, 'file')) {

                    Media::find($medium->id)->delete();

                }
            } catch (\Exception $exception) {
                dd($exception);
            }

        } else {

            try {
                if ($medium->first()->remove($file)) {

                    Media::find($medium->id)->delete();

                }
            } catch (\Exception $exception) {
                dd($exception);
            }
        }


        return ['success' => '1'];
    }
}
