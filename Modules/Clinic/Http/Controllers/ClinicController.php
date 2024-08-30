<?php

namespace Modules\Clinic\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Clinic\Entities\Clinic;

class ClinicController extends Controller
{

    public function index()
    {
        auth()->user()->can('Clinic.index') ? '' : abort(403);
        $data = Clinic::get();
        return view('clinic::index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('Clinic.create') ? '' : abort(403);
        return view('clinic::create');
    }


    public function store(Request $request)
    {
        auth()->user()->can('Clinic.create') ? '' : abort(403);

        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation', 'gallery');

        $insert = Clinic::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'Clinic', $insert->id);
            }

            if (isset($request->gallery)) {
                try {

                    foreach ($request->gallery as $key => $item) {
                        Core::SaveFiles($item, 'ClinicGallery', $insert->id);
                    }
                } catch (\Exception $e) {
                }
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function edit($id)
    {
        auth()->user()->can('Clinic.edit') ? '' : abort(403);
        $data = Clinic::find($id);

        return view('clinic::edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Clinic.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation', 'gallery');
        $insert = Clinic::find($id);
        if ($insert->update($data)) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Clinic', $id);
            }

            if (isset($request->gallery)) {
                try {

                    foreach ($request->gallery as $key => $item) {
                        Core::SaveFiles($item, 'ClinicGallery', $id);
                    }
                } catch (\Exception $e) {
                }
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Clinic.destroy') ? '' : abort(403);

        if (Clinic::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
