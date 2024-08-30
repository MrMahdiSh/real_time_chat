<?php

namespace App\Helper;

use App\Media;
use App\Menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Modules\Product\Entities\ProductSetting;
use Modules\Setting\Entities\Setting;
use Morilog\Jalali\Jalalian;

use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Intervention\Image\Facades\Image;
class Core
{



    public static function PercentPrice($price, $percent)
    {
        return $temp = ($price / 100) * $percent;

    }

    public static function status_reserve($item)
    {

        $st = 'رزرو';
        $bg_st = 'warning';
        switch ($item) {
            case 'success':
                $st = 'پرداخت شده';
                $bg_st = 'success';
                break;

            case 'reject':
                $st = 'لغو رزرو';
                $bg_st = 'danger';
                break;


        }

        return [$st, $bg_st];
    }

    public static function translate_week($item): string
    {

        $item = trim($item);
        switch ($item) {
            case 'شنبه':
                $item = 'Saturday';
                break;
            case 'یکشنبه':
                $item = 'Sunday';
                break;
            case 'دوشنبه':
                $item = 'Monday';
                break;
            case 'سه‌شنبه':
                $item = 'Tuesday';
                break;
            case 'چهارشنبه':
                $item = 'Wednesday';
                break;
            case 'پنجشنبه':
                $item = 'Thursday';
                break;
            case 'جمعه':
                $item = 'Friday';
                break;
        }

        return $item;
    }

    public static function calculate_time($item): int
    {

        $item = str_replace('صبح', '', $item);
        $item = str_replace('عصر', '', $item);


        return (int)$item;
    }

    public static function persian_to_en_date($input_date , $delimitor = '/'): string
    {
        $date = explode($delimitor, $input_date);
        $date = new Jalalian($date[0], $date[1], $date[2]);
        return $date->toCarbon();
    }

    public static function convert_number($number)
    {

        $number = str_replace('۰', '0', $number);
        $number = str_replace('۱', '1', $number);
        $number = str_replace('۲', '2', $number);
        $number = str_replace('۳', '3', $number);
        $number = str_replace('۴', '4', $number);
        $number = str_replace('۵', '5', $number);
        $number = str_replace('۶', '6', $number);
        $number = str_replace('۷', '7', $number);
        $number = str_replace('۸', '8', $number);
        $number = str_replace('۹', '9', $number);

        return $number;
    }

    public static function send_sms($params)
    {


    }

    public static function true($msg = null)
    {

        if (empty($msg)) {
            $msg = 'success';
        }
        return redirect()->back()->with(['success' => $msg]);

    }

    public static function SaveFiles($file, $title, $id, $description = '')
    {

        $extension = $file->getClientOriginalExtension();
        $uid = uniqid() . time();
        $imageName = $uid . "." . $extension;
        $file_name = $uid;
        $file->storeAs('public/files', $imageName); // Creates image in '\storage\app\images'.
        $media = Media::create([
            'file_name' => $file_name,
            'extension' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
            'mime' => $file->getMimeType(),
            'media_title' => $title,
            'media_id' => $id,
            'description' => $description,
            'type' => 'video',
            'image_type' => 'base64',

        ]);

        return true;
    }
    public static function SaveImage($encode_file, $title, $id, $type = 'single', $description = '')
    {
        // Delete Single File Image First
        if ($type == 'single') {
            $check = Media::where(['media_title' => $title, 'media_id' => $id])->first();
            if (isset($check)) {
                try {
                    $file_delete = $check->file_name . '.' . $check->extension;
                    if ($check->remove($file_delete)) {
                        Media::find($check->id)->delete();
                    }
                } catch (\Exception $exception) {
                    dd($exception);
                }
            }
        }
        // End Delete Single File Image First

        $file = json_decode($encode_file, true);
        $image_64 = $file['output']['image'];
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1]; // .jpg .png .pdf
        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);
        $data = base64_decode($image);
        $temp = tmpfile();
        fwrite($temp, $data);
        $tempPath = stream_get_meta_data($temp)['uri'];

        $uid = uniqid() . time();
        $imageName = $uid . "." . $extension;
        $file_name = $uid;
        $file = new \Illuminate\Http\UploadedFile($tempPath, $imageName, null, null, true);

        // ذخیره تصویر با کیفیت بالا
        $file->storeAs('public/image/md', $imageName);

        // تبدیل تصویر به فرمت WebP
        $webpImage = Image::make(storage_path('app/public/image/md/' . $imageName));
        $webpImage->encode('webp', 90); // 90 به عنوان کیفیت WebP قرار داده شده است
        $webpName = $uid . ".webp";
        $webpPath = storage_path('app/public/image/md/' . $webpName);
        $webpImage->save($webpPath);

        // حذف تصویر اصلی
        unlink(storage_path('app/public/image/md/' . $imageName));

        // ذخیره اطلاعات تصویر در دیتابیس
        $media = Media::create([
            'file_name' => $file_name,
            'extension' => 'webp',
            'size' => filesize($webpPath),
            'mime' => 'image/webp',
            'media_title' => $title,
            'media_id' => $id,
            'description' => $description,
            'type' => 'image',
            'image_type' => 'base64',
        ]);

        fclose($temp);

        return true;
    }


//    public static function encode_to_file($encode_file)
//    {
//        $file = json_decode($encode_file, true);
////        $data = $file['output'];
//        $data = $file['output']['image'];
//
//
//        $image_64 = $data; //your base64 encoded data
//
//        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
//
//        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
//
//// find substring fro replace here eg: data:image/png;base64,
//
//        $image = str_replace($replace, '', $image_64);
//
//        $image = str_replace(' ', '+', $image);
//
//        $imageName = Str::random(10) . '.' . $extension;
//
//        Storage::disk('public')->put($imageName, base64_decode($image));
//
//        $data = base64_decode($image);
//
//// Create a temp file and write the decoded image.
//        $temp = tmpfile();
//        fwrite($temp, $data);
//
//// Get the path of the temp file.
//        $tempPath = stream_get_meta_data($temp)['uri'];
//
//// Initialize the UploadedFile.
//        $imageName = uniqid() . time() . "." . $extension;
//        $file = new \Illuminate\Http\UploadedFile($tempPath, $imageName, null, null, true);
//
//// Test if the UploadedFile works normally.
//
//        $file->storeAs('images', 'texzxst.png'); // Creates image in '\storage\app\images'.
//
//// Delete the temp file.
//        fclose($temp);
//
//        return $file; // Shows 'png'
//
//    }
//

    public static function false($msg = null)
    {

        if (empty($msg)) {
            $msg = 'error';
        }

        return redirect()->back()->with(['error' => $msg]);


    }


    public static function menu()
    {
        return Menu::where('parent_id', 0)
            ->with(['sub_menus' => function ($query) {
                return $query->with('sub_menus');
            }])->get();
    }

    public static function subStrStripTagCustomLenth($text, $length = 50, $strip_tag = false, $sub_start = 0)
    {
        if (!empty($text)) {
            if (strlen($text) > $length) {
                return mb_substr(strip_tags($text), $sub_start, $length, 'UTF-8') . '....';
            } else return strip_tags($text);
        }
    }

    public static function getColumnsName($table)
    {
        return Schema::getColumnListing($table);
    }

    public static function birthdayAge($birthday)
    {
//        $explode = explode('-', $birthday);
//        $data['birthday'] = (new Jalalian($explode[0], $explode[1], $explode[2], 0, 0, 0))->toCarbon()->toDateTimeString();
        $age = Carbon::parse($birthday)->age;
        return $age;
    }

    public static function persianDate($date, $is_array = true)
    {
        if ($is_array) {
            foreach ($date as $item) {
                $item->created_at_persian_full = Jalalian::forge($item->created_at)->format('Y-m-d H:i:s');
                $explode = explode(' ', $item->created_at_persian_full);
                $item->created_at_persian_date = $explode[0];
                $item->created_at_persian_time = $explode[1];
                $item->date = $explode[0];
            }
        } else {
            return Jalalian::forge($date)->format('Y/m/d ');
        };
    }

    public static function ArticleDate($date, $is_array = true)
    {
        if ($is_array) {
            foreach ($date as $item) {
                $item->created_at_persian_full = Jalalian::forge($item->created_at)->format('%A, %d %B %y');
                $explode = explode(' ', $item->created_at_persian_full);
                $item->created_at_persian_date = $explode[0];
                $item->created_at_persian_time = $explode[1];
                $item->date = $explode[0];
            }
        } else {
            return Jalalian::forge($date)->format('%A, %d %B %Y');
        };
    }

    public static function ChatDate($date, $is_array = true)
    {
        if ($is_array) {
            foreach ($date as $item) {
                $item->created_at_persian_full = Jalalian::forge($item->created_at)->format('%A, %d %B %y');
                $explode = explode(' ', $item->created_at_persian_full);
                $item->created_at_persian_date = $explode[0];
                $item->created_at_persian_time = $explode[1];
                $item->date = $explode[0];
            }
        } else {
            return Jalalian::forge($date)->format('%A %d %B %Y , H:i');
        };
    }


    public static function ReserveDate($date, $is_array = true)
    {
        if ($is_array) {
            foreach ($date as $item) {
                $item->created_at_persian_full = Jalalian::forge($item->created_at)->format('%A, %d %B %y');
                $explode = explode(' ', $item->created_at_persian_full);
                $item->created_at_persian_date = $explode[0];
                $item->created_at_persian_time = $explode[1];
                $item->date = $explode[0];
            }
        } else {
            return explode(' , ', Jalalian::forge($date)->format('%A , %d , %B , %Y'));

            return Jalalian::forge($date)->format('Y/m/d ');

        };
    }

}
