<?php

namespace Modules\Blog\Http\Controllers;

use App\Helper\Core;
use App\Helper\ZarinPal;
use App\Interfaces\IPaymentRepository;
use App\OrderStatus;
use App\PaymentType;
use App\Repositories\DoctorReservedOrderRepository;
use App\Repositories\PatientRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\Product\OrderRepository;
use App\Repositories\Product\ProductFavoriteRepository;
use App\Repositories\Service\ServiceReserveRepository;
use App\Repositories\TransActionGlobalRepository;
use App\Repositories\WalletRepository;
use App\Status;
use App\TypeModelTransAction;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleComment;
use Modules\Article\Entities\ArticleTag;
use Modules\Clinic\Entities\Clinic;
use Modules\Doctor\Entities\Chat;
use Modules\Doctor\Entities\DocorScheduleTime;
use Modules\Doctor\Entities\Doctor;
use Modules\Doctor\Entities\DoctorAchivment;
use Modules\Doctor\Entities\DoctorContact;
use Modules\Doctor\Entities\DoctorEducation;
use Modules\Doctor\Entities\DoctorExpience;
use Modules\Doctor\Entities\DoctorReserved;
use Modules\Doctor\Entities\FavoriteDoctor;
use Modules\Patient\Entities\Patient;
use Modules\Payment\Entities\TransAction;
use Modules\Service\Entities\ServiceReserve;
use Modules\Setting\Entities\Setting;
use Modules\State\Entities\State;
use phpDocumentor\Reflection\Types\This;
use stdClass;

class PatientBlogController extends Controller
{


    protected $pateint;
    protected $payment;
    protected $orderRepository;
    protected $doctorReservedOrderRepository;
    protected $wallet;
    protected $ProductFavoriteRepository;
    protected $serviceReserveRepository;


    public function __construct(
        ServiceReserveRepository $serviceReserveRepository,
        PatientRepository $pateint,
        PaymentRepository $payment,
        OrderRepository $orderRepository,
        DoctorReservedOrderRepository $doctorReservedOrderRepository,
        WalletRepository $wallet,
        ProductFavoriteRepository $ProductFavoriteRepository
    ) {
        $this->pateint = $pateint;
        $this->payment = $payment;
        $this->orderRepository = $orderRepository;
        $this->doctorReservedOrderRepository = $doctorReservedOrderRepository;
        $this->wallet = $wallet;
        $this->ProductFavoriteRepository = $ProductFavoriteRepository;
        $this->serviceReserveRepository = $serviceReserveRepository;
    }


    public function reviews()
    {

        $data = $this->pateint->MyComments(Auth::id());


        return view('blog::page.patient.reviews', compact('data'));
    }
    public function perdiodReminder()
    {
        $data['item'] =  auth()->user();
       
        if ( $data['item']->period_at) {
            $data['time'] =  Core::persianDate( $data['item']->period_at, false);
        }
        return view('blog::page.patient.period_reminder', $data);
    }

    function perdiodReminderUpdateInfo(Request $request)
    {
        $patient  =  auth()->user();
        $patient->period_days  = $request->period_days;
        $date = Core::persian_to_en_date($request->date);

        $patient->period_at  = $date;
        $patient->save();
        return Core::true('با موفقیت ذخیره شد');
    }

    public function payment_service_wallet($id)
    {
        $user_id = Auth::id();
        $wallet = $this->pateint->MyWallet($user_id);

        $item = $this->serviceReserveRepository->getById($id);

        if (empty($item) || (int)$item->price < 500)
            return Core::false();
        if ($wallet < (int)$item->price)
            return redirect()->back()->with('error', 'اعتبار کیف پول شما کافی نیست ');


        $result = $this->wallet->PayServiceReservedWithWallet($user_id, $id);

        if ($result)
            return Core::true();

        return Core::false();
    }

    public function payment_wallet($id)
    {
        $user_id = Auth::id();
        $wallet = $this->pateint->MyWallet($user_id);

        $item = $this->doctorReservedOrderRepository->getById($id);


        if (empty($item) || (int)$item->price < 500)
            return Core::false();
        if ($wallet < (int)$item->price)
            return redirect()->back()->with('error', 'اعتبار کیف پول شما کافی نیست ');


        $result = $this->wallet->PayReservedWithWallet($user_id, $id);

        if ($result)
            return Core::true();

        return Core::false();
    }

    public function add_product_favorite($id)
    {
        $user_id = Auth::id();
        $res = $this->ProductFavoriteRepository->AddProduct(['user_id' => $user_id, 'product_id' => $id]);

        if ($res)
            return Core::true();


        return Core::false();
    }


    public function favorite_product()
    {
        $user_id = Auth::id();


        $data = $this->ProductFavoriteRepository->Get()->where('user_id', $user_id)->get();

        return view('blog::page.patient.favorite_product', compact('data'));
    }

    public function remove_product_favorite($id)
    {
        $user_id = Auth::id();
        $res = $this->ProductFavoriteRepository->RemoveProduct(['user_id' => $user_id, 'product_id' => $id]);

        if ($res)
            return Core::true();


        return Core::false();
    }

    public function payment_service($id)
    {
        $item = ServiceReserve::find($id);

        if (empty($item) || (int)$item->price < 500)
            return Core::false();

        //$user_id, $price, $order_id, $title = "payment", $ModelType = TypeModelTransAction::Patient, $type = PaymentType::ADDPayment
        $result = $this->payment->ZarinPalPayment($item->patient_id, (int)$item->price, $item->id, PaymentType::ADDService, TypeModelTransAction::Patient, PaymentType::ADDService);
        if ($result != Status::False) {
            return redirect($result);
        }
        return Core::false();
    }

    public
    function payment($id)
    {

        $item = DoctorReserved::find($id);


        if (empty($item) || (int)$item->price < 500)
            return Core::false();

        //$user_id, $price, $order_id, $title = "payment", $ModelType = TypeModelTransAction::Patient, $type = PaymentType::ADDPayment
        $result = $this->payment->ZarinPalPayment($item->client_id, (int)$item->price, $item->id, PaymentType::ADDPayment, TypeModelTransAction::Patient, PaymentType::ADDPayment);
        if ($result != Status::False) {
            return redirect($result);
        }
        return Core::false();
    }


    public
    function orders()
    {
        $user_id = Auth::id();

        $data = $this->orderRepository->GetUserOrders($user_id)->get();
        $this->check_orders_reserves();

        return view('blog::page.patient.orders', compact('data'));
    }

    public
    function result_pay()
    {
        $TransAction = \request('Authority');

        $result = $this->payment->CheckPaymentResult($TransAction);

        if ($result == Status::False) {
            return redirect()->route('patient.dashboard')->with('error', 'خطا در پرداخت');
        }

        return redirect()->route('patient.dashboard')->with('success', 'پرداخت شما با موفقیت انجام شد');
    }


    public
    function schedule_time_delete($id)
    {

        $item = DocorScheduleTime::find($id);

        if ($item->delete())
            return Core::true();
        else
            return Core::false();
    }


    public
    function transAction()
    {
        $data = $this->pateint->MyTransActions(Auth::id());


        return view('blog::page.patient.transactions', compact('data'));
    }

    public
    function wallet_charge()
    {
        $user_id = Auth::id();
        $price = \request('price', 0);
        $price = (int)str_replace(",", "", $price);
        if ($price < 500)
            return Core::false();

        //$user_id, $price, $order_id, $title = "payment", $ModelType = TypeModelTransAction::Patient, $type = PaymentType::ADDPayment
        $result = $this->payment->ZarinPalPayment(
            $user_id,
            $price,
            0,
            PaymentType::ADDWallet,
            TypeModelTransAction::Patient,
            PaymentType::ADDWallet
        );
        if ($result != Status::False) {
            return redirect($result);
        }
        return Core::false();
    }

    public
    function wallet()
    {
        $user_id = Auth::id();
        $data = $this->pateint->MyWallet($user_id);
        $prices = [10000, 20000, 25000, 30000, 35000, 50000];
        return view('blog::page.patient.wallet', compact('data', 'prices'));
    }

    public
    function reserved_time_reserve()
    {
        $date = \request('date', null);
        $time = \request('time', null);
        $user_id = Auth::id();

        $item = DoctorReserved::where(['user_id' => $user_id, 'time' => $time, 'date' => Core::persian_to_en_date($date)])->first();

        if ($item) {
            $item->delete();
        } else
            $item = DoctorReserved::create(['user_id' => $user_id, 'time' => $time, 'date' => Core::persian_to_en_date($date)]);


        if ($item)
            return Core::true();
        else
            return Core::false();
    }

    public   function reserved_time()
    {

        $date = \request('date', null);

        if (empty($date)) {
            $en_date = Carbon::now();
            $date = Core::persianDate($en_date, false);
        } else {
            $en_date = Core::persian_to_en_date($date);
        }

        $data = DoctorReserved::where(['user_id' => Auth::id()])->whereDate('date', $en_date)->get();


        return view('blog::page.doctor.reserved_time', compact('date', 'data'));
    }

    public
    function favorite()
    {
        $user_id = Auth::guard('patient')->id();


        $data = FavoriteDoctor::where('user_id', $user_id)->orderBy('id', 'desc')->with('doctor')->get();


        return view('blog::page.patient.favorite', compact('data'));
    }


    public
    function side_bar_chat_view()
    {

        $search = \request('search', '');
        $doc_id = \request('doc_id', null);
        $patient_id = \request('p_id', null);


        $data = Chat::where('patient_id', $patient_id)->select('doc_id')->distinct('doc_id');


        //        ->addSelect('id')->orderBy('id', 'desc');


        if ((int)$doc_id != 0) {
            $data = $data->where('doc_id', $doc_id);
        }


        if (!empty($search)) {
            $data = $data->whereHas('doctor', function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
                $q->orWhere('family', 'LIKE', '%' . $search . '%');
            });
        }


        //->groupBy('doc_id')->havingRaw('COUNT(*) > 1')
        $data = $data->get();


        return view('blog::ajax_item.chat_side_bar', compact('data'));
    }

    public
    function content_chat_view()
    {
        $doc_id = \request('doc_id', null);
        $patient_id = \request('p_id', null);
        $sender_id = $patient_id;


        $data = Chat::where('patient_id', $patient_id)->orderBy('id', 'asc');


        $data = $data->get();

        return view('blog::ajax_item.chat_content', compact('data', 'doc_id', 'patient_id', 'sender_id'));
    }

    public
    function chats()
    {


        $doc_id = \request('doc_id', null);

        if (Session::has('doc_id'))
            $doc_id = Session::get('doc_id');


        return view('blog::page.patient.chat', compact('doc_id'));
    }

    public
    function chat_post(Request $request)
    {
        $data = $request->except('_token', 'file');

        if (empty($data['text']) && !isset($request->file))
            return Core::false();


        $file = $request->file;
        if (isset($file)) {
            $destination_path = base_path() . '/public_html/files';
            $destination_path = public_path() . '/files';
            //            $destination_path = str_replace('public', 'public_html', $destination_path);

            $extentions = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extentions;
            $file->move($destination_path, $fileName);
        } else {
            $fileName = "";
        }
        $data['file_name'] = $fileName;
        $data['seen'] = 0;
        $item = Chat::create($data);
        if ($item)
            return redirect()->route('patient.chats')->with(['success' => 'success', 'doc_id' => $data['doc_id']]);


        return Core::false();
    }

    public
    function chat_store($id)
    {
        $user_id = Auth::guard('patient')->id();

        $data['sender_id'] = $user_id;
        $data['patient_id'] = $user_id;
        $data['doc_id'] = $id;
        $doc_id = $id;
        $data = Chat::updateOrCreate($data, $data);

        return view('blog::page.patient.chat', compact('id', 'doc_id'));
    }

    public
    function favorite_store($id)
    {
        $user_id = Auth::guard('patient')->id();

        $check = FavoriteDoctor::where(['user_id' => $user_id, 'doc_id' => $id])->first();
        if ($check)
            if ($check->delete())
                return Core::true();


        $item = FavoriteDoctor::create(['user_id' => $user_id, 'doc_id' => $id]);
        if ($item)
            return redirect(route('patient.favorite'))->with('success');
        else
            return Core::false();
    }

    public
    function schedule_time()
    {

        $data = DocorScheduleTime::where('doc_id', Auth::id())->get();

        return view('blog::page.doctor.schedule_time', compact('data'));
    }

    public
    function reserve_destroy($id)
    {
        $item = DoctorReserved::find($id);

        if ($item->delete()) {
            return Core::true();
        } else {
            return Core::false();
        }
    }

    public
    function schedule_time_post(Request $request)
    {

        $data = $request->except('_token');
        $data['doc_id'] = Auth::id();


        $item = DocorScheduleTime::create($data);
        if ($item)
            return Core::true();
        else
            return Core::false();
    }

    public function factor_service($id)
    {
        $setting = Setting::first();

        $data = ServiceReserve::find($id);


        return view('blog::page.patient.service_factor', compact('data', 'setting'));
    }

    public
    function factor($id)
    {
        $user_id = Auth::guard('patient')->id();

        $data = DoctorReserved::find($id);

        $setting = Setting::first();


        return view('blog::page.patient.factor', compact('data', 'setting'));
    }

    public function orders_service()
    {
        $user_id = Auth::guard('patient')->id();

        $service_reserve = ServiceReserve::where(['patient_id' => $user_id])->orderBy('id', 'desc')->get();
        $this->check_orders_reserves();


        return view('blog::page.patient.orders_service', compact('service_reserve'));
    }

    public
    function dashboard()
    {

        $user_id = Auth::guard('patient')->id();


        $this->check_orders_reserves();

        $reserves = DoctorReserved::where('client_id', $user_id)->orderBy('id', 'desc')->take(10)->get();

        $service_reserve = ServiceReserve::where(['patient_id' => $user_id])->orderBy('id', 'desc')->take(10)->get();


        //        return  Auth::user();
        return view('blog::page.patient.dashboard', compact('reserves', 'service_reserve'));
    }

    public
    function reserves()
    {

        $user_id = Auth::guard('patient')->id();

        $data = DoctorReserved::where('client_id', $user_id)->orderBy('id', 'desc')->get();

        return view('blog::page.patient.reserves', compact('data'));
    }

    public
    function profile_post(Request $request)
    {
        $data = $request->except('_token', 'proengsoft_jsvalidation', 'image', 'step');


        $data['birth_day'] = Core::persian_to_en_date($data['birth_day']);
        $item = Patient::find(Auth::id());
        $item->update($data);
        if ($request->image) {
            Core::SaveImage($request->image, 'PatientAvatar', $item->id);
        }


        if ($item)
            return Core::true();
        else
            return Core::false();
    }

    public
    function profile()
    {
        $data = Auth::user();


        $states = State::orderBy('title')->get();


        return view('blog::page.patient.profile', compact(
            'data',
            'states'
        ));
    }

    public
    function change_password_post(Request $request)
    {
        $data = $request->except('_token', 'proengsoft_jsvalidation');
        if (Hash::check($request->current_password, Auth::user()->password)) {
            $password = Hash::make($request->password);
            $user = Patient::find(Auth::id())->update(['password' => $password]);
            return Core::true();
        } else {

            return Core::false();
        }
    }

    public
    function change_password()
    {
        $data = Auth::user();


        return view('blog::page.patient.change_password ', compact('data'));
    }

    public
    function patient_logout()
    {
        if (Auth::guard('patient')->check())
            Auth::logout();

        return redirect(route('index'))->with('success', '');
    }

    private function check_orders_reserves()
    {

        $user_id = Auth::guard('patient')->id();

        $currentDateTime = Carbon::now();

        $twentyMinutesAgo = $currentDateTime->subMinutes(20);

        DoctorReserved::where('client_id', $user_id)
            ->where('created_at', '<', $twentyMinutesAgo)
            ->where(function ($query) {
                $query->where('status', '<>', Status::Success)
                    ->orWhereNull('status');
            })
            ->delete();


        ServiceReserve::where('patient_id', $user_id)
            ->where('created_at', '<', $twentyMinutesAgo)
            ->where(function ($query) {
                $query->where('status', '<>', OrderStatus::Unpaid)
                    ->orWhereNull('status');
            })
            ->delete();
    }
}
