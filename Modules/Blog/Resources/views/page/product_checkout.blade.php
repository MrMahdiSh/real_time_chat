@extends('blog::layouts.master_index')


@section('title')
    سبد خرید
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
                    <h2 class="breadcrumb-title">سبد خرید</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="card card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                            <tr>
                                <th>محصول</th>
                                <th>شناسه</th>
                                <th>قیمت</th>
                                <th class="text-center">تعداد</th>
                                <th class="text-center">کل</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @isset($data)

                                @foreach($data as $item)
                                    @if($item->product)
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="{{route('product.detail',['id'=>$item->product_id,'title'=>$item->product->title])}}"
                                                       class="avatar avatar-sm me-2"><img
                                                            class="avatar-img"
                                                            src="{{$item->product->media ? $item->product->media->url : asset('assets_blog/img/no_image.png')}}"
                                                            alt="{{$item->product->title}}"></a>
                                                </h2>
                                                <a href="{{route('product.detail',['id'=>$item->product_id,'title'=>$item->product->title])}}">
                                                    {{$item->product->title}}   </a>
                                            </td>
                                            <td>{{$item->product->number}}</td>
                                            <td>{{number_format($item->product->offer_price,null)}}تومان</td>
                                            <td class="text-center">
                                                <div class="custom-increment cart">
                                                    <div class="input-group1">
<span class="input-group-btn">
<a href="{{route('card.remove',['product_id'=>$item->product_id,'count'=>1])}}"
   class="  btn btn-danger btn-number" data-type="minus" data-field="">
<span><i class="fas fa-minus"></i></span>
</a>
</span>
                                                        <input disabled type="text" id="quantity1" name="quantity1"
                                                               class=" input-number"
                                                               value="{{$item->count}}">
                                                        <span class="input-group-btn">
<a href="{{route('card.add',['product_id'=>$item->product_id,'count'=>1])}}"
   class="  btn btn-success btn-number" data-type="plus">
<span>  <i
        class="fas fa-plus"></i></span>
    </a>
</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">{{number_format(($item->product->offer_price*$item->count),null)}}
                                                تومان
                                            </td>
                                            <td class="text-end">
                                                <div class="table-action">
                                                    <a href="{{route('card.remove',['product_id'=>$item->product_id,'count'=>$item->count])}}"
                                                       class="btn btn-sm bg-danger-light">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if(isset($patient_user) && $patient_user->getAmountProductPrice()>0)
                <div class="row">
                    <div class="col-md-7 col-lg-8">
                    </div>
                    <div class="col-md-5 col-lg-4">

                        <div class="card booking-card">
                            <div class="card-header">
                                <h4 class="card-title">مجموع سبد خرید</h4>
                            </div>
                            <div class="card-body">
                                <div class="booking-summary">
                                    <div class="booking-item-wrap">
                                        <ul class="booking-date">
                                            <li>هزینه
                                                محصول<span>{{number_format($patient_user->getAmountProductPrice(),null).' تومان '}}</span>
                                            </li>
                                            <li>حمل و
                                                نقل<span>{{(int)$product_setting->transfer_price>0 ? number_format($product_setting->transfer_price,null).'تومان' : 'رایگان'}} </span>
                                            </li>
                                        </ul>
                                        <ul class="booking-fee pt-4">
                                            <li>مالیات<span>{{(int)$product_setting->tax_price>0 ? "{$product_setting->tax_price}%" : 'بدون مالیات'}} </span>
                                            </li>
                                        </ul>
                                        <div class="booking-total">
                                            <ul class="booking-total-list">
                                                <li>
                                                    <span>مبلغ نهایی پرداختی</span>
                                                    <span
                                                        class="total-cost">{{number_format($patient_user->TotalPriceProduct(),null)}}تومان</span>
                                                </li>
                                                <li>
                                                    <div class="clinic-booking pt-4">
                                                        <a class="apt-btn" href="{{route('card.checkout.pay')}}"> ادامه
                                                            مرحله
                                                            پرداخت </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </div>


@stop


@section('js')
    <script type="text/javascript" src="{{asset('assets_blog/js/jquery-migrate-1.2.1.min.js')}}"></script>
    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

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
