<?php

namespace Modules\Doctor\Http\Controllers;

use App\Helper\Core;
use App\Repositories\DoctorRepository;
use App\Status;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Doctor\Entities\Doctor;
use Modules\Doctor\Entities\DoctorRate;

class DoctorController extends Controller
{

    protected $model;

    public function __construct(DoctorRepository $model)
    {

        $this->model = $model;
    }

    public function doctorStatus($id)
    {
        auth()->user()->can('Doctor.edit') ? '' : abort(403);

        $result = $this->model->update($id, ['active' => Status::True]);
        if ($result)
            return Core::true();
        else
            return Core::false();


    }

    public function status($id)
    {
        $item = $this->model->getById($id);
        $st = $item->certificate == Status::False ? Status::True : Status::False;

        $item = $this->model->update($id, ['certificate' => $st]);

        if ($item)
            return Core::true();


        return Core::false();

    }

    public function index_comments()
    {
        auth()->user()->can('Doctor.index') ? '' : abort(403);
        $data = DoctorRate::where('answers', '=', null)->orWhere('answers', '')->get();


        return view('doctor::comment.index', compact('data'));
    }

    public function index()
    {
        auth()->user()->can('Doctor.index') ? '' : abort(403);
        $data = Doctor::get();
        return view('doctor::index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('Doctor.create') ? '' : abort(403);
        return view('doctor::create');
    }


    public function store(Request $request)
    {
        auth()->user()->can('Doctor.create') ? '' : abort(403);

        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');

        $insert = Doctor::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'Doctor', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }


    public function edit($id)
    {
        auth()->user()->can('Doctor.edit') ? '' : abort(403);
        $data = Doctor::find($id);

        return view('doctor::edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Doctor.edit') ? '' : abort(403);

        $data['mobile'] = $request->mobile;

        $insert = Doctor::find($id);

        if (isset($request->password) && !empty($request->password))
            $data['password'] = Hash::make($request->password);

        if ($insert->update($data)) {

            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Doctor.destroy') ? '' : abort(403);

        if (Doctor::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
