<?php

namespace Modules\Payment\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Payment\Entities\PaymentSetting;

class PaymentSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        auth()->user()->can('Payment.index') ? '' : abort(403);

        $data = PaymentSetting::first() ? PaymentSetting::first() : PaymentSetting::create(['merchant_id' => '0']);

        return view('payment::setting.index', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Payment.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');

        $item = PaymentSetting::first();

        if ($item->update($data)) {
            return Core::true();
        } else {
            return Core::false();

        }

    }


}
