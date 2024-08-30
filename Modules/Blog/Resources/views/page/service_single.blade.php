@if($data->doctor)

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
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{route('services')}}">خدمات</a>
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
                            <div class="doctor-widget" >
                                <div class="doc-info-left ">
                                    <div class="doctor-img1 text-center  " >
                                        <img  style="border-radius: 20px;border: 1px solid white"
                                            src="{{$data->media ? $data->media->url : asset('assets_blog/img/no_image.png')}}"
                                            class="img-fluid   "   alt="{{$data->title}}">
                                    </div>
                                    <div class="doc-info-cont">
                                        <h4 class="doc-name mb-2 text-center">{{$data->title}}  {{$data->doctor ? $data->doctor->full_name : ''}} </h4>
                                        @if(!empty($data->description))
                                            <div class="widget about-widget">
                                                <br>
                                                <hr>
                                                <p>{!! $data->description !!}</p>
                                            </div>

                                        @endif


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
                                        <hr>

                                        @if(!empty($data->offer))
                                            <b
                                                class="text-lg strike">{{number_format($data->price,null)}}تومان</b>
                                            <hr>
                                            <span
                                                class="text-lg text-success"><b>{{!empty($data->offer)? $data->offer.'% تخفیف ' : ''}}</b></span>

                                        @endif

                                    </h2>
                                </div>


                                <div class="clinic-booking">
                                    <a href="{{route('doctor_service_reserved',['service_id'=>$data->id,'doctor_id'=>$data->doctor->id])}}"
                                       class="btn btn-primary ">درخواست
                                        نوبت
                                    </a>
                                </div>


                            </div>
                            <ul class="list-group list-group-flush benifits-col">
                                <li class="list-group-item d-flex align-items-center">
                                    <div>
                                        <i class="fas fa-certificate"></i>
                                    </div>
                                    <div>
                                        کیفیت بالا و پزشکان متخصص<br><span class="text-sm"></span>
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
                                        <i class="fa fa-hands"></i>
                                    </div>
                                    <div>
                                        پرداخت امن<br><span class="text-sm"></span>
                                    </div>
                                </li>


                            </ul>

                        </div>
                </div>
                </form>


            </div>

            @component('blog::componets.doctor_profile_service_item',['item'=>$data->doctor,'service_id'=>$data->id])
            @endcomponent
            <hr>

            <p
                class="alert alert-success"><b
                    class="text-success fa fa-certificate">تضمین بازگشت وجه</b> اگر خدمت مطابق با توضیحات نباشد ، پس
                از بررسی کارشناسان 100% مبلغ بازگردانده می شود</p>
            <div class="row card  p-2">

                <p class="fa fa-info"> شرایط و قوانین </p>
                <br>
                {!! $setting ? $setting->rules : '' !!}

            </div>
            <div class="row card  p-2">
                <div role="tabpanel" id="doc_reviews" class="tab-pane  ">
                    @if($data->rate)
                        <div class="widget review-listing">
                            <ul class="comments-list">
                                @foreach($data->rate as $item)

                                    @component('blog::componets.reviews',['item'=>$item])
                                    @endcomponent
                                @endforeach


                            </ul>


                        </div>
                    @endif
                    <div class="write-review">
                        <h4> نظر برای <strong>{{$data->full_name}}</strong></h4>
                        @if(Auth::guard('patient')->check())
                            <form name="feed_back" id="feed_back" method="post"
                                  action="{{route('service.feedback')}}">
                                <div class="form-group">
                                    <label>ستاره</label>
                                    <input name="service_id" value="{{$data->id}}" id="doc_id" hidden>

                                    <div class="star-rating">
                                        <p class="alert alert-info">امتیاز به صورت ستاره اجباریست!</p>
                                        <input required id="star-1" type="radio" name="star" value="5">
                                        <label for="star-1" title="1 star">
                                            <i class="active fa fa-star"></i>
                                        </label>

                                        <input id="star-2" type="radio" name="star" value="4">
                                        <label for="star-2" title="2 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>

                                        <input id="star-3"  checked type="radio" name="star" value="3">
                                        <label for="star-3" title="3 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>

                                        <input id="star-4"  type="radio" name="star" value="2">
                                        <label for="star-4" title="4 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>
                                        <input id="star-5" type="radio" name="star" value="1">
                                        <label for="star-5" title="5 stars">
                                            <i class="active fa fa-star"></i>
                                        </label>


                                    </div>
                                </div>
                                @csrf
                                <div class="form-group">
                                    <label>نظر شما</label>
                                    <textarea id="review_desc" name="message" maxlength="100"
                                              class="form-control"></textarea>
                                    <div class="d-flex justify-content-between mt-3"><small
                                            class="text-muted"><span
                                                id="chars">100</span> کارکتر مانده</small></div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="terms-accept">
                                        <div class="custom-checkbox">
                                            <input checked type="radio" id="suggest" value="yes" name="suggest">
                                            <label for="terms_accept"><a href="#" class="like-btn">
                                                    <i class="far fa-thumbs-up"></i>
                                                </a> <a href="#">پیشنهاد
                                                    میکنم</a></label>
                                        </div>
                                        <div class="custom-checkbox">
                                            <input type="radio" id="suggest" value="no" name="suggest">
                                            <label for="terms_accept"><a href="#" class="like-btn">
                                                    <i class="far fa-thumbs-down"></i>
                                                </a><a href="#">پیشنهاد
                                                    نمیکنم</a></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">افزودن نظر</button>
                                </div>
                            </form>
                        @else
                            <p class="alert alert-warning">
                                شما در حال حاضر به سایت وارد نشده اید ، لطفا ابتدا <a class="text-danger"
                                                                                      href="{{route('patient.login')}}">وارد</a>
                                شوید و یا <a class="text-danger"
                                             href="{{route('patient.register')}}"> ثبت نام</a> کنید
                            </p>
                        @endif
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
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\FeedBackValidation', '#feed_back'); !!}

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

@endif
