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

@stop


@section('content')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">خانه</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                رزرو نوبت
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="booking-doc-info">
                                <a href="{{route('doctor_profile',['id'=>$data->id,'title'=>$data->full_name])}}"
                                   class="booking-doc-img">
                                    <img src="{{$data->media ? $data->media->url : asset('assets/img/avatar.png')}}"
                                         alt="{{$data->full_name}}">
                                </a>
                                <div class="booking-info">
                                    <h4>
                                        <a href="{{route('doctor_profile',['id'=>$data->id,'title'=>$data->full_name])}}">{{$data->full_name}}</a>
                                    </h4>
                                    <div class="rating">
                                        <i class="fas fa-star  {{$data->stars >= 1 ? 'filled' : ''}}"></i>
                                        <i class="fas fa-star {{$data->stars >= 2 ? 'filled' : ''}}"></i>
                                        <i class="fas fa-star {{$data->stars >= 3 ? 'filled' : ''}}"></i>
                                        <i class="fas fa-star {{$data->stars >= 4 ? 'filled' : ''}}"></i>
                                        <i class="fas fa-star {{$data->stars >= 5 ? 'filled' : ''}}"></i>
                                        <span class="d-inline-block average-rating">({{$data->stars}})</span>
                                    </div>
                                    <p class="text-muted mb-0"><i
                                            class="fas fa-map-marker-alt"></i> {{$data->address_info}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4 col-md-6">
                            <h4 class="mb-1">{{\App\Helper\Core::ArticleDate($now,false)}}</h4>
                            {{--                            <p class="text-muted">دوشنبه</p>--}}
                        </div>
                        {{--                        <div class="col-12 col-sm-8 col-md-6 text-sm-end">--}}
                        {{--                            <div class="bookingrange btn btn-white btn-sm mb-3">--}}
                        {{--                                <i class="far fa-calendar-alt me-2"></i>--}}
                        {{--                                <span></span>--}}
                        {{--                                <i class="fas fa-chevron-down ms-2"></i>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>

                    <div class="card booking-schedule schedule-widget">

                        <div class="schedule-header">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="day-slot">
                                        <ul>
                                            {{--                                            <li class="left-arrow">--}}
                                            {{--                                                <a href="#">--}}
                                            {{--                                                    <i class="fa fa-chevron-left"></i>--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </li>--}}
                                            @for($i=0;$i<7;$i++)
                                                @php
                                                    $date=\App\Helper\Core::ReserveDate($weekStartDate,false)
                                                @endphp

                                                @if(Carbon\Carbon::parse($weekStartDate)->addDay()  >  Carbon\Carbon::now())
                                                    <li>
                                                        <span>{{$date[0]}}</span>
                                                        <span class="slot-date">    {{$date[1].' '.$date[2]}} <small
                                                                class="slot-year">{{$date[3]}}</small></span>
                                                    </li>

                                                @else
                                                    <li>
                                                        <span>---</span>
                                                        <span class="slot-date">   ----- <small
                                                                class="slot-year">---</small></span>
                                                    </li>

                                                @endif
                                                @php
                                                    $weekStartDate=$weekStartDate->addDay();
                                                @endphp
                                            @endfor


                                            {{--                                            <li class="right-arrow">--}}
                                            {{--                                                <a href="#">--}}
                                            {{--                                                    <i class="fa fa-chevron-right"></i>--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </li>--}}
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="schedule-cont">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="time-slot">
                                        <ul class="clearfix">

                                            @php
                                                $weekStartDate=$weekStartDate->subDays(7);
                                            @endphp
                                            @for($j=0;$j<7;$j++)
                                                @php
                                                    $date=\App\Helper\Core::persianDate($weekStartDate,false);
                                                    $times_schedules=$data->schedule()->where('week',\App\Helper\Core::translate_week($weekStartDate->dayName))->get();
                                                @endphp

                                                @if(count($times_schedules)>0)
                                                    @foreach($times_schedules as $val)



                                                        @if(Carbon\Carbon::parse($weekStartDate)->addDay()  >  Carbon\Carbon::now())
                                                            <li>

                                                                @for($i=$val->s_time;$i<=$val->e_time;$i++)
                                                                    @php
                                                                        $hour=$i;
                                                                           $minute=0;
                                                                          $temp_time="$hour:$minute";

                                                                          $check= $full_date->
                                                                          where('time',$temp_time)->
                                                                          where('date',$weekStartDate)
                                                                          ->first();


                                                                    @endphp



                                                                    @if(empty($check))
                                                                        <a class="timing"
                                                                           href="@if(Auth::guard('patient')->check())    {{route('reserved_doctor_schedule',['time'=>"$hour:$minute",'date'=>$date,'doc_id'=>$data->id])}} @else{{route('patient.login')}} @endif">
                                                                            <span>{{"$hour:$minute"}}</span>
                                                                            <span>{{$i<=11 ? ' صبح ' : ' عصر ' }}</span>
                                                                        </a>
                                                                    @endif



                                                                    @php
                                                                        $test= 60 / (int)$data->setting->reserve_time;
                                                                            $minute=$data->setting->reserve_time;

                                                                    @endphp


                                                                    @for($timer=0 ; $timer < $test ; $timer++)
                                                                        @php

                                                                            $temp_time="$hour:$minute";
                                                                            $check= $full_date->
                                                                            where('time',$temp_time)->
                                                                            where('date',$weekStartDate)
                                                                            ->first();


                                                                        @endphp


                                                                        @if(empty($check) && $minute < 60)

                                                                            <a class="timing"
                                                                               href="@if(Auth::guard('patient')->check()) {{route('reserved_doctor_schedule',['time'=>"$hour:$minute",'date'=>$date,'doc_id'=>$data->id])}} @else{{route('patient.login')}} @endif">
                                                                                <span>{{"$hour:$minute"}}</span>
                                                                                <span>{{$i<=11 ? ' صبح ' : ' عصر ' }}</span>
                                                                            </a>

                                                                        @endif

                                                                        @php
                                                                            $minute = $minute +$data->setting->reserve_time;

                                                                        @endphp

                                                                    @endfor

                                                                @endfor
                                                            </li>

                                                        @else

                                                            <li>-----</li>

                                                        @endif


                                                    @endforeach
                                                @else
                                                    <li>
                                                        <a class="timing"
                                                           href="#">
                                                            <span>--</span>
                                                            <span>--</span>
                                                        </a>
                                                    </li>
                                                @endif

                                                @php
                                                    $weekStartDate=$weekStartDate->addDay();
                                                @endphp
                                            @endfor


                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>


                    {{--                    <div class="submit-section proceed-btn text-end">--}}
                    {{--                        <a href="checkout.html" class="btn btn-primary submit-btn">ادامه فرایند خرید</a>--}}
                    {{--                    </div>--}}

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
            data-cf-settings="b97d855d680359945684ceb5-|49" defer=""></script></body>

@stop
