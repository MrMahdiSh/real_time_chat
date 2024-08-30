<?php

namespace Modules\Product\Http\Controllers;

use App\Helper\Core;
use App\OrderStatus;
use App\Repositories\Product\OrderRepository;
use App\Repositories\Product\ProductBrandRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Product\Entities\Product;

class OrderProductController extends Controller
{


    protected $model;

    public function __construct(OrderRepository $model)
    {

        $this->model = $model;
    }

    public function index()
    {
        auth()->user()->can('Product.index') ? '' : abort(403);
        $data = $this->model->GetAllOrder()->get();
        return view('product::order.index', compact('data'));
    }

    public function confirm($id)
    {

        $item = $this->model->UpdateOrder($id, OrderStatus::Delivered);
        if ($item)
            return Core::true();




        return Core::false();


    }

}
