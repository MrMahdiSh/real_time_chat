<?php

namespace Modules\Product\Http\Controllers;

use App\Helper\Core;
use App\Repositories\Product\ProductBrandRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Product\Entities\Product;

class ProductBrandController extends Controller
{


    protected $model;

    public function __construct(ProductBrandRepository $model)
    {

        $this->model = $model;
    }

    public function index()
    {
        auth()->user()->can('Product.index') ? '' : abort(403);
        $data = $this->model->getAll();
        return view('product::brand.index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('Product.create') ? '' : abort(403);
        return view('product::brand.create');

    }


    public function store(Request $request)
    {
        auth()->user()->can('Product.create') ? '' : abort(403);

        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');

        $insert = $this->model->create($data);

        if ($insert) {
            if ($request->image) {
                Core::SaveImage($request->image, 'ProductBrand', $insert->id);
            }

            return Core::true();
        } else
            return Core::false();
    }


    public function edit($id)
    {
        auth()->user()->can('Product.edit') ? '' : abort(403);
        $data = $this->model->getById($id);

        return view('product::brand.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Product.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');


        $insert = $this->model->update($id, $data);
        if ($insert) {
            if ($request->image) {
                Core::SaveImage($request->image, 'ProductBrand', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Product.destroy') ? '' : abort(403);

        $item = $this->model->delete($id);
        if ($item) {
            return 'true';
        } else
            return 'false';


    }
}
