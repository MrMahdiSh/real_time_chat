<?php

namespace Modules\Faq\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Faq\Entities\Faq;

class FaqController extends Controller
{

    public function index()
    {
        auth()->user()->can('Faq.index') ? '' : abort(403);
        $data = Faq::get();
        return view('faq::index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('Faq.create') ? '' : abort(403);
        return view('faq::create');
    }

    public function status($id)
    {
        auth()->user()->can('Faq.edit') ? '' : abort(403);

        $data = Faq::find($id);
        $status = (int)$data->status;
        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;

        }
        $data->update(['status' => $status . '']);
        return Core::true();
    }

    public function store(Request $request)
    {
        auth()->user()->can('Faq.create') ? '' : abort(403);

        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');

        $insert = Faq::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'Faq', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }


    public function edit($id)
    {
        auth()->user()->can('Faq.edit') ? '' : abort(403);
        $data = Faq::find($id);

        return view('faq::edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Faq.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = Faq::find($id);
        if ($insert->update($data)) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Faq', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Faq.destroy') ? '' : abort(403);

        if (Faq::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
