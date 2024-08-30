<?php

namespace Modules\Service\Http\Controllers;

use App\Helper\Core;
use App\Repositories\Product\ProductCategoryRepository;
use App\Repositories\Service\ServiceCategoryRepository;
use App\Repositories\Service\ServiceModelRepository;
use App\Status;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Product\Entities\Product;
use Modules\Service\Entities\ServiceCategory;

class ServiceModelController extends Controller
{


    protected $model;
    protected $serviceCategoryRepository;

    public function __construct(ServiceModelRepository $model, ServiceCategoryRepository $serviceCategoryRepository)
    {

        $this->model = $model;
        $this->serviceCategoryRepository = $serviceCategoryRepository;
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
        $data = $this->model->Get()->get();
        return view('service::service.index', compact('data'));
    }


    public function create()
    {

        auth()->user()->can('Service.create') ? '' : abort(403);
        return view('service::service.create');
    }


    public function store(Request $request)
    {
        auth()->user()->can('Service.create') ? '' : abort(403);

        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');

        $insert = $this->model->create($data);

        if ($insert) {
            if ($request->image) {
                Core::SaveImage($request->image, "Service", $insert->id);
            }

            return Core::true();
        } else
            return Core::false();
    }


    public function edit($id)
    {
        auth()->user()->can('Service.edit') ? '' : abort(403);
        $data = $this->model->getById($id);

        $categories = $this->serviceCategoryRepository->GetCategories()->get();

        return view('service::service.edit', compact('data', 'categories'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Service.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');


        $data['status'] = Status::True;
        $insert = $this->model->update($id, $data);
        if ($insert) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Service', $id);
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
