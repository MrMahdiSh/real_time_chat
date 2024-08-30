<?php

namespace App\Http\Controllers;

use App\AllTable;
use App\BrandTable;
use App\BranOldTable;
use App\ModelTable;
use App\Repositories\DoctorRepository;
use App\Repositories\Product\CertificatePharmacyRepository;
use App\Repositories\Product\OrderRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\TransActionGlobalRepository;
use App\Status;
use App\TypeModelTransAction;
use App\TypeTable;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

use Matrix\Exception;
use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleComment;
use Modules\Doctor\Entities\Doctor;
use Modules\Doctor\Entities\DoctorRate;
use Modules\Package\Entities\UserFile;
use Modules\Patient\Entities\Patient;
use Modules\Payment\Entities\Payment;
use Modules\Payment\Entities\TransAction;
use Modules\Product\Entities\CertificatePharmacy;
use Modules\Service\Entities\ServiceModel;
use Modules\Setting\Entities\ContactUs;
use Modules\Setting\Entities\Setting;
use Modules\Ticket\Entities\Ticket;
use Spatie\Activitylog\Models\Activity;

class AuthController extends Controller
{

    protected $orderRepository;
    protected $product;
    protected $transActions;
    protected $doctor;
    protected $certificatePharmacy;

    public function __construct(CertificatePharmacyRepository $certificatePharmacy, DoctorRepository $doctor, OrderRepository $orderRepository, TransActionGlobalRepository $transActions, ProductRepository $product)
    {
        $this->orderRepository = $orderRepository;
        $this->product = $product;
        $this->transActions = $transActions;
        $this->doctor = $doctor;
        $this->certificatePharmacy = $certificatePharmacy;
    }

    public function clear()
    {
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('optimize:clear');
        return 'done';
    }

    public function link()
    {
        symlink('/home/......./storage/app/public', '/home/...../public_html/storage');
        symlink(storage_path() . "/app/public", base_path() . "/public_html/storage");
        symlink(storage_path() . "/app/public", base_path() . "/public/storage");
    }


    public function log_clear()
    {
        $role = auth()->user()->getRoleNames()[0];
        if ($role == 'super_admin') {
            $logs = Activity::get();
            foreach ($logs as $item) {

                Activity::find($item->id)->delete();

            }
        }


        return redirect()->back();
    }


    public function dashboard()
    {

        $CertificatePharmacies = $this->certificatePharmacy->Get()->where('status', "<>", Status::True)->count();
        $contact_us = ContactUs::where('seen', '0')->get()->count();
        $article_comments = ArticleComment::where('status', '0')->get()->count();
        $doctor_rate = DoctorRate::where('answers', '=', null)->orWhere('answers', '')->orWhere('status', '<>', Status::Success)->orderBy('id', 'desc')->get()->count();
        $pay_request = Payment::where('status', '0')->get()->count();

        $product_confirm = $this->product->Get()->where('status', Status::False)->get();


        $services = ServiceModel::where('status', Status::False)->count();


        $orders = $this->orderRepository->GetAllOrder()->take(5)->get();

        $doctors = Doctor::get()->count();


        $income = $this->transActions->GetAll(1, TypeModelTransAction::Admin)->sum('price');

        $patients = Patient::orderBy('id', 'desc')->take(5)->get();
//        activity()->log('ثبت کاربر');

        $comments = ArticleComment::orderBy('id', 'desc')->take(5)->get();
        $tickets = Ticket::where('text', '<>', '')->where('text', '<>', null)->where('seen_admin', 1)->take(5)->get();

        $article_status = Article::where('status', '0')->get()->count();

        $setting = Setting::first();


        $activate_doctor = $this->doctor->Get()->where('active', Status::False)->orderBy('id')->get();


        return view('dashboard', compact('services', 'CertificatePharmacies', 'activate_doctor', 'income', 'product_confirm', 'orders', 'setting', 'article_status', 'tickets', 'comments', 'contact_us', 'doctor_rate', 'article_comments', 'pay_request', 'income', 'doctors', 'patients'));

    }

    public function login()
    {

//        try {
//            Artisan::call('config:clear');
//            Artisan::call('route:clear');
//            Artisan::call('cache:clear');
//            Artisan::call('view:clear');
//            Artisan::call('optimize:clear');
//        } catch (Exception $e) {
//        }

        return view('auth.login');
    }

    public function login_post(Request $request)
    {
        
        $credentials = $request->except('_token', 'proengsoft_jsvalidation');


        if (Auth::attempt($credentials)) {
            $user = User::where('username', $request->get('username'))->with('roles')->first();
            if ($user->roles->first()->name == "user") return "false";
            Auth::login($user);
//            $accessToken = $user->createToken('UserToken')->accessToken;

// dd();
//            return ['token'=>$accessToken];
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with(['error' => 'نام کاربری و یا رمز عبور اشتباه است']);
        }


    }

    public function test()
    {
        return \auth()->user();

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');

    }
}
