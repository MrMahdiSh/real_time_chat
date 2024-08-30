<?php

namespace Modules\Blog\Http\Controllers;

use App\Helper\Core;


use App\Repositories\AdvertisePageRepository;
use App\Repositories\AdvertiseRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\BaseRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\DoctorRepository;
use App\Repositories\Product\ProductBrandRepository;
use App\Repositories\Product\ProductCategoryRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Service\ServiceCategoryRepository;
use App\Repositories\Service\ServiceModelRepository;
use App\Repositories\SpecialRepository;
use App\Status;
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
use Modules\Service\Entities\ServiceSetting;
use Modules\Setting\Entities\ContactUs;
use Modules\Setting\Entities\Setting;
use Modules\Special\Entities\Special;
use Modules\State\Entities\City;
use Modules\Team\Entities\Team;

class BlogController extends Controller
{

    protected $ArticleRepository;
    protected $categoryRepository;
    protected $specialRepository;
    protected $productRepository;
    protected $productBrand;
    protected $productCategory;
    protected $advertiseRepository;
    protected $serviceModelRepository;
    protected $serviceCategoryRepository;

    public function __construct(ServiceCategoryRepository $serviceCategoryRepository,
                                ServiceModelRepository $serviceModelRepository,
                                ArticleRepository $ArticleRepository, CategoryRepository $categoryRepository,
                                AdvertiseRepository $advertiseRepository, SpecialRepository $specialRepository, ProductRepository $productRepository, ProductCategoryRepository $productCategory
        , ProductBrandRepository $productBrand)
    {
        $this->ArticleRepository = $ArticleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->specialRepository = $specialRepository;
        $this->productRepository = $productRepository;
        $this->productBrand = $productBrand;
        $this->productCategory = $productCategory;
        $this->advertiseRepository = $advertiseRepository;
        $this->serviceModelRepository = $serviceModelRepository;
        $this->serviceCategoryRepository = $serviceCategoryRepository;
    }

    public function service_detail($id)
    {
        $data = $this->serviceModelRepository->getById($id);

        $setting = ServiceSetting::first();

        return view('blog::page.service_single', compact('data', 'setting'));
    }

    public function services()
    {
        $categories_params = \request('category', null);
        $text_params = \request('text', null);
        $sorting_params = \request('sorting', null);


        $data = $this->serviceModelRepository->getPaginate();

        if ($text_params != null) {
            $data = $data->where('title', 'LIKE', '%' . $text_params . '%');
            $data = $data->orWhereHas('doctor', function ($query) use ($text_params) {
                $query->where('name', 'LIKE', '%' . $text_params . '%')
                    ->orWhere('family', 'LIKE', '%' . $text_params . '%');
            });
        }

        if (!empty($categories_params)) {
            $data = $data->whereIn('category_id', $categories_params);
        }


        if (!empty($sorting_params)) {
            switch ($sorting_params) {
                case ('max_price'):
                    $data->orderBy('price', 'desc');
                    break;
                case ('min_price'):
                    $data->orderBy('price', 'asc');
                    break;
                default :
                    $data->orderBy('id', 'desc');
                    break;
            }
        }


        $categories = $this->serviceCategoryRepository
            ->Get()->where('parent_id', 0)->has('child')->with('child')->get();


        $data = $data->paginate(20);
        return view('blog::page.services', compact('data', 'categories'));
    }

    public function products()
    {

        $categories_params = \request('category', null);
        $brands_params = \request('brands', null);
        $text_params = \request('text', null);
        $sorting_params = \request('sorting', null);


        $data = $this->productRepository->getPaginateProduct();


        if ($text_params != null) {
            $data = $data->where('title', 'LIKE', '%' . $text_params . '%');
        }

        if (!empty($categories_params)) {
            $data = $data->whereIn('category_id', $categories_params);
        }

        if (!empty($brands_params)) {
            $data = $data->whereIn('brand_id', $brands_params);
        }


        if (!empty($sorting_params)) {
//last  max_price min_price
            switch ($sorting_params) {
                case ('max_price'):
                    $data->orderBy('price', 'desc');
                    break;
                case ('min_price'):
                    $data->orderBy('price', 'asc');
                    break;
                default :
                    $data->orderBy('id', 'desc');
                    break;
            }
        }


        $categories = $this->productCategory->getAll();
        $brands = $this->productBrand->getAll();


        $data = $data->paginate(20);
        return view('blog::page.products', compact('data', 'categories', 'brands'));
    }

    public function contact_us_post(Request $request)
    {

        $data = $request->except('_token', 'proengsoft_jsvalidation');
        $data['seen'] = '0';
        if (ContactUs::create($data))
            return Core::true();

        return Core::false();

    }

    public function contact_us()
    {

        $data = Setting::first();

        return view('blog::page.contact_us', compact('data'));

    }

    public function privacy()
    {

        $data = Setting::first();

        return view('blog::page.privacy ', compact('data'));

    }

    public function policy()
    {

        $data = Setting::first();

        return view('blog::page.policy ', compact('data'));

    }

    public function product_detail($id, $title)
    {
        $data = $this->productRepository->getById($id);
        return view('blog::page.product_single', compact('data'));
    }

    public function blogs()
    {
        $data = Article::with('user', 'category', 'media')->paginate(10);


        return view('blog::page.blogs', compact('data'));

    }


    public function doctor_register()
    {

        return view('blog::page.doctor.register');


    }

    public function patient_register()
    {

        return view('blog::page.patient.register');

    }


    public function doctor_login()
    {
        return view('blog::page.doctor.login');

    }

    public function patient_login()
    {
        return view('blog::page.patient.login');

    }

    public function doctor_logout()
    {
        if (Auth::guard('doctor')->check())
            Auth::guard('doctor')->logout();

        return redirect(route('index'))->with('success');

    }

    public function doctor_login_post(Request $request)
    {

        $data = $request->except('_token', 'proengsoft_jsvalidation', 'password_confirmation');


        if (Auth::guard('doctor')->attempt($data)) {
            if (Auth::guard('doctor')->user()->active == Status::False) {
                Auth::logout();

                return redirect(route('doctor.login'))->with('error', 'لطفا تا زمان تاییدیه حساب کاربری صبر کنید');

            }

            return redirect(route('doctor.dashboard'))->with('success');
        } else {

            return Core::false();
        }


    }

    public function patient_login_post(Request $request)
    {

        $data = $request->except('_token', 'proengsoft_jsvalidation', 'password_confirmation');


        if (Auth::guard('patient')->attempt($data)) {


            return redirect(route('patient.dashboard'))->with('success');
        } else {

            return Core::false();
        }


    }


    public
    function doctor_register_post(Request $request)
    {

        $data = $request->except('_token', 'proengsoft_jsvalidation', 'password_confirmation');

        $data['password'] = Hash::make($data['password']);

        $data['complete_account'] = '0';
        $data['active'] = Status::False;
        $data['username'] = rand(1111, 9999) . Str::random(2);

        $doctor = Doctor::where(['mobile' => $data['mobile']])->first();

        if (!empty($doctor))
            return Core::false();


        $doctor = Doctor::create($data);

        if ($doctor) {

            return redirect()->route('doctor.login')->with('success');
        } else            return Core::false();


    }


    public
    function patient_register_post(Request $request)
    {


        $data = $request->except('_token', 'proengsoft_jsvalidation', 'password_confirmation');

        $data['password'] = Hash::make($data['password']);


        $patient = Patient::where(['mobile' => $data['mobile']])->first();

        if (!empty($patient))
            return Core::false();


        $patient = Patient::create($data);

        if ($patient) {
            Auth::login($patient);


            return redirect()->route('patient.login')->with('success');
        } else            return Core::false();


    }


    public
    function comment_store(Request $request)
    {

        $data = $request->except('_token', 'proengsoft_jsvalidation');

        if (Auth::check()) {
            $data['user_id'] = auth()->user()->name . ' ' . auth()->user()->family;
            $data['email'] = auth()->user()->email;
        }

        $data['status'] = 0;


        $insert = ArticleComment::create($data);


        if ($insert)
            return Core::true();
        else
            return Core::false();

    }

    public
    function single_blog($id)
    {
        $data = Article::with('user', 'category', 'media')->find($id);


        return view('blog::page.single_blog', compact('data'));

    }

    public
    function search_blog()
    {
        $data = Article::with('user', 'category', 'media');

        $category = \request('category', null);
        $text = \request('text', null);
        $tag = \request('tag', null);


        $category ? $data->where('category_id', $category) : '';
        $text ? $data->where('title', 'LIKE', '%' . $text . '%') : '';
        $tag ? $data->whereRaw('json_contains(tags, \'"' . $tag . '"\')') : '';

        $data = $data->paginate(10);

        return view('blog::page.blogs', compact('data'));

    }

    public function about_us()
    {
        $data = Setting::first();
        return view('blog::page.about_us', compact('data'));

    }

    public function faq()
    {
        $data = Faq::orderBy('id', 'desc')->get();

        return view('blog::page.faq', compact('data'));
    }

    public function doctor_search_result()
    {
        $type = \request()->get('type');
        $city = \request()->get('city');
        $search = trim(\request()->get('search'));
        $category_id = \request()->get('category_id', '');
        $gender = \request()->get('gender', '');


        if ($type == 'reset') {
            $city = '';
            $search = '';
            $category_id = '';
            $gender = '';


        }

        $doctors = Doctor::orderBy('certificate', 'desc');

        $categories = Category::orderBy('title')->get();


        $doctors = $doctors->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', '%' . $search . '%');
            $q->orWhere('family', 'LIKE', '%' . $search . '%');
            $q->orWhere('services', 'LIKE', '%' . $search . '%');
            $q->orWhere('specialist', 'LIKE', '%' . $search . '%');
        });

        if ((int)$category_id != 0)
            $doctors = $doctors->where('category_id', $category_id);


        if ((int)$gender != 0)
            $doctors = $doctors->where('gender', $gender);


        if ((int)$city != 0) {
            $doctors = $doctors->whereHas('contact', function ($query) use ($city) {
                return $query->where('city_id', $city);
            });
        }


        $doctors = $doctors->get();


        return view('blog::page.doctor_search', compact('categories', 'doctors'))->withCookies([cookie('city_user', $city, 60 * 24 * 30)]);

    }

    public function page($title, $id)
    {

        $data = Page::find($id);
        return view('blog::page.page', compact('data'));
    }

    public function team()
    {
        $teams = Team::get();

        return view('blog::page.team', compact('teams'));
    }

    public
    function index()
    {


        $categoryService = $this->serviceCategoryRepository->Get()->where('parent_id', 0)->has('child')->with('child')->take(5)->get();


        $services = $this->serviceModelRepository->getAllStatus(10);


        $index_ads = $this->advertiseRepository->Get()->orderBy('id', 'desc')->get()->groupBy('size');


        $category = $this->categoryRepository->getAll();

        $specials = $this->specialRepository->getAll();

        $articles = $this->ArticleRepository->getAllStatus(4);

        $doctors = Doctor::orderBy('certificate', 'desc')->take(5)->get();

        $cities = City::orderBy('title')->get();

        $setting = Setting::first();

        return view('blog::page.index', compact('services', 'categoryService', 'index_ads', 'setting', 'category', 'specials', 'cities',
            'articles', 'doctors'));
    }

}
