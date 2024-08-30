@extends('blog::layouts.master_index')


@section('title')
    {{$data->title}}
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

@stop


@section('content')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">خانه</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('products')}}">محصولات</a>
                            </li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">{{$data->title}}</h2>
                </div>
            </div>
        </div>
    </div>



    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7 col-lg-9 col-xl-9">

                    <div class="card">
                        <div class="card-body product-description">
                            <div class="doctor-widget">
                                <div class="doc-info-left">
                                    <div class="doctor-img1">
                                        <img
                                            src="{{$data->media ? $data->media->url : asset('assets_blog/img/no_image.png')}}"
                                            class="img-fluid" alt="{{$data->title}}">
                                    </div>
                                    <div class="doc-info-cont">
                                        <h4 class="doc-name mb-2">{{$data->title}}</h4>
                                        @if(!empty($data->description))
                                            <div class="widget about-widget">
                                                <br>
                                                <hr>
                                                <p>{!! $data->description !!}</p>
                                            </div>

                                        @endif

                                        <div class="tab-content pt-3">

                                            <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                                                <div class="row">
                                                    <div class="col-md-9">


                                                        @if(!empty($data->how_to_use))
                                                            <div class="widget about-widget">
                                                                <h4 class="widget-title"> جهت استفاده </h4>
                                                                <p>{!! $data->how_to_use !!}</p>

                                                            </div>
                                                        @endif


                                                        @if(!empty($data->keeping))
                                                            <div class="widget about-widget">
                                                                <h4 class="widget-title">نگهداری</h4>
                                                                <p>{!! $data->keeping !!}</p>

                                                            </div>
                                                        @endif


                                                        @if(!empty($data->instruction))
                                                            <div class="widget about-widget">
                                                                <h4 class="widget-title">دستورالعمل مصرف</h4>
                                                                <p>{!! $data->instruction !!}</p>
                                                            </div>
                                                        @endif


                                                        @if(!empty($data->warning))
                                                            <div class="widget about-widget mb-3">
                                                                <h4 class="widget-title"> هشدار </h4>
                                                                <p class="mb-0">{!! $data->warning !!}</p>
                                                            </div>

                                                        @endif

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
                <div class="col-md-5 col-lg-3 col-xl-3  ">
                    <form method="get" action="{{route('card.add')}}">
                        <input hidden name="product_id" id="product_id" value="{{$data->id}}">
                        <div class="card search-filter">
                            <div class="card-body">
                                <div class="clini-infos mt-0">
                                    <h2>{{number_format($data->offer_price,null).' تومان '}}

                                        @if(!empty($data->offer))
                                            تومان<b
                                                class="text-lg strike">{{number_format($data->price,null)}}تومان</b>

                                            <span
                                                class="text-lg text-success"><b>{{!empty($data->offer)? $data->offer.'% تخفیف ' : ''}}</b></span>

                                        @endif


                                    </h2>
                                </div>

                                @if($data->count>0)
                                    <span class="badge badge-primary">در انبار موجود می باشد</span>
                                @endif

                                @if((int)$data->count>0 && Auth::guard('patient')->check())

                                    <div class="custom-increment pt-4">
                                        <div class="input-group1">
<span class="input-group-btn float-start">
<button type="button" class="quantity-left-minus btn btn-danger btn-number" onclick="CountP('minus')"
>
<span><i class="fas fa-minus"></i></span>
</button>
</span>
                                            <input type="text" id="quantity" name="count" class=" input-number"
                                                   value="1">
                                            <span class="input-group-btn float-end">
<button type="button" class="quantity-right-plus btn btn-success btn-number" onclick="CountP('Add')"
>
<span><i class="fas fa-plus"></i></span>
 </button>
</span>
                                        </div>
                                    </div>
                                @endif

                                <div class="clinic-details mt-4">

                                    @if((int)$data->count>0 && Auth::guard('patient')->check())


                                        <div class="clinic-booking">
                                            <button class="btn btn-primary apt-btn"> به سبد خرید اضافه کنید</button>
                                        </div>

                                    @else
                                        <div class="clinic-booking">
                                            <a href="{{route('patient.login')}}" class="btn btn-primary apt-btn">ورود به
                                                حساب
                                                کاربری</a>
                                        </div>


                                    @endif

                                </div>
                                <div class="card flex-fill mt-4 mb-0">
                                    <ul class="list-group list-group-flush">
                                        @if(!empty($data->number))
                                            <li class="list-group-item">شناسه<span
                                                    class="float-end">{{$data->number}}</span></li> @endif
                                        @if(!empty($data->size))
                                            <li class="list-group-item">سایز بسته <span
                                                    class="float-end">{{$data->size}}</span></li> @endif
                                        @if(!empty($data->country))
                                            <li class="list-group-item"> کشور <span
                                                    class="float-end"> {{$data->country}} </span></li>@endif

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card search-filter">
                        <div class="card-body">
                            <div class="card flex-fill mt-0 mb-0">
                                <ul class="list-group list-group-flush benifits-col">
                                    <li class="list-group-item d-flex align-items-center">
                                        <div>
                                            <i class="fas fa-shipping-fast"></i>
                                        </div>
                                        <div>
                                            ارسال رایگان<br><span class="text-sm"></span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <div>
                                            <i class="far fa-question-circle"></i>
                                        </div>
                                        <div>
                                            پشتیبانی 24 ساعته<br><span class="text-sm"></span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <div>
                                            <i class="fas fa-hands"></i>
                                        </div>
                                        <div>
                                            <br><span class="text-sm">پرداخت امن</span>
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


    <script>
        function CountP(type) {

            quantity = document.getElementById('quantity');
            var count = parseInt(quantity.value);
            count = type == 'Add' ? count++ : count--;

            if (count < 1) {
                count = 1;
            }
            console.log(count)
            quantity.value = count;
        }


    </script>
@stop
