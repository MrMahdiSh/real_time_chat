@extends('blog::layouts.master_index')


@section('title')
    سفارشات
@stop

@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">


    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">


    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

@stop


@section('content')

    @include('blog::partials.doctor_breadcrumb',['title'=>'ُسفارشات'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    @include('blog::partials.doctor_sidebar')

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
                                                        <th>شناسه</th>
                                                        <th>محصول</th>
                                                        <th>مبلغ</th>
                                                        <th>تعداد</th>
                                                        <th>وضعیت</th>
                                                        <th>جزییات</th>
                                                    </tr>
                                                    </thead>


                                                    @if(!empty($data))

                                                        @foreach($data as $key=>$val)
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <hr>
                                                                    <br>
                                                                </td>
                                                            </tr>
                                                            @foreach($val as $key2=>$item)
                                                                <tr class="bg-light">
                                                                    <td>{{$key2+1}}</td>
                                                                    <td>{{$item->title}}</td>
                                                                    <td>{{number_format($item->price,null)}}</td>
                                                                    <td>{{$item->count}}</td>
                                                                    @isset($item->order)
                                                                        @switch($item->order->status)
                                                                            @case(\App\OrderStatus::Paid)
                                                                            <td class="alert text-primary btn">
                                                                                <a href="{{route('doctor.order.status',['id'=>$item->order->id])}}">تاییدیه
                                                                                    ارسال </a>
                                                                            </td>
                                                                            @break
                                                                            @case(\App\OrderStatus::Unpaid)
                                                                            <td class="alert text-danger btn">پرداخت
                                                                                نشده
                                                                            </td>
                                                                            @break
                                                                            @case(\App\OrderStatus::Delivered)
                                                                            <td class="alert text-success btn ">ارسال
                                                                                شده
                                                                            </td>
                                                                            @break
                                                                        @endswitch
                                                                    @endisset
                                                                    <td>
                                                                        <button
                                                                            class="btn btn-primary show-subtable-button">
                                                                            مشاهده
                                                                            جزییات
                                                                        </button>
                                                                    </td>
                                                                </tr>

                                                                @isset($item->order)
                                                                    <tr class="subtable-row" style="display: none;">
                                                                        <td colspan="3">
                                                                            <table class="table">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th scope="col">شماره سفارش</th>
                                                                                    <th scope="col">مبلغ</th>
                                                                                    <th scope="col">آدرس</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td>{{$item->order->number}}</td>
                                                                                    <td>{{number_format($item->order->price,null).' تومان '}}</td>
                                                                                    <td>{!! $item->order->address !!}</td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                @endisset
                                                            @endforeach
                                                            </tbody>
                                                        @endforeach
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

    <script src="{{asset('assets_blog/js/script.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>
    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="b97d855d680359945684ceb5-|49" defer=""></script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>


    <script>
        $(document).ready(function () {
            // تابع برای نمایش/مخفی کردن زیرمجموعه‌ها با کلیک بر روی دکمه
            $(".show-subtable-button").click(function () {
                $(this).closest('tr').next('tr.subtable-row').toggle();
            });
        });
    </script>
@stop
