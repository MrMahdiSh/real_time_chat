<?php

namespace Modules\Product\Http\Controllers;

use App\Helper\Core;
use App\Repositories\CityRepository;
use App\Repositories\Product\CertificatePharmacyRepository;
use App\Repositories\Product\PharmacyRepository;
use App\Repositories\Product\ProductBrandRepository;
use App\Repositories\Product\ProductCategoryRepository;
use App\Repositories\Product\ProductRepository;
use App\Status;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Product\Entities\Product;

class PharmacyController extends Controller
{


    protected $model;
    protected $cityRepository;
    protected $certificatePharmacyRepository;


    public function __construct(PharmacyRepository $model, CityRepository $cityRepository, CertificatePharmacyRepository $certificatePharmacyRepository)
    {
        $this->model = $model;
        $this->cityRepository = $cityRepository;
        $this->certificatePharmacyRepository = $certificatePharmacyRepository;
    }


    public function status($id)
    {


        $item = $this->certificatePharmacyRepository->getById($id);


        $st = $item->status == Status::True ? Status::False : Status::True;
        $item = $this->certificatePharmacyRepository->update($id, ['status' => $st]);

        if ($item)
            return Core::true();


        return Core::false();


    }

    public function index()
    {
        auth()->user()->can('Product.index') ? '' : abort(403);
        $data = $this->model->getAll();
        return view('product::pharmacy.index', compact('data'));
    }


    public function edit($id)
    {
        auth()->user()->can('Product.edit') ? '' : abort(403);
        $data = $this->model->getById($id);
        $cities = $this->cityRepository->Get()->has('state')->get();

        return view('product::pharmacy.edit', compact('data', 'cities'));
    }


    public function create()
    {
        auth()->user()->can('Product.create') ? '' : abort(403);

        $cities = $this->cityRepository->Get()->has('state')->get();

        return view('product::pharmacy.create', compact('cities'));

    }


    public function store(Request $request)
    {
        auth()->user()->can('Product.create') ? '' : abort(403);

        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');

        $insert = $this->model->create($data);

        if ($insert) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Pharmacy', $insert->id);
            }
            return Core::true();
        } else
            return Core::false();
    }

    public function update(Request $request, $id)
    {
        auth()->user()->can('Product.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation', 'step');


        $update = $this->model->update($id, $data);
        if ($update) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Pharmacy', $id);

            }
            return Core::true();
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
