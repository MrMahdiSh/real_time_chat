@extends('blog::layouts.master_index')


@section('title')
    {{$data->full_name}}
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fancybox/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/leaflet/leaflet.css')}}"
    />
    <script src="{{asset('assets_blog/leaflet/leaflet.js')}}"></script>

@stop


@section('content')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">خانه</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> پروفایل
                                پزشک
                            </li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">{{$data->full_name}}</h2>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container">

            <div class="card">
                <div class="card-body">
                    <div class="doctor-widget">
                        <div class="doc-info-left">
                            <div class="doctor-img">
                                <img src="{{isset($data->media) ? $data->media->url : asset('assets/img/avatar.jpg')}}"
                                     class="img-fluid" alt="{{$data->full_name}}">
                            </div>
                            <div class="doc-info-cont">
                                <h4 class="doc-name">{{$data->full_name}} @if($data->certificate==\App\Status::True)
                                        <i class="text-success fas fa-check-circle verified"></i>
                                    @endif</h4>

                                <p class="doc-speciality"> کد نظام پزشکی : {{$data->medical_system_code}}  </p>
                                <p class="doc-department"><img
                                        src="@if($data->category){{$data->category->media ? $data->category->media->url : ''}}@endif"
                                        class="img-fluid" alt=""> {{$data->category ? $data->category->title : ''}}
                                </p>
                                <div class="rating">
                                    <i class="fas fa-star  {{$data->stars >= 1 ? 'filled' : ''}}"></i>
                                    <i class="fas fa-star {{$data->stars >= 2 ? 'filled' : ''}}"></i>
                                    <i class="fas fa-star {{$data->stars >= 3 ? 'filled' : ''}}"></i>
                                    <i class="fas fa-star {{$data->stars >= 4 ? 'filled' : ''}}"></i>
                                    <i class="fas fa-star {{$data->stars >= 5 ? 'filled' : ''}}"></i>
                                    <span class="d-inline-block average-rating">({{$data->stars}})</span>
                                </div>
                                <div class="clinic-details">
                                    <p class="doc-location"><i
                                            class="fas fa-map-marker-alt"></i> {{$data->address_info}}  </p>
                                    <ul class="clinic-gallery">
                                        {{--                                        <li>--}}
                                        {{--                                            <a href="assets/img/features/feature-01.jpg" data-fancybox="gallery">--}}
                                        {{--                                                <img src="assets/img/features/feature-01.jpg" alt="Feature">--}}
                                        {{--                                            </a>--}}
                                        {{--                                        </li>--}}


                                    </ul>
                                </div>

                                @if($data->services)

                                    <div class="clinic-services">

                                        @foreach(explode(',',$data->services) as $val)
                                            <span>{{$val}}</span>
                                        @endforeach
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="doc-info-right">
                            <div class="clini-infos">
                                <ul>

                                    <li>
                                        <i class="far fa-money-bill-alt"></i> {{$data->setting_pay ? number_format($data->setting_pay->reserve_price,null) : number_format(5000,null)}}
                                        تومان
                                    </li>
                                </ul>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::guard('patient')->check())

                                <div class="doctor-action">


                                    @component('blog::componets.btn_favorite',['id'=>$data->id])
                                    @endcomponent



                                    @component('blog::componets.btn_chat',['id'=>$data->id])
                                    @endcomponent

                                </div>
                            @endif
                            <div class="clinic-booking">
                                <a class="apt-btn" href="{{route('doctor_reserved',['id'=>$data->id])}}">رزرو نوبت</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body pt-0">

                    <nav class="user-tabs mb-4">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="#doc_locations" data-bs-toggle="tab">اطلاعات دفتر</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_hospital" data-bs-toggle="tab">کلینیک</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_business_hours" data-bs-toggle="tab">ساعات کاری </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_reviews" data-bs-toggle="tab">نظرات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#doc_overview" data-bs-toggle="tab">رزومه</a>
                            </li>
                        </ul>
                    </nav>


                    <div class="tab-content pt-0">

                        <div role="tabpanel" id="doc_overview" class="tab-pane  fade">
                            <div class="row">
                                <div class="col-md-12 col-lg-9">

                                    <div class="widget about-widget">
                                        <h4 class="widget-title"> درباره من </h4>
                                        <p>{{$data->about_me}}</p>
                                    </div>

                                    @if( $data->education()->first())

                                        <div class="widget education-widget">
                                            <h4 class="widget-title"> تحصیلات </h4>
                                            <div class="experience-box">
                                                <ul class="experience-list">
                                                    @foreach($data->get_education->edu_title    as $key=>$item)
                                                        @if(!empty($item))
                                                            <li>
                                                                <div class="experience-user">
                                                                    <div class="before-circle"></div>
                                                                </div>
                                                                <div class="experience-content">
                                                                    <div class="timeline-content">
                                                                        <a href="#/" class="name">{{$item}}</a>
                                                                        <div>{{$data->get_education->edu_university[$key] ? $data->get_education->edu_university[$key] : ''}}</div>
                                                                        <span
                                                                            class="time">{{$data->get_education->edu_date[$key] ? $data->get_education->edu_date[$key] : ''}}</span>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                        @endif
                                                    @endforeach


                                                </ul>
                                            </div>
                                        </div>
                                    @endif


                                    @if( $data->exprience()->first())

                                        <div class="widget experience-widget">
                                            <h4 class="widget-title"> کار و تجربه </h4>
                                            <div class="experience-box">
                                                <ul class="experience-list">

                                                    @foreach($data->get_experience->ex_title    as $key=>$item)
                                                        @if(!empty($item))

                                                            <li>
                                                                <div class="experience-user">
                                                                    <div class="before-circle"></div>
                                                                </div>
                                                                <div class="experience-content">
                                                                    <div class="timeline-content">
                                                                        <a href="#/" class="name">{{$item}}
                                                                            -{{$data->get_experience->ex_role[$key]}}</a>
                                                                        <span
                                                                            class="time">{{$data->get_experience->ex_from[$key]}} - {{$data->get_experience->ex_to[$key]}}</span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach


                                                </ul>
                                            </div>
                                        </div>
                                    @endif


                                    @if( $data->reward()->first())

                                        <div class="widget awards-widget">
                                            <h4 class="widget-title">جایزه ها</h4>
                                            <div class="experience-box">
                                                <ul class="experience-list">

                                                    @foreach($data->get_reward->rew_title    as $key=>$item)
                                                        @if(!empty($item))

                                                            <li>
                                                                <div class="experience-user">
                                                                    <div class="before-circle"></div>
                                                                </div>
                                                                <div class="experience-content">
                                                                    <div class="timeline-content">
                                                                        <p class="exp-year">{{$data->get_reward->rew_date[$key]}}</p>
                                                                        <h4 class="exp-title">{{$item}}</h4>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>

                                    @endif


                                    @if($data->services)
                                        <div class="service-list">
                                            <h4>خدمات</h4>
                                            <ul class="clearfix">
                                                @foreach(explode(',',$data->services) as $val)
                                                    <li>{{$val}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif





                                    @if($data->specialist)
                                        <div class="service-list">
                                            <h4>تخصص ها</h4>
                                            <ul class="clearfix">
                                                @foreach(explode(',',$data->specialist) as $val)
                                                    <li>{{$val}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>


                        <div role="tabpanel" id="doc_hospital" class="tab-pane fade">

                            <div class="location-list">

                                @if($data->clinic)
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="clinic-content">
                                                <h4 class="clinic-name"><a href="#">{{$data->clinic->title}}</a></h4>
                                                <p class="doc-speciality"> {!! $data->clinic->description !!}</p>

                                                <div class="clinic-details mb-0">
                                                    <h5 class="clinic-direction"><i class="fas fa-map-marker-alt"></i>
                                                        {{$data->clinic->address}} <br></h5>
                                                    <ul>

                                                        @if(count($data->clinic->gallery)> 0)
                                                            @foreach($data->clinic->gallery as $item)
                                                                <li>
                                                                    <a href="{{$item->url}}"
                                                                       data-fancybox="gallery2">
                                                                        <img src="{{$item->url}}"
                                                                             alt="{{$data->clinic->title}}">
                                                                    </a>
                                                                </li>

                                                            @endforeach
                                                        @endif

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                            </div>
                            @endif


                        </div>


                        <div role="tabpanel" id="doc_locations" class="tab-pane show active">
                            @if($data->contact)

                                <div class="location-list">

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="clinic-content">
                                                <p class="clinic-direction">شماره تماس : <a
                                                        href="tel:{{$data->contact->phone_1}}">{{$data->contact->phone_1}}</a>
                                                </p>
                                                @if(!empty($data->contact->phone_2))
                                                    <p class="clinic-direction">شماره تماس : <a
                                                            href="tel:{{$data->contact->phone_2}}">{{$data->contact->phone_2}}</a>
                                                    </p>
                                                @endif

                                                <hr>
                                                <div class="clinic-details mb-0">
                                                    <strong class=" clinic-name "><i class="fas fa-map-marker-alt"></i>
                                                        {{$data->contact->address_1}} <br></strong>


                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div id="map"
                                     style="border:  1px white solid;border-radius: 10px;width: 100%;height: 350px "
                                     class="col-12 col-sm-12">
                                </div>
                        </div>
                        @endif


                        <div role="tabpanel" id="doc_reviews" class="tab-pane fade">
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
                                          action="{{route('doctor.feedback')}}">
                                        <div class="form-group">
                                            <label>ستاره</label>
                                            <input name="doc_id" value="{{$data->id}}" id="doc_id" hidden>

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

                                                <input id="star-3" type="radio" name="star" value="3">
                                                <label for="star-3" title="3 stars">
                                                    <i class="active fa fa-star"></i>
                                                </label>

                                                <input id="star-4" type="radio" name="star" value="2">
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
                                                    <input type="radio" id="suggest" value="yes" name="suggest">
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


                        <div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <div class="widget business-wid`get">
                                        <div class="widget-content">
                                            @include('blog::partials.schedule_time_doctor_profile',[
    'today_schedule'=>$today_schedule, 'Saturday'=>$Saturday, 'Sunday'=>$Sunday,
            'Monday'=>$Monday,
            'Thursday'=>$Thursday,
            'Wednesday'=>$Wednesday,
            'Friday'=>$Friday,
            'Tuesday'=>$Tuesday

])
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
    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\FeedBackValidation', '#feed_back'); !!}

    <script src="{{asset('assets_blog/plugins/fancybox/jquery.fancybox.min.js')}}"
            type="c05b42694ff6ef93b74325a7-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>



    <script src="{{asset('assets_blog/js/script.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>
    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="b97d855d680359945684ceb5-|49" defer=""></script>
    <script src="{{asset('assets_blog/js/custom_leaftLeatMap.js')}}"
    ></script>



    <script>
            @if(!empty($data->contact->lat_map))

        var marker;
        var map = L.map('map').setView(['{{$data->contact->lat_map}}', '{{$data->contact->lang_map}}'], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        function AddMarker(lat, lng, detail) {

            marker = L.marker([lat, lng]).addTo(map)
                .bindPopup(detail)
                .openPopup();
        }

        map.on('click', function (e) {

        });
        // navigator.geolocation.getCurrentPosition(function (location) {
        //     var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
        //
        //     map.flyTo(latlng, 15);
        //
        // });


        AddMarker('{{$data->contact->lat_map}}', '{{$data->contact->lang_map}}', '{{$data->contact->address_1}} ');
        @endif
    </script>
@stop
