@extends('layouts.master_forms')

@section('title')
    @lang('default.dashboard')
@endsection
@section('css')
    <style>

        .card span {
            font-family: 'Vazir' !important
        }
    </style>


@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row">

                        <div class="col-lg-3 col-md-6 col-12 ">
                            <a href="{{route('ContactUs.index')}}">

                                <div class="card">
                                    <div class="card-header d-flex flex-column align-items-start pb-2 ">
                                        <div class="avatar bg-rgba-primary p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="feather icon-box text-primary font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h4 class="text-bold-700 mt-1 mb-25"> تماس با ما </h4>
                                        <p class="mb-0 text-danger">{{isset($contact_us) ? $contact_us : '0'}}</p>
                                    </div>
                                    <div class="card-content">
                                        <div id="subscribe-gain-chart"></div>
                                    </div>
                                </div>

                            </a>
                        </div>


                        <div class="col-lg-3 col-md-6 col-12 ">
                            <a href="{{route('articles.status')}}">


                                <div class="card">
                                    <div class="card-header d-flex flex-column align-items-start pb-2 ">
                                        <div class="avatar bg-rgba-primary p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="feather icon-box text-primary font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h4 class="text-bold-700 mt-1 mb-25">مقالات تایید نشده</h4>
                                        <p class="mb-0 text-danger">{{$article_status ? $article_status : '0'}}</p>
                                    </div>
                                    <div class="card-content">
                                        <div id="subscribe-gain-chart"></div>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-lg-3 col-md-6 col-12 ">
                            <a href="{{route('article.comments')}}">


                                <div class="card">
                                    <div class="card-header d-flex flex-column align-items-start pb-2 ">
                                        <div class="avatar bg-rgba-primary p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="feather icon-box text-primary font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h4 class="text-bold-700 mt-1 mb-25">نظرات خوانده نشده</h4>
                                        <p class="mb-0 text-danger">{{$article_comments ? $article_comments : '0'}}</p>
                                    </div>
                                    <div class="card-content">
                                        <div id="subscribe-gain-chart"></div>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-lg-3 col-md-6 col-12 ">
                            <a href="{{route('doctor.comments')}}">

                                <div class="card">
                                    <div class="card-header d-flex flex-column align-items-start pb-2 ">
                                        <div class="avatar bg-rgba-primary p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="feather icon-box text-primary font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h4 class="text-bold-700 mt-1 mb-25">نظرات در مورد پزشکان </h4>
                                        <p class="mb-0 text-danger">{{$doctor_rate ? $doctor_rate : '0'}}</p>
                                    </div>
                                    <div class="card-content">
                                        <div id="subscribe-gain-chart"></div>
                                    </div>
                                </div>

                            </a>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 ">
                            <a href="{{route('Payment.index')}}">

                                <div class="card">
                                    <div class="card-header d-flex flex-column align-items-start pb-2 ">
                                        <div class="avatar bg-rgba-primary p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="feather icon-box text-primary font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h4 class="text-bold-700 mt-1 mb-25">درخواست های پرداخت</h4>
                                        <p class="mb-0 text-danger">{{$pay_request ? $pay_request : '0'}}</p>
                                    </div>
                                    <div class="card-content">
                                        <div id="subscribe-gain-chart"></div>
                                    </div>
                                </div>

                            </a>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 ">
                            <a href="{{route('Doctor.index')}}">

                                <div class="card">
                                    <div class="card-header d-flex flex-column align-items-start pb-2 ">
                                        <div class="avatar bg-rgba-primary p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="feather icon-user text-primary font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h4 class="text-bold-700 mt-1 mb-25">تعداد پزشکان ثبت نامی</h4>
                                        <p class="mb-0 text-danger">{{$doctors ? $doctors : '0'}}</p>
                                    </div>
                                    <div class="card-content">
                                        <div id="subscribe-gain-chart"></div>
                                    </div>
                                </div>

                            </a>
                        </div>


                        <div class="col-lg-3 col-md-6 col-12 ">
                            <a href="{{route('CertificatePharmacy.index',['type'=>\App\Status::False])}}">
                                <div class="card">
                                    <div class="card-header d-flex flex-column align-items-start pb-2 ">
                                        <div class="avatar bg-rgba-primary p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="feather icon-user text-primary font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h4 class="text-bold-700 mt-1 mb-25">درخواست تاییدیه داروخانه</h4>
                                        <p class="mb-0 text-danger">{{$CertificatePharmacies ? $CertificatePharmacies : '0'}}</p>
                                    </div>
                                    <div class="card-content">
                                        <div id="subscribe-gain-chart"></div>
                                    </div>
                                </div>

                            </a>
                        </div>


                        <div class="col-lg-3 col-md-6 col-12 ">
                            <a href="{{route('ServiceModel.index',['type'=>\App\Status::False])}}">
                                <div class="card">
                                    <div class="card-header d-flex flex-column align-items-start pb-2 ">
                                        <div class="avatar bg-rgba-primary p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="feather icon-user text-primary font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h4 class="text-bold-700 mt-1 mb-25">درخواست تاییدیه خدمت</h4>
                                        <p class="mb-0 text-danger">{{$services ? $services : '0'}}</p>
                                    </div>
                                    <div class="card-content">
                                        <div id="subscribe-gain-chart"></div>
                                    </div>
                                </div>

                            </a>
                        </div>


                        <div class="col-lg-5 col-md-6 col-12 ">
                            <a href="{{route('TransActions.index',['type'=>'admin'])}}">

                                <div class="card">
                                    <div class="card-header d-flex flex-column align-items-start pb-2 ">
                                        <div class="avatar bg-rgba-primary p-50 m-0">
                                            <div class="avatar-content">
                                                <i class="feather icon-dollar-sign text-primary font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h4 class="text-bold-700 mt-1 mb-25">درآمد (براساس درصد سود تعریف
                                            شده)</h4>
                                        <p class="mb-0 text-success">{{$income ? number_format($income).' تومان ' : '0'}}</p>
                                    </div>
                                    <div class="card-content">
                                        <div id="subscribe-gain-chart"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                </section>


                <!-- Data list view starts -->
                <section id="data-list-view" class="data-list-view-header card">
                    <div class="card-header">
                        <h4 class="card-title">پزشکان تایید نشده</h4>
                    </div>
                    <div class="table-responsive">

                        <table class="table data-list-view">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>شماره تماس</th>
                                <th>تاریخ عضویت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            @if(isset($activate_doctor))
                                <tbody>
                                @foreach($activate_doctor as $key=>$item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td class="product-name">{{$item->full_name}}</td>
                                        <td class="product-name">{{$item->mobile}}</td>
                                        <td class="product-name">{{$item->fa_created_at}}</td>
                                        <td class="product-action">
                                            @if(auth()->user()->can('Doctor.edit'))
                                                <a href="{{route('doctorStatus',['id'=>$item->id])}}"><span
                                                        class="action-edit"><i
                                                            class="feather icon-check-circle"></i></span></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            @endif
                        </table>
                    </div>

                </section>
                <!-- Data list view end -->


                <!-- Data list view starts -->
                <section id="data-list-view" class="data-list-view-header card">
                    <div class="card-header">
                        <h4 class="card-title">آخرین ثبت نامی ها</h4>
                    </div>
                    <div class="table-responsive">

                        <table class="table data-list-view">

                            <thead>
                            @component('patient::componets.item_header')

                            @endcomponent
                            </thead>
                            @if(isset($patients))

                                <tbody>
                                @foreach($patients as $key=>$item)
                                    @component('patient::componets.item',['item'=>$item,'key'=>$key])
                                    @endcomponent
                                @endforeach
                                </tbody>

                            @endif
                        </table>
                    </div>

                </section>
                <!-- Data list view end -->


                @isset($orders)


                    <section id="data-list-view" class="data-list-view-header card">
                        <div class="card-header">
                            <h4 class="card-title">آخرین سفارشات</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table data-list-view">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>شماره سفارش</th>
                                    <th>مبلغ</th>
                                    <th>وضعیت</th>
                                    <th>جزییات</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                @if(!empty($orders))
                                    <tbody>
                                    @foreach($orders as $item)
                                        <tr>

                                            <td>{{$item->id}}</td>
                                            <td>{{$item->number}}</td>
                                            <td>{{number_format($item->price,null)}}</td>

                                            @switch($item->status)
                                                @case(\App\OrderStatus::Paid)
                                                <td class="alert alert-success">پرداخت شده ، در حال ارسال</td>
                                                @break
                                                @case(\App\OrderStatus::Unpaid)
                                                <td class="alert alert-danger">پرداخت نشده</td>
                                                @break
                                                @case(\App\OrderStatus::Delivered)
                                                <td class="alert alert-primary">ارسال شده</td>
                                                @break
                                            @endswitch
                                            <td>
                                                <button
                                                    class="btn btn-primary show-subtable-button">
                                                    مشاهده
                                                    جزییات
                                                </button>
                                            </td>
                                            <td>
                                                @if($item->status!=\App\OrderStatus::Unpaid && $item->status!=\App\OrderStatus::Delivered)
                                                    <a href="{{route('ProductOrder.confirm',['id'=>$item->id])}}"
                                                       class="btn btn-primary show-subtable-button">
                                                        تاییدیه تحویل
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @isset($item->detail)
                                            <tr class="subtable-row" style="display: none;">
                                                <td colspan="3">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>پزشک</th>
                                                            <th scope="col">محصول</th>
                                                            <th scope="col">مبلغ</th>
                                                            <th scope="col">تعداد</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($item->detail as $val)
                                                            <tr>
                                                                <td>{{$val->doctor ? $val->doctor->full_name : 'نامشخص'}}</td>
                                                                <td>{{$val->title}}</td>
                                                                <td>{{number_format($val->price,null).' تومان '}}</td>
                                                                <td>{{$val->count}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        @endisset
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>


                    </section>

                @endisset
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">(پس از تایید ویرایشات، محصول فعال خواهد شد)محصولات تایید
                                    نشده</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="activity-timeline timeline-left list-unstyled">
                                        @isset($product_confirm)
                                            @foreach($product_confirm as $item)
                                                <li>
                                                    <div
                                                        class="timeline-icon bg-{{$item->status==1 ? 'success' : 'danger'}}">
                                                        <i class="feather icon-box  font-medium-2 align-middle"></i>
                                                    </div>
                                                    <div class="timeline-info">
                                                        <p class="font-weight-bold mb-0">{{$item->title}}
                                                        </p>
                                                        <span
                                                            class="font-small-7"> توسط : {{$item->doctor ? $item->doctor->full_name : ''}}</span>
                                                    </div>
                                                    <hr>
                                                    <span
                                                        class="font-small-5"><a
                                                            href="{{route('Product.edit',['Product'=>$item->id])}}"
                                                            class="btn btn-primary">مشاهده محصول</a></span>
                                                </li>
                                            @endforeach
                                        @endisset

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">آخرین نظرات</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="activity-timeline timeline-left list-unstyled">
                                        @isset($comments)
                                            @foreach($comments as $item)
                                                <li>
                                                    <div
                                                        class="timeline-icon bg-{{$item->status==1 ? 'success' : 'danger'}}">
                                                        <i class="feather icon-eye  font-medium-2 align-middle"></i>
                                                    </div>
                                                    <div class="timeline-info">
                                                        <p class="font-weight-bold mb-0">{{$item->user ? $item->user->full_name : ''}}
                                                            - {{$item->article ? $item->article->title : 'مطلب حذف شده' }}</p>
                                                        <span class="font-small-7">{{$item->message}}</span>
                                                    </div>
                                                    <hr>
                                                    <span
                                                        class="font-small-5">{!! !empty($item->replay) ? $item->replay : 'هنوز پاسخی ثبت نشده است' !!}</span>
                                                    <small class="text-muted">{{$item->fa_date}}</small>
                                                </li>
                                            @endforeach
                                        @endisset

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">تیکت های دیده نشده</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="activity-timeline timeline-left list-unstyled">
                                        @isset($tickets)
                                            @foreach($tickets as $item)

                                                <a class="card"
                                                   href="{{route('Ticket.show',['Ticket'=>$item->doc_id])}}">

                                                    <li>
                                                        <div
                                                            class="timeline-icon bg-{{(int)$item->seen==0 ? 'success' : 'danger'}}">
                                                            <i class="feather icon-eye  font-medium-2 align-middle"></i>
                                                        </div>
                                                        <div class="timeline-info">
                                                            <p class="font-weight-bold mb-0">{{$item->doc ? $item->doc->full_name : ''}}
                                                            </p>
                                                            <span class="font-small-7">{{$item->text}}</span>
                                                        </div>
                                                        <hr>
                                                        <span
                                                            class="font-small-5">{!! !empty($item->file_name) ? 'پیوست' : '' !!}</span>
                                                        <small class="text-muted">{{$item->fa_date}}</small>
                                                    </li>
                                                </a>
                                            @endforeach
                                        @endisset

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@include('partials.delete_item_sweet_alert')

@section('js')
    <script>
        $(document).ready(function () {
            // تابع برای نمایش/مخفی کردن زیرمجموعه‌ها با کلیک بر روی دکمه
            $(".show-subtable-button").click(function () {
                $(this).closest('tr').next('tr.subtable-row').toggle();
            });
        });
    </script>
@endsection
