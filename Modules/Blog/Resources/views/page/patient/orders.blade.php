@extends('blog::layouts.master_index')


@section('title')
    سفارش های من
@stop

@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">


    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">


    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

@stop


@section('content')

    @include('blog::partials.patient_breadcrumb',['title'=>'سفارش های من'])

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
                                        <a class="nav-link active" href="#pat_appointments" data-bs-toggle="tab">لیست
                                            سفارشات</a>
                                    </li>
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
                                                        <th>شماره سفارش</th>
                                                        <th>مبلغ</th>
                                                        <th>وضعیت</th>
                                                        <th>جزییات</th>

                                                    </tr>
                                                    </thead>
                                                    @if(!empty($data))
                                                        <tbody>
                                                        @foreach($data as $item)
                                                            <tr>

                                                                <td>{{$item->number}}</td>
                                                                <td>{{number_format($item->price,null)}}</td>

                                                                @switch($item->status)
                                                                    @case(\App\OrderStatus::Paid)
                                                                    <td>پرداخت شده ، در حال ارسال</td>
                                                                    @break
                                                                    @case(\App\OrderStatus::Unpaid)
                                                                    <td>پرداخت نشده</td>
                                                                    @break
                                                                    @case(\App\OrderStatus::Delivered)
                                                                    <td>ارسال شده</td>
                                                                    @break
                                                                @endswitch
                                                                <td>
                                                                    <button
                                                                        class="btn btn-primary show-subtable-button">
                                                                        مشاهده
                                                                        جزییات
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            @isset($item->detail)
                                                                <tr class="subtable-row" style="display: none;">
                                                                    <td colspan="3">
                                                                        <table class="table">
                                                                            <thead>
                                                                            <tr>
                                                                                <th scope="col">محصول</th>
                                                                                <th scope="col">مبلغ</th>
                                                                                <th scope="col">تعداد</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach($item->detail as $val)
                                                                                <tr>
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

    <script src="{{asset('assets_blog/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="e8bd4ced2e01588821be6849-|49" defer=""></script>
    <script src="{{asset('assets_blog/js/script.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>

    <script>
        $(document).ready(function() {
            // تابع برای نمایش/مخفی کردن زیرمجموعه‌ها با کلیک بر روی دکمه
            $(".show-subtable-button").click(function() {
                $(this).closest('tr').next('tr.subtable-row').toggle();
            });
        });
    </script>
@stop
