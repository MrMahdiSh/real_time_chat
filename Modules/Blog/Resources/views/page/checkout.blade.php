@extends('blog::layouts.master_index')


@section('title')
    مرحله پرداخت
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

@stop


@section('content')

    @php
        $patient_user=Auth::guard('patient')->user();
    @endphp

    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">خانه</a></li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title"> پرداخت</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">جزییات پرداخت</h3>
                        </div>
                        <div class="card-body">

                            <form method="post" id="form" name="form"
                                  action="{{route('card.pay')}}">
                                @csrf
                                <div class="info-widget">
                                    <h4 class="card-title"></h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group card-label">
                                                <label>نام سفارش دهنده</label>
                                                <input value="{{$patient_user->full_name}}" name="name" id="name"
                                                       class="form-control" type="text">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group card-label">
                                                <label>شماره تماس</label>
                                                <input value="{{$patient_user->mobile}}" name="mobile" id="mobile"
                                                       class="form-control" type="text">
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="info-widget">
                                    <h4 class="card-title"></h4>
                                    <div class="form-group card-label">
                                        <label for="address" class="ps-0 ms-0 mb-2">آدرس </label>
                                        <textarea rows="5" class="form-control" id="address"
                                                  name="address">{{$patient_user->address}}</textarea>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group card-label">
                                            <label for="postal_code">کد پستی</label>
                                            <input name="postal_code" id="postal_code" class="form-control"
                                                   type="text"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="payment-widget">
                                    <h4 class="card-title">روش پرداخت</h4>

                                    <div class="payment-list">
                                        <label class="payment-radio credit-card-option">
                                            <input id="type" type="radio" value="wallet" name="type" checked>
                                            <span class="checkmark"></span>
                                            کیف پول
                                        </label>
                                    </div>


                                    <div class="payment-list">
                                        <label class="payment-radio paypal-option">
                                            <input type="radio" value="online" id="type" name="type">
                                            <span class="checkmark"></span>
                                            درگاه پرداخت
                                        </label>
                                    </div>
                                </div>
                                <div class="payment-widget">
                                    <div class="submit-section mt-4">
                                        <button type="submit" class="btn btn-primary submit-btn">انتقال به درگاه
                                            پرداخت
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 theiaStickySidebar">

                    <div class="card booking-card">
                        <div class="card-header">
                            <h3 class="card-title">سفارش شما</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center mb-0">
                                    <tr>
                                        <th>محصول</th>
                                        <th class="text-end">کل</th>
                                    </tr>
                                    <tbody>

                                    @isset($data)

                                        @foreach($data as $item)
                                            @if($item->product)
                                                <tr>
                                                    <td>  {{$item->product->title}}
                                                    </td>
                                                    <td class="text-end"> {{number_format(($item->product->offer_price*$item->count),null)}}
                                                        تومان
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endisset

                                    </tbody>
                                </table>
                            </div>
                            <div class="booking-summary pt-5">
                                @component('blog::componets.checkout',['patient_user'=>$patient_user,'product_setting'=>$product_setting])
                                @endcomponent
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
    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>



    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\CheckoutValidation', '#form'); !!}


    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/slick.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/aos.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/script.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>
    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="b97d855d680359945684ceb5-|49" defer=""></script>



    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="942f7db5747e2b6949c592c8-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="942f7db5747e2b6949c592c8-text/javascript"></script>



@stop
