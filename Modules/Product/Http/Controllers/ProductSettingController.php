<?php

namespace Modules\Product\Http\Controllers;

use App\Helper\Core;
use App\Repositories\Product\ProductBrandRepository;
use App\Repositories\Product\ProductCategoryRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductSettingRepository;
use App\Status;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Product\Entities\Product;

class ProductSettingController extends Controller
{


    protected $model;

    public function __construct(ProductSettingRepository $model)
    {
        $this->model = $model;

    }

    public function index()
    {
        auth()->user()->can('Product.index') ? '' : abort(403);
        $data = $this->model->getById(1);
        return view('product::setting.index', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Product.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation', 'step');
        $update = $this->model->update($id, $data);
        if ($update) {
            return Core::true();
        }
        return Core::false();
    }


}
