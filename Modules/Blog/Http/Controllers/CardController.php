<?php

namespace Modules\Blog\Http\Controllers;

use App\Helper\Core;


use App\PaymentType;
use App\Repositories\ArticleRepository;
use App\Repositories\BaseRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\DoctorRepository;
use App\Repositories\PatientRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\Product\CardRepository;
use App\Repositories\Product\OrderRepository;
use App\Repositories\Product\ProductBrandRepository;
use App\Repositories\Product\ProductCategoryRepository;
use App\Repositories\Product\ProductRepository;

use App\Repositories\Product\ProductSettingRepository;
use App\Repositories\SpecialRepository;
use App\Repositories\WalletRepository;
use App\Status;
use App\TypeModelTransAction;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleComment;
use Modules\Article\Entities\ArticleTag;
use Modules\Category\Entities\Category;
use Modules\Doctor\Entities\Doctor;
use Modules\Faq\Entities\Faq;
use Modules\Page\Entities\Page;
use Modules\Patient\Entities\Patient;
use Modules\Product\Entities\ProductBrand;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Entities\ProductSetting;
use Modules\Setting\Entities\ContactUs;
use Modules\Setting\Entities\Setting;
use Modules\Special\Entities\Special;
use Modules\State\Entities\City;
use Modules\Team\Entities\Team;

class CardController extends Controller
{

    protected $cardRepository;
    protected $ProductSettingRepository;
    protected $order;
    protected $payment;
    protected $wallet;
    protected $patient;

    public function __construct(CardRepository $cardRepository, ProductSettingRepository $ProductSettingRepository,
                                OrderRepository $order, PaymentRepository $payment, WalletRepository $wallet, PatientRepository $patient
    )
    {
        $this->cardRepository = $cardRepository;
        $this->ProductSettingRepository = $ProductSettingRepository;
        $this->order = $order;
        $this->payment = $payment;
        $this->wallet = $wallet;
        $this->patient = $patient;

    }


    public function payment_card(Request $request)
    {
        $user = Auth::guard('patient')->user();
        $user_id = Auth::id();
        $price = (int)$user->TotalPriceProduct();
        $type = $request->type;
        $data = $request->except('proengsoft_jsvalidation', '_token');
        $detail_user = $data['name'] . '<hr>شماره تماس : ' . $data['mobile'] . ' <hr>کد پستی : ' . $data['postal_code'] . ' <hr>آدرس : ' . $data['address'];
        $order = $this->order->AddOrder($user_id, $detail_user);


        if ($order != Status::False) {

            if ($type == 'wallet') {
                $wallet = $this->patient->MyWallet($user_id);

                if ($wallet < (int)$price)
                    return redirect()->back()->with('error', 'اعتبار کیف پول شما کافی نیست ');


                $res = $this->wallet->PayProductWithWallet($user_id, $price, $order->id);


                return redirect(route('patient.orders'))->with('success', 'با موفقیت پرداخت انجام شد');
                return Core::false();

            } else {
                $result = $this->payment->ZarinPalPayment($user_id, $price, $order->id, PaymentType::ADDProduct, TypeModelTransAction::Patient, PaymentType::ADDProduct);
                if ($result != Status::False) {
                    return redirect($result);
                }
            }

            return redirect()->route('patient.dashboard')->with('success');
        } else {
            return Core::false();
        }

    }



    public function card_checkout()
    {
        $user_id = Auth::id();

        $data = $this->cardRepository->GetBasket($user_id)->get();
        $product_setting = $this->ProductSettingRepository->getById(1);


        if ((int)Auth::guard('patient')->user()->TotalPriceProduct() == 0)
            return redirect()->route('patient.dashboard');


        return view('blog::page.product_checkout', compact('data', 'product_setting'));

    }


    public function card_checkout_pay()
    {
        $user_id = Auth::id();

        $data = $this->cardRepository->GetBasket($user_id)->get();
        $product_setting = $this->ProductSettingRepository->getById(1);

        if ((int)Auth::guard('patient')->user()->TotalPriceProduct() == 0)
            return redirect()->route('patient.dashboard');


        return view('blog::page.checkout', compact('data', 'product_setting'));
    }

    public function RemoveFromCard()
    {
        $user_id = Auth::id();
        $product_id = \request('product_id');
        $count = \request('count');
        $item = $this->cardRepository->RemoveFromBasket($user_id, $product_id, $count);

        if ($item)
            return Core::true();


        return Core::false();
    }

    public function RemoveItemCard()
    {

        $user_id = Auth::id();
        $product_id = \request('product_id');
        $count = \request('count');
        $item = $this->cardRepository->RemoveBasket($user_id);


        if ($item)
            return Core::true();


        return Core::false();

    }

    public function addToCard()
    {
        $user_id = Auth::id();
        $product_id = \request('product_id');
        $count = \request('count');
        $count = $count < 2 ? 1 : $count;

        $item = $this->cardRepository->AddToBasket($user_id, $product_id, $count);


        if ($item)
            return Core::true();

        return Core::false();


    }


}
