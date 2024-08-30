<?php

namespace Modules\Blog\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleComment;
use Modules\Article\Entities\ArticleTag;
use Modules\Doctor\Entities\Doctor;
use Modules\Patient\Entities\PatientFavorite;
use Modules\State\Entities\City;

class ApiBlogController extends Controller
{


    public function city_search()
    {

        $text = \request('text', '');

        if (!empty($text)) {

            $data = City::with('state')->where('title', 'LIKE', '%' . $text . '%')->orderBy('title')->get();


            foreach ($data as $i) {
                $t = str_replace('ي', 'ی', $i->title);

                $i->update(['title' => $t]);


            }


            return view('blog::ajax_item.search_item', compact('data'));
        } else return '';


    }

    public function setFav($id)
    {

        return Auth::id();

        $data['patient_id'] = $patient_id;
        $data['doc_id'] = $id;

        $check = PatientFavorite::where($data)->first();


        if ($check)
            $check->delete();
        else
            $item = PatientFavorite::create($data);


    }


    public function get_cities($state_id = 0)
    {

        $cities = City::where('state_id', $state_id)->orderBy('title')->get();


        return $cities;

    }

}
