@extends('blog::layouts.master_index')


@section('title')

@stop

@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">


    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/select2/css/select2.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">


@stop


@section('content')

    @include('blog::partials.doctor_breadcrumb',['title'=>'حساب کاربری '])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    @include('blog::partials.doctor_sidebar')
                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">

                    <div class="row">
                        <div class="col-lg-5 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h3 class="card-title">حساب کاربری</h3>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="profile-view-bottom">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="info-list">
                                                    <div class="title">نام بانک</div>
                                                    <div class="text" id="bank_name">{{$data->bank_name}}</div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="info-list">
                                                    <div class="title">شماره حساب</div>
                                                    <div class="text" id="account_no">{{$data->number}}</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="info-list">
                                                    <div class="title">نام حساب</div>
                                                    <div class="text" id="account_name">{{$data->name}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <div class="row">
                                        <p class="aler alert-info">دقت داشته باشید که در صورتی که مبلغ حساب شما بالای
                                            10 هزار تومان باشد قابل دریافت می باشد</p>

                                        <div class="col-lg-6">
                                            <div class="account-card bg-success-light">
                                                <span>{{number_format(Auth::guard('doctor')->user()->creditor)}} تومان</span>
                                                جمع نوبت های پرداختی
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="account-card bg-warning-light">
                                                <span>{{number_format(Auth::guard('doctor')->user()->payments)}} تومان</span>کل
                                                دریافتی ها
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="account-card bg-purple-light">
                                                <span>{{number_format(Auth::guard('doctor')->user()->checkout)}} تومان</span>
                                                قابل برداشت (تسویه نشده)
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="account-card bg-grey-light">
                                                <span>{{number_format(Auth::guard('doctor')->user()->request_payments)}} تومان</span>
                                                درخواست شده (تسویه نشده)
                                            </div>
                                        </div>

                                        @if(Auth::guard('doctor')->user()->checkout>10000)
                                            <div class="col-md-12 text-center">
                                                <a href="{{route('doctor.payment.request')}}"
                                                   class="btn btn-primary request_btn"
                                                   data-bs-toggle="modal"> درخواست پرداخت </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <form method="post" name="form" id="form" action="{{route('doctor.account.post')}}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">تنظیمات حساب</h4>
                                    <div class="row form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> نام و نام خانوادگی<span class="text-danger">*</span></label>
                                                <input value="{{$data->name}}" type="text"
                                                       class="form-control"
                                                       name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> شماره حساب/ شماره کارت<span class="text-danger">*</span></label>
                                                <input value="{{$data->number}}" type="number" name="number"
                                                       class="form-control"
                                                >
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> نام بانک <span class="text-danger">*</span></label>
                                                <input value="{{$data->bank_name}}" type="text"
                                                       class="form-control"
                                                       name="bank_name">
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                            <div class="submit-section submit-btn-bottom">
                                <button type="submit" class="btn btn-primary submit-btn">ذخیره تغییرات</button>
                            </div>
                        </form>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body pt-0">

                                    <nav class="user-tabs mb-4">
                                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#pat_accounts" data-bs-toggle="tab">پرداختی
                                                    ها</a>
                                            </li>

                                        </ul>
                                    </nav>


                                    <div class="tab-content pt-0">

                                        <div id="pat_accounts" class="tab-pane fade show active">
                                            <div class="card card-table mb-0">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-center mb-0">
                                                            <thead>
                                                            <tr>
                                                                <th>تاریخ درخواست</th>
                                                                <th>مبلغ</th>
                                                                <th>جزییات حساب</th>
                                                                <th>وضعیت</th>
                                                                <th>تاریخ</th>
                                                                <th></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @isset($payments)

                                                                @foreach($payments as $item)
                                                                    <tr>
                                                                        <td>{{$item->fa_created_at[0]}} <span
                                                                                class="d-block text-info"> {{$item->fa_created_at[1]}}   </span>
                                                                        </td>

                                                                        <td class="text-center"> {{number_format($item->price)}}
                                                                            تومان
                                                                        </td>


                                                                        <td class="text-center">{{$item->acc_id}}</td>
                                                                        <td><span
                                                                                class="badge rounded-pill   {{(int)$item->status==1 ?  'bg-success-light': 'bg-danger-light'}}">{{(int)$item->status==1 ?  'پرداخت شده': 'پرداخت نشده'}}</span>
                                                                        </td>
                                                                        <td>{{$item->fa_updated_at[0]}} <span
                                                                                class="d-block text-info"> {{$item->fa_updated_at[1]}}   </span>
                                                                        </td>
                                                                    </tr>

                                                                @endforeach

                                                            @endisset

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="tab-pane fade" id="pat_refundrequest">
                                            <div class="card card-table mb-0">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-center mb-0">
                                                            <thead>
                                                            <tr>
                                                                <th>تاریخ</th>
                                                                <th>نام بیمار</th>
                                                                <th class="text-center">مقدار</th>
                                                                <th>وضعیت</th>
                                                                <th></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>11 خرداد 1401 <span class="d-block text-info">10.00 صبح</span>
                                                                </td>
                                                                <td>
                                                                    <h2 class="table-avatar">
                                                                        <a href="patient-profile.html"
                                                                           class="avatar avatar-sm me-2"><img
                                                                                class="avatar-img rounded-circle"
                                                                                src="assets/img/patients/patient.jpg"
                                                                                alt="User Image"></a>
                                                                        <a href="patient-profile.html">ریچارد دیلسون
                                                                            <span>#PT0016</span></a>
                                                                    </h2>
                                                                </td>
                                                                <td class="text-center"> 150 تومان</td>
                                                                <td><span class="badge rounded-pill bg-success-light">پرداخت شده</span>
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
                                                            <tr>
                                                                <td>3 خرداد 1401 <span class="d-block text-info">11.00 صبح</span>
                                                                </td>
                                                                <td>
                                                                    <h2 class="table-avatar">
                                                                        <a href="patient-profile.html"
                                                                           class="avatar avatar-sm me-2"><img
                                                                                class="avatar-img rounded-circle"
                                                                                src="assets/img/patients/patient1.jpg"
                                                                                alt="User Image"></a>
                                                                        <a href="patient-profile.html">چارلی راد <span>#PT0001</span></a>
                                                                    </h2>
                                                                </td>
                                                                <td class="text-center">200 تومان</td>
                                                                <td><span class="badge rounded-pill bg-success-light">پرداخت شده</span>
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
                                                            <tr>
                                                                <td>1 خرداد 1401 <span class="d-block text-info">1.00 عصر</span>
                                                                </td>
                                                                <td>
                                                                    <h2 class="table-avatar">
                                                                        <a href="patient-profile.html"
                                                                           class="avatar avatar-sm me-2"><img
                                                                                class="avatar-img rounded-circle"
                                                                                src="assets/img/patients/patient2.jpg"
                                                                                alt="User Image"></a>
                                                                        <a href="patient-profile.html">تراویس تریمبل
                                                                            <span>#PT0002</span></a>
                                                                    </h2>
                                                                </td>
                                                                <td class="text-center"> 75 تومان</td>
                                                                <td><span class="badge rounded-pill bg-success-light">پرداخت شده</span>
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
                                                            <tr>
                                                                <td>30 مهر 1401 <span
                                                                        class="d-block text-info">9.00 صبح</span></td>
                                                                <td>
                                                                    <h2 class="table-avatar">
                                                                        <a href="patient-profile.html"
                                                                           class="avatar avatar-sm me-2"><img
                                                                                class="avatar-img rounded-circle"
                                                                                src="assets/img/patients/patient3.jpg"
                                                                                alt="User Image"></a>
                                                                        <a href="patient-profile.html">کارل گری <span>#PT0003</span></a>
                                                                    </h2>
                                                                </td>
                                                                <td class="text-center">100 تومان</td>
                                                                <td><span class="badge rounded-pill bg-warning-light">معلق</span>
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
                                                            <tr>
                                                                <td>28 مهر 1401 <span
                                                                        class="d-block text-info">6.00 عصر</span></td>
                                                                <td>
                                                                    <h2 class="table-avatar">
                                                                        <a href="patient-profile.html"
                                                                           class="avatar avatar-sm me-2"><img
                                                                                class="avatar-img rounded-circle"
                                                                                src="assets/img/patients/patient4.jpg"
                                                                                alt="User Image"></a>
                                                                        <a href="patient-profile.html">میشل فایر <span>#PT0004</span></a>
                                                                    </h2>
                                                                </td>
                                                                <td class="text-center">350 تومان</td>
                                                                <td><span class="badge rounded-pill bg-success-light">پرداخت شده</span>
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
                                                            <tr>
                                                                <td>27 مهر 1401 <span
                                                                        class="d-block text-info">8.00 صبح</span></td>
                                                                <td>
                                                                    <h2 class="table-avatar">
                                                                        <a href="patient-profile.html"
                                                                           class="avatar avatar-sm me-2"><img
                                                                                class="avatar-img rounded-circle"
                                                                                src="assets/img/patients/patient5.jpg"
                                                                                alt="User Image"></a>
                                                                        <a href="patient-profile.html">جینا مور <span>#PT0005</span></a>
                                                                    </h2>
                                                                </td>
                                                                <td class="text-center">250 تومان</td>
                                                                <td><span class="badge rounded-pill bg-danger-light">بازپرداخت</span>
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
    </div>



@stop


@section('js')
    <script type="text/javascript" src="{{asset('assets_blog/js/jquery-migrate-1.2.1.min.js')}}"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\AccountValidation', '#form'); !!}


    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>


    <script src="{{asset('assets_blog/plugins/select2/js/select2.min.js')}}"
            type="f3ba515de7ef394e4a6d11c0-text/javascript"></script>


    <script src="{{asset('assets_blog/js/script.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="e8bd4ced2e01588821be6849-|49" defer=""></script>



@stop
