<header class="header">
    <nav class="navbar navbar-expand-lg header-nav">
        <div class="navbar-header">
            <a id="mobile_btn" href="javascript:void(0);">
<span class="bar-icon bar-icon-one">
<span></span>
<span></span>
<span></span>
</span>
            </a>
            <a href="{{route('index')}}" class="navbar-brand logo">
                <img src="{{$setting->logo ? $setting->logo->url :  ''}}" class="img-fluid"
                     alt="{{$setting->site_name}}">
            </a>
        </div>
        <div class="main-menu-wrapper">
            <div class="menu-header">
                <a href="{{route('index')}}" class="menu-logo">
                    <img src="{{$setting->logo ? $setting->logo->url :  ''}}" class="img-fluid" alt="Logo">
                </a>
                <a id="menu_close" class="menu-close" href="javascript:void(0);">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            <ul class="main-nav">

                <li class="has-submenu   {{Request::route()->getName()=='index' ? 'active' : ''}}">
                    <a href="{{route('index')}}">صفحه اصلی<i class=" "></i></a>

                </li>

                <li class="has-submenu">
                    <a href="#">پزشک<i class="fas fa-chevron-down"></i></a>
                    <ul class="submenu">

                        @if(!Auth::guard('doctor')->check())
                            <li><a href="{{route('doctor.register')}}">ثبت نام </a></li>
                            <li><a href="{{route('doctor.login')}}">ورود </a></li>
                        @elseif(Auth::guard('doctor')->check())
                            <li><a href="{{route('doctor.dashboard')}}">پنل کاربری</a></li>
                            <li><a href="{{route('doctor.profile')}}">تنظیمات پروفایل</a></li>
                            <li><a href="{{route('doctor.avatar')}}">تغییر تصویر پروفایل</a></li>
                            <li><a href="{{route('doctor.appointments')}}"> نوبت‌دهی</a></li>
                            <li><a href="{{route('doctor.patients')}}"> مراجعه‌کنندگان من</a></li>
                            <li><a href="{{route('doctor.setting')}}">تنظیمات من</a></li>
                            <li><a href="{{route('doctor.schedule_time')}}"> زمان‌بندی</a></li>
                            <li><a href="{{route('doctor.reserved_time')}}">نوبت دهی (رزرو) </a></li>
                            <li><a href="{{route('doctor.transactions')}}">تراکنشات من </a></li>
                            <li><a href="{{route('doctor.service.orders')}}">سفارشات من(خدمات)</a></li>
                            <li><a href="{{route('doctor.service')}}">ثبت خدمات</a></li>
                            <li><a href="{{route('doctor.service.list')}}">لیست خدمات</a></li>
                            @if(\Illuminate\Support\Facades\Auth::guard('doctor')->user()->certificateDragStore())

                                <li><a href="{{route('doctor.orders')}}">سفارشات من(محصولات)</a></li>
                                <li><a href="{{route('doctor.product')}}">ٍثبت محصول</a></li>
                                <li><a href="{{route('doctor.product.list')}}">لیست محصولات</a></li>
                            @else
                                <li><a href="{{route('doctor.certificate.product')}}">فعال سازی داروخانه/فروش محصول</a>
                                </li>
                            @endif
                            <li><a href="{{route('doctor.account')}}">حساب کاربری </a></li>
                            <li><a href="{{route('doctor.articles')}}">مقالات </a></li>
                            <li><a href="{{route('doctor.chats')}}"> پیام‌ها</a></li>
                            <li><a href="{{route('doctor.profile.change_password')}}">‌تغییر رمز عبور </a></li>
                            <li><a href="{{route('doctor.logout')}}">خروج</a></li>
                        @endif


                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#">بیماران/مراجعه کنندگان<i class="fas fa-chevron-down"></i></a>
                    <ul class="submenu">

                        @if(!Auth::guard('patient')->check())

                            <li><a href="{{route('patient.register')}}">ثبت نام </a></li>
                            <li><a href="{{route('patient.login')}}">ورود </a></li>

                        @elseif(Auth::guard('patient')->check())

                            <li><a href="{{route('patient.dashboard')}}">داشبورد</a></li>
                            <li><a href="{{route('patient.profile')}}">تنظیمات پروفایل</a></li>
                            <li><a href="{{route('patient.reserves')}}">نوبت های من</a></li>
                            <li><a href="{{route('patient.orders')}}">(محصول)سفارشات من</a></li>
                            <li><a href="{{route('patient.service.orders')}}">نوبت خدمات</a></li>
{{--                            <li><a href="{{route('patient.factors')}}">فاکتورهای من</a></li>--}}
                            <li><a href="{{route('patient.wallet')}}">کیف پول</a></li>
                            <li><a href="{{route('patient.transaction')}}">تراکنشات من</a></li>
                            <li><a href="{{route('patient.reviews')}}">نظرات من</a></li>
                            <li><a href="{{route('patient.chats')}}">پیام ها</a></li>
                            <li><a href="{{route('patient.favorite')}}">پزشک های من</a></li>
                            <li><a href="{{route('patient.favorite.product')}}">محصولات من</a></li>
                            <li><a href="{{route('patient.profile.change_password')}}">‌تغییر رمز عبور</a></li>
                            <li><a href="{{route('patient.logout')}}">خروج</a></li>
                        @endif

                    </ul>
                </li>

                <li class="has-submenu">
                    <a href="#">دیگر صفحات<i class="fas fa-chevron-down"></i></a>
                    <ul class="submenu">
                        <li><a href="{{route('doctor.search')}}">‌جستجو پزشک</a></li>
                        <li><a href="{{route('about_us')}}">‌درباره ما</a></li>
                        <li><a href="{{route('contact_us')}}">‌تماس با ما</a></li>
                        <li><a href="{{route('faq')}}">سوالات متداول</a></li>
                        <li><a href="{{route('team')}}">تیم ما</a></li>

                        @isset($pages)
                            @foreach($pages  as $item)
                                <li>
                                    <a href="{{route('page',['title'=>$item->title,'id'=>$item->id])}}">{{$item->title}}</a>
                                </li>
                            @endforeach
                        @endisset

                    </ul>
                </li>


                @isset($links)
                    <li class="has-submenu">
                        <a href="#">پیوندها<i class="fas fa-chevron-down"></i></a>
                        <ul class="submenu">
                            @foreach($links->where('type','top')  as $item)
                                <li><a href="{{$item->url}}">{{$item->title}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endisset


                <li class="has-submenu">
                    <a href="{{route('blogs')}}">‌بلاگ<i class=" "></i></a>

                </li>

                <li class="has-submenu">
                    <a href="{{route('products')}}">محصولات<i class=" "></i></a>
                </li>
                <li class="has-submenu">
                    <a href="{{route('services')}}">خدمات<i class=" "></i></a>
                </li>


                @if(!Auth::check())
                    <li class="login-link">
                        <a href="{{route('patient.login')}}">ورود</a>
                    </li>
                    <li class="login-link">
                        <a href="{{route('patient.register')}}">ثبت نام</a>
                    </li>

                @elseif(Auth::guard('patient')->check())

                    <li class="login-link">
                        <a href="{{route('patient.dashboard')}}">داشبورد من</a>
                    </li>



                @else
                    <li class="login-link">
                        <a href="{{route('patient.login')}}">ورود</a>
                    </li>
                    <li class="login-link">
                        <a href="{{route('patient.register')}}">ثبت نام</a>
                    </li>
                @endif

            </ul>
        </div>
        <ul class="nav header-navbar-rht">
            


            @if(Auth::guard('doctor')->check())
                <li class="nav-item">
                    <a class="nav-link header-login btn-one-light" href="{{route('doctor.dashboard')}}">داشبورد من</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link header-login btn-info" href="{{route('doctor.logout')}}">خروج</a>
                </li>


            @elseif(Auth::guard('patient')->check())
                <li class="nav-item">
                    <a class="nav-link header-login btn-one-light" href="{{route('patient.dashboard')}}">داشبورد من</a>
                </li>

                <li class="nav-item">
                    {{-- <a class="nav-link header-login btn-one-light" href="{{route('patient.chat')}}">چت آنلاین</a> --}}
                </li>

                <li class="nav-item">
                    <a class="nav-link header-login btn-info" href="{{route('patient.logout')}}">خروج</a>
                </li>



                @php
                    $patient_user=Auth::guard('patient')->user();
                @endphp

                @component('blog::componets.card_order_header',['product_setting'=>isset($product_setting) ? $product_setting : null
,'data'=>$patient_user->cards()->get()
,'product_price'=>$patient_user->getAmountProductPrice()
? $patient_user->getAmountProductPrice() : 0,'total_price'=>$patient_user->TotalPriceProduct()
? $patient_user->TotalPriceProduct() : 0])
                @endcomponent

            @else
                
            @endif


        </ul>
    </nav>
</header>
