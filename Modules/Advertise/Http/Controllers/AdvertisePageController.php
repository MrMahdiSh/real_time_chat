<?php

namespace Modules\Advertise\Http\Controllers;

use App\Helper\Core;
use App\Repositories\AdvertisePageRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Advertise\Entities\AdvertisePage;
use Modules\Article\Entities\Article;
use Modules\Advertise\Entities\Advertise;

class AdvertisePageController extends Controller
{


    protected $model;

    public function __construct(AdvertisePageRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        auth()->user()->can('Advertise.index') ? '' : abort(403);
        $data = $this->model->getAll();
        return view('advertise::page.index', compact('data'));
    }

    public function create()
    {
        auth()->user()->can('Advertise.index') ? '' : abort(403);

        return view('advertise::page.create');
    }

    public function edit($id)
    {
        auth()->user()->can('Advertise.edit') ? '' : abort(403);
        $data = $this->model->getById($id);
        return view('advertise::page.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Advertise.create') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = $this->model->update($id, $data);
        if ($insert) {
            if ($request->image) {
                Core::SaveImage($request->image, 'AdvertisePage', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }

    public function store(Request $request)
    {
        auth()->user()->can('Advertise.create') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = $this->model->create($data);
        if ($insert) {
            if ($request->image) {
                Core::SaveImage($request->image, 'AdvertisePage', $insert->id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Advertise.destroy') ? '' : abort(403);

        $res = $this->model->delete($id);

        if ($res) {
            return 'true';

        } else
            return 'false';


    }
}
