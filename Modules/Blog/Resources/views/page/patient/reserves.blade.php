@extends('blog::layouts.master_index')


@section('title')
    نوبت های من
@stop

@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">


    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">


    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

@stop


@section('content')

    @include('blog::partials.patient_breadcrumb',['title'=>'نوبت های من'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    @include('blog::partials.patient_sidebar')

                </div>

                <div class="col-md-7 col-lg-8 col-xl-9">

                    <div class="card">
                        <div class="card-body pt-0">

                            <nav class="user-tabs mb-4">
                                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#pat_appointments" data-bs-toggle="tab">نوبت‌دهی</a>
                                    </li>
                                    {{--                                    <li class="nav-item">--}}
                                    {{--                                        <a class="nav-link" href="#pat_prescriptions" data-bs-toggle="tab"> نسخه ها </a>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li class="nav-item">--}}
                                    {{--                                        <a class="nav-link" href="#pat_medical_records" data-bs-toggle="tab"><span--}}
                                    {{--                                                class="med-records"> سوابق پزشکی </span></a>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li class="nav-item">--}}
                                    {{--                                        <a class="nav-link" href="#pat_billing" data-bs-toggle="tab"> صورتحساب </a>--}}
                                    {{--                                    </li>--}}
                                </ul>
                            </nav>


                            <div class="tab-content pt-0">

                                <div id="pat_appointments" class="tab-pane fade show active">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>پزشک</th>
                                                        <th>تاریخ نوبت</th>
                                                        <th> تاریخ رزرو</th>
                                                        <th>پرداختی</th>
                                                        <th> پیگیری</th>
                                                        <th>وضعیت</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    @if(!empty($data))
                                                        <tbody>

                                                        @foreach($data as $item)
                                                            <tr>
                                                                <td>

                                                                    @if(isset($item->doctor))

                                                                        <h2 class="table-avatar">
                                                                            <a href=" "
                                                                               class="avatar avatar-sm me-2">
                                                                                <img class="avatar-img rounded-circle"
                                                                                     src="{{$item->doctor->media  ? $item->doctor->media->url : asset('assets/img/avatar.jpg')}}"
                                                                                     alt="User Image">
                                                                            </a>
                                                                            <a href="{{route('doctor_profile',['doctor'=>$item->doctor->full_name,'id'=>$item->doctor->id])}}">{{$item->doctor->full_name}}
                                                                                <span> {{$item->doctor->category ? $item->doctor->category->title : ''}} </span></a>
                                                                        </h2>

                                                                    @else
                                                                        <h2>دکتر یافت نشد!</h2>
                                                                    @endif

                                                                </td>

                                                                <td>      <span
                                                                        class="d-block text-info">{{$item->res_date}}</span>
                                                                </td>
                                                                <td>{{$item->fa_created_at}}</td>
                                                                <td>{{number_format($item->price,null)}}تومان</td>
                                                                <td>{{$item->number}}</td>
                                                                <td><span
                                                                        class="badge rounded-pill bg-{{$item->st[1]}}-light"> {{$item->st[0]}} </span>
                                                                </td>
                                                                <td class="text-end">
                                                                    <div class="table-action">

                                                                        @if($item->status!='success')
                                                                            <a href="{{route('patient.reserve.destroy',['id'=>$item->id])}}"
                                                                               class="text-danger">
                                                                                <i class="far fa-trash-alt"></i>
                                                                            </a>
                                                                        @endif


                                                                        <a href="{{route('patient.profile.factor',['id'=>$item->id])}}"
                                                                           class="btn btn-sm bg-info-light">
                                                                            <i class="far fa-eye"></i> مشاهده
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="pat_prescriptions">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>تاریخ</th>
                                                        <th>نام</th>
                                                        <th>ایجاد شده توسط</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>14 خرداد 1401</td>
                                                        <td>نسخه 1</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-01.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک رابی پرین <span> دندانپزشکی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>13 خرداد 1401</td>
                                                        <td>نسخه 2</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-02.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک. دارن الدر <span> دندانپزشکی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>12 خرداد 1401</td>
                                                        <td>نسخه 3</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-03.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک. دبورا انجل <span>متخصص قلب</span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>11 خرداد 1401</td>
                                                        <td>نسخه 4</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-04.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک سوفیا برنت <span> اورولوژی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>10 خرداد 1401</td>
                                                        <td>نسخه 5</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-05.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">دکتر دارن الدور <span> دندانپزشکی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>9 خرداد 1401</td>
                                                        <td>نسخه 6</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-06.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک سوفیا برنت <span> ارتوپدی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>8 خرداد 1401</td>
                                                        <td>نسخه 7</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-07.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک لیندا توبین <span>نیئولوژی</span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>7 خرداد 1401</td>
                                                        <td>نسخه 8</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-08.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک. پاول ریچارد<span> دراتولوژی</span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>6 خرداد 1401</td>
                                                        <td>نسخه 9</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-09.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک. جان گیبز<span> دندانپزشکی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5 خرداد 1401</td>
                                                        <td>نسخه 10</td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-10.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک. اولگو بازلو<span> دندانپزشکی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
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


                                <div id="pat_medical_records" class="tab-pane fade">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>شناسه</th>
                                                        <th>تاریخ</th>
                                                        <th> توضیحات</th>
                                                        <th> پیوست</th>
                                                        <th> ایجاد شده</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td><a href="javascript:void(0);">#MR-0010</a></td>
                                                        <td>14 خرداد 1401</td>
                                                        <td>پر کردن دندان</td>
                                                        <td><a href="#">dental-test.pdf</a></td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-01.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک رابی پرین <span> دندانپزشکی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);">#MR-0009</a></td>
                                                        <td>13 خرداد 1401</td>
                                                        <td>تمیز کردن دندان</td>
                                                        <td><a href="#">dental-test.pdf</a></td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-02.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک. دارن الدر <span> دندانپزشکی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);">#MR-0008</a></td>
                                                        <td>12 خرداد 1401</td>
                                                        <td>چکاپ کلی</td>
                                                        <td><a href="#">cardio-test.pdf</a></td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-03.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک. دبورا انجل <span>متخصص قلب</span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);">#MR-0007</a></td>
                                                        <td>11 خرداد 1401</td>
                                                        <td>تست کلی</td>
                                                        <td><a href="#">general-test.pdf</a></td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-04.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک سوفیا برنت <span> اورولوژی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);">#MR-0006</a></td>
                                                        <td>10 خرداد 1401</td>
                                                        <td>تست چشم</td>
                                                        <td><a href="#">eye-test.pdf</a></td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-05.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">دکتر دارن الدور <span> چشم پزشکی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);">#MR-0005</a></td>
                                                        <td>9 خرداد 1401</td>
                                                        <td>درد پا</td>
                                                        <td><a href="#">ortho-test.pdf</a></td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-06.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک سوفیا برنت <span> ارتوپدی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);">#MR-0004</a></td>
                                                        <td>8 خرداد 1401</td>
                                                        <td>سردرد</td>
                                                        <td><a href="#">neuro-test.pdf</a></td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-07.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک لیندا توبین <span>نیئولوژی</span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);">#MR-0003</a></td>
                                                        <td>7 خرداد 1401</td>
                                                        <td>آلرژی پوست</td>
                                                        <td><a href="#">alergy-test.pdf</a></td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-08.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک. پاول ریچارد<span> دراتولوژی</span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);">#MR-0002</a></td>
                                                        <td>6 خرداد 1401</td>
                                                        <td>کشیدن دندان</td>
                                                        <td><a href="#">dental-test.pdf</a></td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-09.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک. جان گیبز<span> دندانپزشکی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0);">#MR-0001</a></td>
                                                        <td>5 خرداد 1401</td>
                                                        <td>پر کردن دندان</td>
                                                        <td><a href="#">dental-test.pdf</a></td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-10.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک. اولگو بازلو<span> دندانپزشکی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
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


                                <div id="pat_billing" class="tab-pane fade">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>شماره فاکتور</th>
                                                        <th>پزشک</th>
                                                        <th>مقدار</th>
                                                        <th>پرداخت شده</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <a href="invoice-view.html">#INV-0010</a>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-01.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">رابی پرین <span> دندانپزشکی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td> 450 تومان</td>
                                                        <td>14 خرداد 1401</td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="invoice-view.html"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="invoice-view.html">#INV-0009</a>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-02.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک. دارن الدر <span> دندانپزشکی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td>300 تومان</td>
                                                        <td>13 خرداد 1401</td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="invoice-view.html"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="invoice-view.html">#INV-0008</a>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-03.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک. دبورا انجل <span>متخصص قلب</span></a>
                                                            </h2>
                                                        </td>
                                                        <td> 150 تومان</td>
                                                        <td>12 خرداد 1401</td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="invoice-view.html"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="invoice-view.html">#INV-0007</a>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-04.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک سوفیا برنت <span> اورولوژی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td>50 تومان</td>
                                                        <td>11 خرداد 1401</td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="invoice-view.html"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="invoice-view.html">#INV-0006</a>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-05.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">دکتر دارن الدور <span> چشم پزشکی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td>600 تومان</td>
                                                        <td>10 خرداد 1401</td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="invoice-view.html"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="invoice-view.html">#INV-0005</a>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-06.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک سوفیا برنت <span> ارتوپدی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td>200 تومان</td>
                                                        <td>9 خرداد 1401</td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="invoice-view.html"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="invoice-view.html">#INV-0004</a>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-07.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک لیندا توبین <span>نیئولوژی</span></a>
                                                            </h2>
                                                        </td>
                                                        <td>100 تومان</td>
                                                        <td>8 خرداد 1401</td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="invoice-view.html"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="invoice-view.html">#INV-0003</a>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-08.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک. پاول ریچارد<span> دراتولوژی</span></a>
                                                            </h2>
                                                        </td>
                                                        <td>250 تومان</td>
                                                        <td>7 خرداد 1401</td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="invoice-view.html"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="invoice-view.html">#INV-0002</a>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-09.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک. جان گیبز<span> دندانپزشکی </span></a>
                                                            </h2>
                                                        </td>
                                                        <td>175 تومان</td>
                                                        <td>6 خرداد 1401</td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="invoice-view.html"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="invoice-view.html">#INV-0001</a>
                                                        </td>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="doctor-profile.html"
                                                                   class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle"
                                                                         src="assets/img/doctors/doctor-thumb-10.jpg"
                                                                         alt="User Image">
                                                                </a>
                                                                <a href="doctor-profile.html">پزشک. اولگو بازلو<span>#0010</span></a>
                                                            </h2>
                                                        </td>
                                                        <td>550 تومان</td>
                                                        <td>5 خرداد 1401</td>
                                                        <td class="text-end">
                                                            <div class="table-action">
                                                                <a href="invoice-view.html"
                                                                   class="btn btn-sm bg-info-light">
                                                                    <i class="far fa-eye"></i> مشاهده
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                   class="btn btn-sm bg-primary-light">
                                                                    <i class="fas fa-print"></i> پرینت
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

    <script src="{{asset('assets_blog/js/script.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>




    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>

    <script src="{{asset('assets_blog/js/circle-progress.min.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>

    <script src="{{asset('assets_blog/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="e8bd4ced2e01588821be6849-|49" defer=""></script></body>

@stop
