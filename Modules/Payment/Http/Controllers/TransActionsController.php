<?php

namespace Modules\Payment\Http\Controllers;

use App\Helper\Core;
use App\Repositories\TransActionGlobalRepository;
use App\TypeModelTransAction;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Payment\Entities\PaymentSetting;
use Modules\Payment\Entities\TransAction;

class TransActionsController extends Controller
{


    protected $model;

    public function __construct(TransActionGlobalRepository $model)
    {
        $this->model = $model;
    }


    public function index()
    {
        auth()->user()->can('Payment.index') ? '' : abort(403);

        $type = \request('type', '');

        $data = TransAction::with('user', 'order');

        if ($type == 'admin') {
            $data = $data->where('type_model', TypeModelTransAction::Admin);

        }


        $data = $data->orderBy('id', 'desc')->get();

        return view('payment::trans_action.index', compact('data'));
    }


}
