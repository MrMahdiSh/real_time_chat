<?php

namespace Modules\Service\Http\Controllers;

use App\Helper\Core;
use App\Repositories\Product\ProductCategoryRepository;
use App\Repositories\Service\ServiceCategoryRepository;
use App\Repositories\Service\ServiceRateRepository;
use App\Status;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Product\Entities\Product;
use Modules\Service\Entities\ServiceCategory;
use Modules\Service\Entities\ServiceRate;

class ServiceRateController extends Controller
{


    protected $model;

    public function __construct(ServiceRateRepository $model)
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
        $data = $this->model->Get()->get();
        return view('service::rate.index', compact('data'));
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
