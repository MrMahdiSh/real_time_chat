<?php

namespace Modules\Service\Http\Controllers;

use App\Helper\Core;
use App\Repositories\Product\ProductCategoryRepository;
use App\Repositories\Service\ServiceCategoryRepository;
use App\Status;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Product\Entities\Product;
use Modules\Service\Entities\ServiceCategory;

class ServiceCategoryController extends Controller
{


    protected $model;

    public function __construct(ServiceCategoryRepository $model)
    {

        $this->model = $model;
    }

    public function status($id)
    {
        $item = $this->model->getById($id);
        $st = $item->status == Status::False ? Status::True : Status::False;

        $item = $this->model->update($id, ['status' => $st]);

        if ($item)
            return Core::true();


        return Core::false();

    }

    public function index()
    {
        auth()->user()->can('Service.index') ? '' : abort(403);
        $data = $this->model->Get()->where('parent_id', \request('category_id', 0))->get();
        return view('service::category.index', compact('data'));
    }


    public function create()
    {

        auth()->user()->can('Service.create') ? '' : abort(403);
        return view('service::category.create');
    }


    public function store(Request $request)
    {
        auth()->user()->can('Service.create') ? '' : abort(403);

        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');

        $insert = $this->model->create($data);

        if ($insert) {
            if ($request->image) {
                Core::SaveImage($request->image, "ServiceCategory", $insert->id);
            }

            return Core::true();
        } else
            return Core::false();
    }


    public function edit($id)
    {
        auth()->user()->can('Service.edit') ? '' : abort(403);
        $data = $this->model->getById($id);

        return view('service::category.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Service.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');


        $insert = $this->model->update($id, $data);
        if ($insert) {
            if ($request->image) {
                Core::SaveImage($request->image, 'ServiceCategory', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Service.destroy') ? '' : abort(403);

        $item = $this->model->delete($id);
        if ($item) {
            return 'true';
        } else
            return 'false';


    }
}
