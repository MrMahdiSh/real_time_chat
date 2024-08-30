@extends('blog::layouts.master_index')


@section('title')
    داشبورد
@stop

@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">


    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">


    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

@stop


@section('content')

    @include('blog::partials.doctor_breadcrumb',['title'=>'داشبورد'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    @include('blog::partials.doctor_sidebar')
                </div>

                <div class="col-md-7 col-lg-8 col-xl-9">
                    @if(Auth::user()->complete_account==0)
                        <a href="{{route('doctor.profile')}}">
                            <p class="alert alert-warning">شما هنوز پروفایل خود را تکمیل نکرده اید!! لطفا از این قسمت
                                اقدام
                                به تکمیل پروفایل خود کنید</p>
                        </a>
                    @endif
                    <div class="row">



                        <div class="col-md-12">
                            <div class="card dash-card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget dct-border-rht">
                                                <div class="circle-bar circle-bar2">
                                                    <div class="circle-graph2" data-percent="65">
                                                        <img src="{{asset('assets_blog/img/icon-02.png')}}"
                                                             class="img-fluid"
                                                             alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6> مراجعان امروز </h6>
                                                    <h3>{{$today_res ? $today_res : '0'}}</h3>
                                                    <p class="text-muted">{{\App\Helper\Core::ArticleDate(\Carbon\Carbon::now(),false)}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget">
                                                <div class="circle-bar circle-bar3">
                                                    <div class="circle-graph3" data-percent="50">
                                                        <img src="{{asset('assets_blog/img/icon-03.png')}}"
                                                             class="img-fluid"
                                                             alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>نوبت ها</h6>
                                                    <h3>{{$reserved ? count($reserved) : '0'}}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @isset($news)
                            <div id="accordion">

                                @foreach($news as $key=>$item)
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse"
                                                        data-target="#collapse{{$key}}"
                                                        aria-expanded="true" aria-controls="collapse{{$key}}">
                                                    {{$item->title}}
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="collapse{{$key}}" class="collapse {{$key==0 ?'show' : ''}}"
                                             aria-labelledby="headingOne"
                                             data-parent="#accordion">
                                            <div class="card-body">
                                                {!! $item->description !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>


                        @endisset
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="mb-4">نوبت مراجعان</h4>
                            <div class="appointment-tab">

                                <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#upcoming-appointments" data-bs-toggle="tab">پیش
                                            رو</a>
                                    </li>
                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane show active" id="upcoming-appointments">
                                        <div class="card card-table mb-0">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-center mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>نام بیمار</th>
                                                            <th>تاریخ نوبت</th>
                                                            <th>هدف</th>
                                                            <th>نوع</th>
                                                            <th class="text-center">مقدار پرداختی</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @isset($reserved)

                                                            @foreach($reserved as $item)

                                                                @component('blog::componets.row.doctor_reserve_item',['item'=>$item])

                                                                @endcomponent
                                                            @endforeach
                                                        @endisset

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane" id="today-appointments">
                                        <div class="card card-table mb-0">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-center mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>نام بیمار</th>
                                                            <th>تاریخ نوبت</th>
                                                            <th>هدف</th>
                                                            <th>نوع</th>
                                                            <th class="text-center">مقدار پرداختی</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="patient-profile.html"
                                                                       class="avatar avatar-sm me-2"><img
                                                                            class="avatar-img rounded-circle"
                                                                            src="assets/img/patients/patient6.jpg"
                                                                            alt="User Image"></a>
                                                                    <a href="patient-profile.html">السی گیال <span>#PT0006</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>14 خرداد 1401 <span
                                                                    class="d-block text-info">6.00 عصر</span></td>
                                                            <td>تب</td>
                                                            <td>مراجع قدیمی</td>
                                                            <td class="text-center">300 تومان</td>
                                                            <td class="text-end">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> مشاهده
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-success-light">
                                                                        <i class="fas fa-check"></i> قبول
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-danger-light">
                                                                        <i class="fas fa-times"></i> حذف
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="patient-profile.html"
                                                                       class="avatar avatar-sm me-2"><img
                                                                            class="avatar-img rounded-circle"
                                                                            src="assets/img/patients/patient7.jpg"
                                                                            alt="User Image"></a>
                                                                    <a href="patient-profile.html">جوان گرانرد <span>#PT0006</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>14 خرداد 1401 <span
                                                                    class="d-block text-info">5.00 عصر</span></td>
                                                            <td>کلی</td>
                                                            <td>مراجع قدیمی</td>
                                                            <td class="text-center">100 تومان</td>
                                                            <td class="text-end">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> مشاهده
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-success-light">
                                                                        <i class="fas fa-check"></i> قبول
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-danger-light">
                                                                        <i class="fas fa-times"></i> حذف
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="patient-profile.html"
                                                                       class="avatar avatar-sm me-2"><img
                                                                            class="avatar-img rounded-circle"
                                                                            src="assets/img/patients/patient8.jpg"
                                                                            alt="User Image"></a>
                                                                    <a href="patient-profile.html">دنیل گیفیل <span>#PT0007</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>14 خرداد 1401 <span
                                                                    class="d-block text-info">3.00 عصر</span></td>
                                                            <td>کلی</td>
                                                            <td>مراجع جدید</td>
                                                            <td class="text-center"> 75 تومان</td>
                                                            <td class="text-end">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> مشاهده
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-success-light">
                                                                        <i class="fas fa-check"></i> قبول
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-danger-light">
                                                                        <i class="fas fa-times"></i> حذف
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="patient-profile.html"
                                                                       class="avatar avatar-sm me-2"><img
                                                                            class="avatar-img rounded-circle"
                                                                            src="assets/img/patients/patient9.jpg"
                                                                            alt="User Image"></a>
                                                                    <a href="patient-profile.html">والتر رابینسون <span>#PT0008</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>14 خرداد 1401 <span
                                                                    class="d-block text-info">1.00 عصر</span></td>
                                                            <td>کلی</td>
                                                            <td>مراجع قدیمی</td>
                                                            <td class="text-center">350 تومان</td>
                                                            <td class="text-end">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> مشاهده
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-success-light">
                                                                        <i class="fas fa-check"></i> قبول
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-danger-light">
                                                                        <i class="fas fa-times"></i> حذف
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="patient-profile.html"
                                                                       class="avatar avatar-sm me-2"><img
                                                                            class="avatar-img rounded-circle"
                                                                            src="assets/img/patients/patient10.jpg"
                                                                            alt="User Image"></a>
                                                                    <a href="patient-profile.html">رابرت رودز <span>#PT0010</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>14 خرداد 1401 <span
                                                                    class="d-block text-info">10.00 صبح</span></td>
                                                            <td>کلی</td>
                                                            <td>مراجع جدید</td>
                                                            <td class="text-center">175 تومان</td>
                                                            <td class="text-end">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> مشاهده
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-success-light">
                                                                        <i class="fas fa-check"></i> قبول
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-danger-light">
                                                                        <i class="fas fa-times"></i> حذف
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h2 class="table-avatar">
                                                                    <a href="patient-profile.html"
                                                                       class="avatar avatar-sm me-2"><img
                                                                            class="avatar-img rounded-circle"
                                                                            src="assets/img/patients/patient11.jpg"
                                                                            alt="User Image"></a>
                                                                    <a href="patient-profile.html">هری ویلیامز <span>#PT0011</span></a>
                                                                </h2>
                                                            </td>
                                                            <td>14 خرداد 1401 <span
                                                                    class="d-block text-info">11.00 صبح</span></td>
                                                            <td>کلی</td>
                                                            <td>مراجع جدید</td>
                                                            <td class="text-center" 450 تومان
                                                            </td>
                                                            <td class="text-end">
                                                                <div class="table-action">
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-info-light">
                                                                        <i class="far fa-eye"></i> مشاهده
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-success-light">
                                                                        <i class="fas fa-check"></i> قبول
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-danger-light">
                                                                        <i class="fas fa-times"></i> حذف
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@section('js')
    <script type="text/javascript" src="{{asset('assets_blog/js/jquery-migrate-1.2.1.min.js')}}"></script>


    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\DoctorLoginValidation', '#form'); !!}


    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/slick.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/aos.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>




    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>

    <script src="{{asset('assets_blog/js/circle-progress.min.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>

    <script src="{{asset('assets_blog/js/script.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>
    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="b97d855d680359945684ceb5-|49" defer=""></script></body>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
@stop
