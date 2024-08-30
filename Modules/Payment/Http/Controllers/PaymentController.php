<?php

namespace Modules\Payment\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Payment\Entities\Payment;
use Modules\Payment\Entities\PaymentSetting;
use Modules\Payment\Entities\TransAction;

class PaymentController extends Controller
{

    public function index()
    {
        auth()->user()->can('Payment.index') ? '' : abort(403);

        $data = Payment::orderBy('id', 'desc')->get();


        return view('payment::payment.index', compact('data'));
    }

    public function show($id)
    {

        auth()->user()->can('Payment.edit') ? '' : abort(403);
        $item = Payment::find($id);

        $st = !$item->status;

        if ($item->update(['status' => (int)$st]))
            return Core::true();


        return Core::false();


    }

}
