<?php

namespace Modules\Product\Http\Controllers;

use App\Helper\Core;
use App\Repositories\Product\ProductBrandRepository;
use App\Repositories\Product\ProductCategoryRepository;
use App\Repositories\Product\ProductRepository;
use App\Status;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Product\Entities\Product;

class ProductController extends Controller
{


    protected $model;
    protected $brand;
    protected $category;

    public function __construct(ProductRepository $model, ProductBrandRepository $brand, ProductCategoryRepository $category)
    {
        $this->model = $model;
        $this->category = $category;
        $this->brand = $brand;
    }

    public function index()
    {
        auth()->user()->can('Product.index') ? '' : abort(403);
        $data = $this->model->getAll();
        return view('product::index', compact('data'));
    }


    public function edit($id)
    {
        auth()->user()->can('Product.edit') ? '' : abort(403);
        $data = $this->model->getById($id);
        $brands = $this->brand->getAll();
        $categories = $this->category->getAll();
        return view('product::edit', compact('data', 'brands', 'categories'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Product.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation', 'step');

        $data['status'] = Status::True;
        $update = $this->model->update($id, $data);
        if ($update) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Product', $id);

            }
            return  Core::true();
        }
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
