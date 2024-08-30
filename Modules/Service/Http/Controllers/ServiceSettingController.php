<?php

namespace Modules\Service\Http\Controllers;

use App\Helper\Core;
use App\Repositories\Product\ProductCategoryRepository;
use App\Repositories\Service\ServiceCategoryRepository;
use App\Repositories\Service\ServiceSettingRepository;
use App\Status;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Product\Entities\Product;
use Modules\Service\Entities\ServiceCategory;
use Modules\Service\Entities\ServiceSetting;

class ServiceSettingController extends Controller
{


    protected $model;

    public function __construct(ServiceSettingRepository $model)
    {

        $this->model = $model;
    }


    public function index()
    {
        auth()->user()->can('Service.index') ? '' : abort(403);
        $data = $this->model->getById(1);

        return view('service::setting.index', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Service.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = $this->model->CreateOrUpdate(['id' => $id], $data);


        if ($insert) {
            if ($request->image) {
                Core::SaveImage($request->image, 'ServiceSetting', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }


}
