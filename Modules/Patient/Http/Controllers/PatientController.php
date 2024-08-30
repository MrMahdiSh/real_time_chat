<?php

namespace Modules\Patient\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Patient\Entities\Patient;

class PatientController extends Controller
{


    public function index()
    {
        auth()->user()->can('Patient.index') ? '' : abort(403);
        $data = Patient::get();
        return view('patient::index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('Patient.create') ? '' : abort(403);
        return view('patient::create');
    }


    public function store(Request $request)
    {
        auth()->user()->can('Patient.create') ? '' : abort(403);

        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');

        $insert = Patient::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'Patient', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }


    public function edit($id)
    {
        auth()->user()->can('Patient.edit') ? '' : abort(403);
        $data = Patient::find($id);

        return view('patient::edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Patient.edit') ? '' : abort(403);

        $data['mobile'] = $request->mobile;

        $insert = Patient::find($id);

        if (isset($request->password) && !empty($request->password))
            $data['password'] = Hash::make($request->password);

        if ($insert->update($data)) {

            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Patient.destroy') ? '' : abort(403);

        if (Patient::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
