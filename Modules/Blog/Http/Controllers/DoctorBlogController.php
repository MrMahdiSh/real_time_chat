<?php

namespace Modules\Blog\Http\Controllers;

use App\Helper\Core;

use App\OrderStatus;
use App\Repositories\DoctorRepository;
use App\Repositories\Product\CertificatePharmacyRepository;
use App\Repositories\Product\OrderProductDetailRepository;
use App\Repositories\Product\OrderRepository;
use App\Repositories\Product\PharmacyRepository;
use App\Repositories\Product\ProductBrandRepository;
use App\Repositories\Product\ProductCategoryRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Service\ServiceCategoryRepository;
use App\Repositories\Service\ServiceModelRepository;
use App\Repositories\TransActionGlobalRepository;
use App\Status;
use App\TypeModelTransAction;
use App\User;
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
use Modules\Article\Entities\ArticleCategory;
use Modules\Article\Entities\ArticleComment;
use Modules\Article\Entities\ArticleTag;
use Modules\Category\Entities\Category;
use Modules\Clinic\Entities\Clinic;
use Modules\Doctor\Entities\Chat;
use Modules\Doctor\Entities\DocorScheduleTime;
use Modules\Doctor\Entities\Doctor;
use Modules\Doctor\Entities\DoctorAccount;
use Modules\Doctor\Entities\DoctorAchivment;
use Modules\Doctor\Entities\DoctorContact;
use Modules\Doctor\Entities\DoctorEducation;
use Modules\Doctor\Entities\DoctorExpience;
use Modules\Doctor\Entities\DoctorRate;
use Modules\Doctor\Entities\DoctorReserved;
use Modules\Doctor\Entities\DoctorSetting;
use Modules\News\Entities\News;
use Modules\Payment\Entities\Payment;
use Modules\Product\Entities\OrderProductDetail;
use Modules\Product\Entities\ProductBrand;
use Modules\Product\Entities\ProductCategory;
use Modules\Service\Entities\ServiceRate;
use Modules\Service\Entities\ServiceReserve;
use Modules\Setting\Entities\Setting;
use Modules\State\Entities\State;
use Modules\Team\Entities\Team;
use Modules\Ticket\Entities\Ticket;

class DoctorBlogController extends Controller
{

    protected $product;
    protected $productBrand;
    protected $productCategory;
    protected $doctorRepository;
    protected $orderDetail;
    protected $orders;
    protected $transActions;
    protected $pharmacyRepository;
    protected $certificatePharmacy;
    protected $serviceCategoryRepository;
    protected $serviceModelRepository;


    public function __construct(
        ServiceModelRepository $serviceModelRepository,
        ServiceCategoryRepository $serviceCategoryRepository,
        CertificatePharmacyRepository $certificatePharmacy,
        PharmacyRepository $pharmacyRepository,
        ProductRepository $product,
        ProductCategoryRepository $productCategory,
        TransActionGlobalRepository $transActions,
        ProductBrandRepository $productBrand,
        DoctorRepository $doctorRepository,
        OrderProductDetailRepository $orderDetail,
        OrderRepository $orders
    ) {
        $this->serviceModelRepository = $serviceModelRepository;
        $this->product = $product;
        $this->productBrand = $productBrand;
        $this->productCategory = $productCategory;
        $this->doctorRepository = $doctorRepository;
        $this->orderDetail = $orderDetail;
        $this->orders = $orders;
        $this->transActions = $transActions;
        $this->pharmacyRepository = $pharmacyRepository;
        $this->certificatePharmacy = $certificatePharmacy;
        $this->serviceCategoryRepository = $serviceCategoryRepository;
    }


    public function service_list()
    {
        $user_id = Auth::guard('doctor')->id();

        $data = $this->serviceModelRepository->Get()->where('doctor_id', $user_id)->orderBy('status')->get();

        return view('blog::page.doctor.service_list', compact('data'));
    }

    public function service_update(Request $request, $id)
    {
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation', 'step');

        $data['status'] = Status::False;


        $item = $this->serviceModelRepository->update($id, $data);

        if ($item) {


            if ($request->image) {
                Core::SaveImage($request->image, 'Service', $id);
            }
            return Core::true();
        }

        return Core::false();
    }

    public function service_edit($id)
    {
        $data = $this->serviceModelRepository->getById($id);

        $categories = $this->serviceCategoryRepository->GetCategories()->get();

        return view('blog::page.doctor.service_edit', compact('data', 'categories'));
    }

    public function service_add_post(Request $request)
    {
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation', 'step');

        $user_id = Auth::guard('doctor')->id();
        $data['doctor_id'] = $user_id;

        $item = $this->serviceModelRepository->create($data);

        if ($item) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Service', $item->id);
            }
            return Core::true();
        }

        return Core::false();
    }

    public function service_add()
    {
        $categories = $this->serviceCategoryRepository->GetCategories()->get();

        return view('blog::page.doctor.service_add', compact('categories'));
    }


    public function product_post(Request $request)
    {
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation', 'step');


        if (!Auth::guard('doctor')->user()->certificateDragStore())
            return Core::false();

        $data['number'] = rand(1111, 9999999);
        $data['doctor_id'] = Auth::id();

        $insert = $this->product->create($data);
        if ($insert) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Product', $insert->id);
            }
            return Core::true();
        }
        return Core::false();
    }

    public function product_edit($id)
    {
        if (!Auth::guard('doctor')->user()->certificateDragStore())
            return Core::false();

        $data = $this->product->getById($id);

        return view('blog::page.doctor.product_edit', compact('data'));
    }

    public function product_update(Request $request, $id)
    {

        if (!Auth::guard('doctor')->user()->certificateDragStore())
            return Core::false();

        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation', 'step');
        $data['status'] = Status::False;
        $update = $this->product->update($id, $data);

        if ($update) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Product', $id);
            }
            Core::true();
        }
        return Core::false();
    }

    public function service_orders()
    {
        $data = Auth::guard('doctor')->user()->services()->get();


        return view('blog::page.doctor.orders_service', compact('data'));
    }

    public function orders()
    {

        if (!Auth::guard('doctor')->user()->certificateDragStore())
            return Core::false();

        $user_id = Auth::id();
        $data = $this->orderDetail->Get()->whereHas('order', function ($query) {
            $query->where('status', '<>', OrderStatus::Unpaid);
        })
            ->where('doctor_id', $user_id)
            ->with('order')
            ->get()
            ->groupBy('order_id');

        return view('blog::page.doctor.orders', compact('data'));
    }

    public function transactions()
    {

        $user_id = Auth::id();

        $data = $this->transActions->GetAll($user_id, TypeModelTransAction::Doctor);


        return view('blog::page.doctor.transactions', compact('data'));
    }

    public function order_status($id)
    {
        $item = $this->orders->UpdateOrder($id, OrderStatus::Delivered);

        if ($item)
            return Core::true();


        return Core::false();
    }

    public
    function product_list()
    {
        if (!Auth::guard('doctor')->user()->certificateDragStore())
            return Core::false();

        $data = $this->doctorRepository->GetProducts(Auth::id());


        return view('blog::page.doctor.product_list', compact('data'));
    }

    public
    function product()
    {

        $categories = $this->productCategory->getAll();
        $brands = $this->productBrand->getAll();


        return view('blog::page.doctor.product', compact('categories', 'brands'));
    }

    public
    function article_edit($id)
    {
        $data = Article::with('media')->where(['writer_id' => Auth::id(), 'id' => $id])->first();
        if (empty($data))
            return redirect()->route('index');

        $categories = ArticleCategory::where('status', '1')->get();
        $tags = ArticleTag::where('status', '1')->get();

        return view('blog::page.doctor.article_edit', compact('data', 'categories', 'tags'));
    }

    public
    function article_update_comments(Request $request, $blog_id, $id)
    {

        $item = ArticleComment::where(['blog_id' => $blog_id, 'id' => $id])->first();

        if ($item->update([

            'replay' => $request->replay
        ]))
            return Core::true();

        return Core::false();
    }

    public
    function article_comments($id)
    {

        $data = ArticleComment::where('blog_id', $id)->get();


        return view('blog::page.doctor.article_comments', compact('data'));
    }

    public
    function article_post(Request $request)
    {
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation', 'step');
        $data['status'] = '0';
        $data['writer_id'] = Auth::id();
        $data['tags'] = isset($data['tags']) ? json_encode($data['tags']) : '';
        $insert = Article::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'Article', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }

    public
    function article_delete($id)
    {

        if (Article::find($id)->delete()) {
            return Core::true();
        } else
            return Core::false();
    }

    public
    function article_update(Request $request, $id)
    {
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation', 'step');
        $data['status'] = '0';

        $data['tags'] = isset($data['tags']) ? json_encode($data['tags']) : '';
        $insert = Article::find($id);

        if ($insert->update($data)) {

            if ($request->image) {
                Core::SaveImage($request->image, 'Article', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }

    public
    function article()
    {
        $categories = ArticleCategory::where('status', '1')->get();
        $tags = ArticleTag::where('status', '1')->get();

        return view('blog::page.doctor.article_create', compact('categories', 'tags'));
    }

    public
    function articles()
    {


        $articles = Auth::user()->articles;
        return view('blog::page.doctor.articles', compact('articles'));
    }


    public
    function doctor_profile()
    {
        // dd("ddd");
        $id = \request('id', null);
        $data = Doctor::find($id);


        $today = Carbon::now()->englishDayOfWeek;
        $today_schedule = DocorScheduleTime::where(['week' => $today, 'doc_id' => $id])->first();
        $Saturday = DocorScheduleTime::where('week', 'Saturday')->where('doc_id', $id)->first();
        $Sunday = DocorScheduleTime::where('week', 'Sunday')->where('doc_id', $id)->first();
        $Monday = DocorScheduleTime::where('week', 'Monday')->where('doc_id', $id)->first();
        $Tuesday = DocorScheduleTime::where('week', 'Tuesday')->where('doc_id', $id)->first();
        $Wednesday = DocorScheduleTime::where('week', 'Wednesday')->where('doc_id', $id)->first();
        $Thursday = DocorScheduleTime::where('week', 'Thursday')->where('doc_id', $id)->first();
        $Friday = DocorScheduleTime::where('week', 'Friday')->where('doc_id', $id)->first();


        return view('blog::page.doctor_profile', compact(
            'data',
            'today_schedule',
            'Saturday',
            'Sunday',
            'Monday',
            'Thursday',
            'Wednesday',
            'Friday',
            'Tuesday'
        ));
    }

    public
    function reserved()
    {
        $id = \request('id', null);
        if ((int)$id == 0) return redirect()->back();

        $data = Doctor::find($id);


        $now = Carbon::now();
        $weekStartDate = Carbon::parse('saturday');
        if (!$now->isSaturday()) {
            $weekStartDate = $weekStartDate->subDays(7);
        }


        $full_date = DoctorReserved::where(['user_id' => $id])
            ->where('status', 'success')->get();


        return view('blog::page.doctor_reserved', compact('data', 'now', 'weekStartDate', 'full_date'));
    }

    public
    function doctor_service_reserved()
    {
        $service_id = \request('service_id', null);
        $doctor_id = \request('doctor_id', null);
        $client_id = Auth::guard('patient')->id();


        if ((int)$service_id == 0 || (int)$doctor_id == 0) return redirect()->back();

        $data = Doctor::find($doctor_id);


        $now = Carbon::now();
        $weekStartDate = Carbon::parse('saturday');
        if (!$now->isSaturday()) {
            $weekStartDate = $weekStartDate->subDays(7);
        }


        $full_date = ServiceReserve::where(['patient_id' => $client_id])
            ->where('status', 'success')->get();


        return view('blog::page.doctor_service_reserved', compact('data', 'now', 'weekStartDate', 'full_date'));
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

    public function reserved_time_reserve()
    {
        if (!session('backToAdminSession')) {
            abort(403);
        }
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

    public
    function setting()
    {
        $data = DoctorSetting::updateOrCreate(['doc_id' => Auth::guard('doctor')->id()], ['doc_id' => Auth::guard('doctor')->id()]);


        return view('blog::page.doctor.setting', compact('data'));
    }

    public
    function setting_post(Request $request)
    {

        $data = $request->except('_token', 'proengsoft_jsvalidation', 'image');

        $item = DoctorSetting::updateOrCreate(['doc_id' => Auth::guard('doctor')->id()], $data);
        if ($item) {
            if ($request->image) {
                Core::SaveImage($request->image, 'DoctorFactorMedia', $item->id);
            }
            return Core::true();
        }

        return Core::false();
    }

    public function reserved_service_doctor_schedule()
    {
        $service_id = \request('service_id', 0);
        $time = \request('time', 0);
        $date = \request('date', 0);
        $user_id = Auth::guard('patient')->id();

        $service = $this->serviceModelRepository->getById($service_id);


        if (isset($service)) {

            $check = ServiceReserve::where(['patient_id' => $user_id, 'time' => $time, 'date' => Core::persian_to_en_date($date)])->first();

            if (empty($check)) {
                $item = ServiceReserve::create([
                    'patient_id' => $user_id,
                    'service_id' => $service_id,
                    'time' => $time,
                    'date' => Core::persian_to_en_date($date),
                    'price' => $service->offer_price
                ]);
            }
            return redirect(route('patient.profile.service.factor', ['id' => $item->id]));
        }
        return Core::false();
    }

    public
    function reserved_doctor_schedule()
    {


        $date = \request('date', null);
        $time = \request('time', null);
        $doc_id = \request('doc_id', null);
        $user_id = Auth::guard('patient')->id();
        $setting = Setting::first();
        $price = $setting ? $setting->reserve_price : 5000;
        $item = DoctorReserved::where(['client_id' => $user_id, 'time' => $time, 'date' => Core::persian_to_en_date($date)])->first();
        if (empty($item))
            $item = DoctorReserved::create(['price' => $price, 'number' => rand(111111, 999999), 'client_id' => $user_id, 'user_id' => $doc_id, 'time' => $time, 'date' => Core::persian_to_en_date($date)]);
        if ($item)
            return redirect(route('patient.profile.factor', ['id' => $item->id]));
        else
            return Core::false();
    }

    public function certificate_product_post(Request $request)
    {

        if (empty($request->p_id))
            return Core::false('لطفا ابتدا داروخانه خود را مشخص نمایید');

        if (isset(Auth::guard('doctor')->user()->certificate))
            return Core::false('شما یکبار درخواست ارسال کرده اید !');


        $data = [
            'doctor_id' => Auth::guard('doctor')->id(),
            'p_id' => $request->p_id
        ];
        $item = $this->certificatePharmacy->CreateOrUpdate($data, $data);


        if ($item)
            return Core::true();


        return Core::false();
    }

    public function certificate_product()
    {

        $pharmacy = $this->pharmacyRepository->getAll();


        return view('blog::page.doctor.certificate_pharmacy', compact('pharmacy'));
    }

    public
    function reserved_time()
    {

        if (!session('backToAdminSession')) {
            abort(403);
        }
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
    function schedule_time()
    {

        $data = DocorScheduleTime::where('doc_id', Auth::id())->get();

        return view('blog::page.doctor.schedule_time', compact('data'));
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

    public
    function my_patients()
    {
        $doc_id = Auth::guard('doctor')->id();

        $patients = DoctorReserved::where('user_id', $doc_id)->where('status', 'success')->select('client_id')->distinct('client_id')->get();


        return view('blog::page.doctor.patients', compact('patients'));
    }

    public
    function dashboard()
    {
        $doc_id = Auth::guard('doctor')->id();
        $reserved = DoctorReserved::orderBy('date', 'asc')->where('user_id', $doc_id)->where('status', 'success')->whereDate('date', '>=', Carbon::now())->take(20)->get();
        $today_res = DoctorReserved::orderBy('date', 'asc')->where('user_id', $doc_id)->where('status', 'success')->whereDate('date', '=', Carbon::now())->count();

        $news = News::orderBy('id', 'desc')->get();
        return view('blog::page.doctor.dashboard', compact('reserved', 'today_res', 'news'));
    }

    public
    function appointments()
    {
        $doc_id = Auth::guard('doctor')->id();
        $reserved = DoctorReserved::orderBy('date', 'asc')->where('user_id', $doc_id)->where('status', 'success')->get();

        return view('blog::page.doctor.appointments', compact('reserved'));
    }

    public
    function factor($id)
    {

        $data = DoctorReserved::find($id);

        return view('blog::page.patient.factor', compact('data'));
    }


    public function service_feedback(Request $request)
    {
        $user_id = Auth::guard('patient')->id();

        $data = $request->except('_token', 'proengsoft_jsvalidation', 'image');

        $service_id = $data['service_id'];

        $data['patient_id'] = $user_id;
        $data['status'] = Status::False;

        $check = $full_date = ServiceReserve::where(['service_id' => $service_id, 'patient_id' => $user_id])
            ->where('status', OrderStatus::Paid)->first();

        if (empty($check)) {
            return redirect()->back()->with('error', 'شما تا به حال  خدمتی نداشته اید');
        }

        if (empty($data['star']))
            return Core::false();

        $item = ServiceRate::create($data);


        if ($item)
            return Core::true();
        else
            return Core::false();
    }

    public
    function feedback_profile(Request $request)
    {
        $user_id = Auth::guard('patient')->id();

        $data = $request->except('_token', 'proengsoft_jsvalidation', 'image');

        $doc_id = $data['doc_id'];

        $data['patient_id'] = $user_id;
        $data['status'] = Status::False;

        $check = $full_date = DoctorReserved::where(['user_id' => $doc_id, 'client_id' => $user_id])
            ->where('status', Status::Success)->first();

        if (empty($check)) {
            return redirect()->back()->with('error', 'شما تا به حال با این پزشک رزرو نداشته اید');
        }

        if (empty($data['star']))
            return Core::false();

        $item = DoctorRate::create($data);


        if ($item)
            return Core::true();
        else
            return Core::false();
    }

    public function avatar_post(Request $request)
    {
        $data = $request->except('_token', 'proengsoft_jsvalidation', 'image');
        $item = Doctor::find(Auth::id());

        if ($request->image) {
            Core::SaveImage($request->image, 'DoctorAvatar', $item->id);

            return Core::true();
        }
        return Core::false();
    }

    public
    function profile_post(Request $request)
    {
        $data = $request->except('_token', 'proengsoft_jsvalidation', 'image');
        $step = $request->step;
        $item = null;


        $data_step_1 = [
            'complete_account' => 1,
            'name' => $data['name'],
            'medical_system_code' => $data['medical_system_code'],
            'email' => $data['email'],
            'family' => $data['family'],
            'clinic_id' => isset($data['clinic_id']) ? $data['clinic_id'] : 0,
            'mobile' => $data['mobile'],
            'birth_day' => Core::persian_to_en_date($data['birth_day']),
            'gender' => $data['gender'],
            'about_me' => $data['about_me'],
            'category_id' => $data['category_id'],
        ];
        $item = Doctor::find(Auth::id());
        $item->update($data_step_1);
        if ($request->image) {
            Core::SaveImage($request->image, 'DoctorAvatar', $item->id);
        }

        $data_step_2 = [
            'doc_id' => Auth::id(),
            'address_1' => $data['address_1'] ? $data['address_1'] : '',
            'city_id' => $data['city_id'] ? $data['city_id'] : '',
            'state_id' => $data['state_id'] ? $data['state_id'] : '',
            'phone_1' => $data['phone_1'] ? $data['phone_1'] : '',
            'phone_2' => $data['phone_2'] ? $data['phone_2'] : '',

            'lang_map' => $data['lang_map'] ? $data['lang_map'] : '',
            'lat_map' => $data['lat_map'] ? $data['lat_map'] : '',
        ];
        $item = DoctorContact::updateOrCreate(['doc_id' => Auth::id()], $data_step_2);


        $data_step_3 = [
            'specialist' => isset($data['specialist']) ? $data['specialist'] : '',
            'services' => isset($data['services']) ? $data['services'] : '',
        ];
        $item = Doctor::find(Auth::id());
        $item->update($data_step_3);


        $edu_data = [
            'edu_title' => $data['edu_title'],
            'edu_university' => $data['edu_university'],
            'edu_date' => $data['edu_date'],
        ];

        $ex_data = [
            'ex_title' => $data['ex_title'],
            'ex_from' => $data['ex_from'],
            'ex_to' => $data['ex_to'],
            'ex_role' => $data['ex_role'],
        ];
        $rew_data = [
            'rew_title' => $data['rew_title'],
            'rew_date' => $data['rew_date'],
        ];
        DoctorEducation::updateOrCreate(['doc_id' => Auth::id()], ['detail' => json_encode($edu_data)]);
        DoctorExpience::updateOrCreate(['doc_id' => Auth::id()], ['detail' => json_encode($ex_data)]);
        $item = DoctorAchivment::updateOrCreate(['doc_id' => Auth::id()], ['detail' => json_encode($rew_data)]);


        Core::true();


        if ($item)
            return Core::true();
        else
            return Core::false();
    }

    public
    function payment_request()
    {

        $user = Auth::guard('doctor')->user();

        if ($user->checkout < 10000) {
            return Core::false();
        }

        $data['doc_id'] = $user->id;
        $data['price'] = $user->checkout;
        $data['status'] = 0;
        $data['acc_id'] = $user->account ? $user->account->detail : '';

        $item = Payment::create($data);
        if ($item)
            return Core::true();


        return Core::false();
    }

    public
    function account_post(Request $request)
    {
        $data = $request->except('_token', 'file', 'proengsoft_jsvalidation');
        $doc = ['doc_id' => Auth::guard('doctor')->id()];

        $item = DoctorAccount::updateOrCreate($doc, $data);

        if ($item)
            return Core::true();

        else
            return Core::false();
    }

    public
    function account()
    {

        $doc = ['doc_id' => Auth::guard('doctor')->id()];
        $data = DoctorAccount::updateOrCreate($doc);

        $payments = Payment::where('doc_id', $doc)->orderBy('id', 'desc')->get();
        return view('blog::page.doctor.account', compact('data', 'payments'));
    }


    public
    function patient_profile()
    {

        return redirect()->back();
    }

    public function avatar()
    {
        $data = Auth::user();

        return view('blog::page.doctor.avatar', compact(
            'data'
        ));
    }

    public
    function profile()
    {
        $data = Auth::user();


        $states = State::orderBy('title')->get();
        $categories = Category::get();

        return view('blog::page.doctor.profile', compact(
            'data',
            'categories',
            'states'
        ));
    }

    public
    function change_password_post(Request $request)
    {
        $data = $request->except('_token', 'proengsoft_jsvalidation');
        if (Hash::check($request->current_password, Auth::user()->password)) {
            $password = Hash::make($request->password);
            $user = Doctor::find(Auth::id())->update(['password' => $password]);
            return Core::true();
        } else {

            return Core::false();
        }
    }

    public
    function change_password()
    {
        $data = Auth::user();


        return view('blog::page.doctor.change_password ', compact('data'));
    }

    public
    function chats()
    {

        $patient_id = \request('patient_id', null);

        if (Session::has('patient_id'))
            $patient_id = Session::get('patient_id');


        return view('blog::page.doctor.chat', compact('patient_id'));
    }

    public
    function tickets()
    {

        $user_id = \request('user_id', null);

        if (Session::has('user_id'))
            $user_id = Session::get('user_id');
        else {
            $ticket = Ticket::where('doc_id', Auth::id())->where('seen', 1)->first();
            $user_id = $ticket ? $ticket->user_id : 0;
        }


        return view('blog::page.doctor.tickets', compact('user_id'));
    }

    public
    function side_bar_chat_view()
    {

        $search = \request('search', '');
        $doc_id = \request('doc_id', null);
        $patient_id = \request('p_id', null);


        $data = Chat::where('doc_id', $doc_id)->select('patient_id')->distinct('patient_id');

        //        ->addSelect('id')->orderBy('id', 'desc');


        if ((int)$patient_id != 0) {
            $data = $data->where('patient_id', $patient_id);
        }


        if (!empty($search)) {
            $data = $data->whereHas('patient', function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
                $q->orWhere('family', 'LIKE', '%' . $search . '%');
            });
        }


        //->groupBy('doc_id')->havingRaw('COUNT(*) > 1')
        $data = $data->get();


        return view('blog::ajax_item.doctor_chat_side_bar', compact('data'));
    }

    public
    function side_bar_ticket_view()
    {

        $search = \request('search', '');
        $doc_id = \request('doc_id', null);
        $patient_id = \request('p_id', null);


        $data = User::orderBy('id');


        if ((int)$patient_id != 0) {
            $data = $data->where('id', $patient_id);
        }


        if (!empty($search)) {
            $data->where('name', 'LIKE', '%' . $search . '%');
            $data->orWhere('family', 'LIKE', '%' . $search . '%');
        }


        $data = $data->get();

        return view('blog::ajax_item.doctor_ticket_side_bar', compact('data'));
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
        $data['seen'] = 1;
        $item = Chat::create($data);
        if ($item)
            return redirect()->route('doctor.chats')->with(['success' => 'success', 'patient_id' => $data['patient_id']]);


        return Core::false();
    }

    public
    function tickets_post(Request $request)
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
        $data['seen_admin'] = 1;
        $item = Ticket::create($data);
        if ($item)
            return redirect()->route('doctor.tickets')->with(['success' => 'success', 'user_id' => $data['user_id']]);


        return Core::false();
    }

    public
    function content_chat_view()
    {
        $doc_id = \request('doc_id', null);
        $patient_id = \request('p_id', null);
        $sender_id = $doc_id;


        $data = Chat::where('patient_id', $patient_id)->orderBy('id', 'asc');
        $data->update(['seen' => 1]);


        $data = $data->get();

        return view('blog::ajax_item.doctor_chat_content', compact('data', 'doc_id', 'patient_id', 'sender_id'));
    }

    public
    function content_ticket_view()
    {
        $doc_id = \request('doc_id', null);
        $patient_id = \request('p_id', null);
        $sender_id = $doc_id;


        $data = Ticket::where('doc_id', Auth::id())->where('user_id', $patient_id)->orderBy('id', 'asc');
        $data->update(['seen' => 0]);


        $data = $data->get();

        return view('blog::ajax_item.doctor_ticket_content', compact('data', 'doc_id', 'patient_id', 'sender_id'));
    }


    public
    function doctor_logout()
    {
        if (Auth::guard('doctor')->check())
            Auth::logout();

        return redirect(route('index'))->with('success', '');
    }
}
