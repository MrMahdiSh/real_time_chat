<?php

namespace Modules\Product\Http\Controllers;

use App\Helper\Core;
use App\Repositories\Product\CertificatePharmacyRepository;
use App\Repositories\Product\ProductBrandRepository;
use App\Repositories\Product\ProductCategoryRepository;
use App\Repositories\Product\ProductRepository;
use App\Status;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Product\Entities\Product;

class CertificatePharmacyController extends Controller
{

    protected $model;

    public function __construct(CertificatePharmacyRepository $model)
    {
        $this->model = $model;
    }

    public function index()
    {


        $type = \request('type', '');
        auth()->user()->can('Product.index') ? '' : abort(403);
        $data = $this->model->Get();

        if (!empty($type))
            $data = $data->where('status', $type)->get();


        $data = $data->get();

        return view('product::certificate.index', compact('data'));
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
