<?php

namespace Modules\Slider\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;

use Modules\Slider\Entities\Slider;

class SliderController extends Controller
{

    public function index()
    {
        auth()->user()->can('Slider.index') ? '' : abort(403);
        $data = Slider::with('media')->get();
        return view('slider::index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('Slider.create') ? '' : abort(403);
        return view('slider::create');
    }


    public function store(Request $request)
    {
        auth()->user()->can('Slider.create') ? '' : abort(403);

        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');


        if (!$request->image) {
            return Core::false();
        }
        $data['status'] = '1';
        $insert = Slider::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'Slider', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }

    public function status($id)
    {
        auth()->user()->can('Slider.edit') ? '' : abort(403);

        $data = Slider::find($id);
        $status = (int)$data->status;
        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;

        }
        $data->update(['status' => $status . '']);
        return Core::true();
    }

    public function edit($id)
    {
        auth()->user()->can('Slider.edit') ? '' : abort(403);
        $data = Slider::with('media')->find($id);

        return view('slider::edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Slider.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = Slider::find($id);




        if ($insert->update($data)) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Slider', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Slider.destroy') ? '' : abort(403);

        if (Slider::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
