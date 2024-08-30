<?php

namespace Modules\Doctor\Http\Controllers;

use App\Helper\Core;
use App\Repositories\DoctorRateRepository;
use App\Status;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\ArticleComment;
use Modules\Doctor\Entities\DoctorRate;

class DoctorCommentController extends Controller
{

    protected $model;

    public function __construct(DoctorRateRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        auth()->user()->can('Doctor.index') ? '' : abort(403);
        $data = $this->model->Get()->orderBy('id', 'desc')->get();


        return view('doctor::comment.index', compact('data'));
    }

    public function create()
    {
        return view('doctor::create');
    }


    public function show($id)
    {
        return view('doctor::show');
    }

    public function edit($id)
    {

        auth()->user()->can('Doctor.edit') ? '' : abort(403);
        $data = $this->model->getById($id);


        return view('doctor::comment.edit', compact('data'));

    }

    public function comments_status($id)
    {
        $model = $this->model->getById($id);

        $st = Status::Success;
        if ($model->status == Status::Success)
            $st = Status::False;

        $item = $this->model->update($id, ['status' => $st]);

        if ($item)
            return Core::true();

        return Core::false();
    }

    public function update(Request $request, $id)
    {
        auth()->user()->can('Doctor.edit') ? '' : abort(403);

        $data = $request->except('_token', '_method', 'proengsoft_jsvalidation');
        $item = $this->update($id, $data);


        if ($item)
            return Core::true();

        return Core::false();


    }


    public function destroy($id)
    {
        auth()->user()->can('Doctor.index') ? '' : abort(403);
        $item = $this->model->delete($id);

        if ($item)
            return 'true';

        else
            return 'false';

    }
}
