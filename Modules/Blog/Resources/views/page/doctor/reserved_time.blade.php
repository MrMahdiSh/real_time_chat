@extends('blog::layouts.master_index')


@section('title')
    نوبت دهی
@stop

@section('css')

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">


    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/select2/css/select2.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/dropzone/dropzone.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('date_assets/css/persianDatepicker-default.css')}}"/>

    <link rel="stylesheet" href="{{asset('assets_blog/fstdropdown/fstdropdown.css')}}">

@stop


@section('content')

    @include('blog::partials.doctor_breadcrumb',['title'=>'نوبت دهی '])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                    @include('blog::partials.doctor_sidebar')

                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">زمان‌بندی</h4>
                                    <div class="profile-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-12 avail-time">
                                                <div class="mb-3">
                                                    <div class="schedule-calendar-col justify-content-start">
                                                        <form name="form" id="form" method="get"
                                                              action="{{route('doctor.reserved_time')}}"
                                                              class="d-flex flex-wrap">

                                                            @csrf
                                                            <span class="input-group-text" style="margin-left: 5px;margin-right: 5px">تاریخ:</span>
                                                            <div class="me-3">
                                                                <input type="text" class="form-control date"
                                                                       name="date" id="date" required
                                                                       value="{{$date}}"
                                                                       min="2021-05-21">
                                                            </div>
                                                            <div class="search-time-mobile">
                                                                <input type="submit" name="submit" value="جستجو"
                                                                       class="btn btn-primary h-100">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h3 class="h3 text-center book-btn2 mt-3 px-5 py-1 mx-3 rounded">
                                                    <sup></sup>
                                                    {{"   تعداد نوبت های مانده : " .(31-$data->count())}}</h3>

                                                <div class="token-slot mt-2">
                                                    @php
                                                        $hour=7;
                                                        $minute=0;
                                                    @endphp
                                                    @for($i=0;$i<31;$i++)
                                                        @php
                                                            $ck=$data->where('time',"$hour:$minute")->first();
                                                        @endphp
                                                        <a href="@if(empty($ck->client_id))   {{route('doctor.reserved_time.reserve',['time'=>"$hour:$minute",'date'=>$date])}} @else # @endif"
                                                           class="form-check-inline visits me-0">
                                                            <label class="visit-btns">

                                                                <span
                                                                    class="visit-rsn  {{$data->where('time',"$hour:$minute")->first() ? 'reserved_disable' : 'reserved_activate' }}"
                                                                    data-bs-toggle="tooltip"
                                                                    title="{{"$hour:$minute"}}">{{"$hour:$minute"}} {{$hour>11  ? ' عصر ' : 'صبح'}}</span>
                                                            </label>
                                                        </a>


                                                        @php
                                                            $minute+=30;
                                                            if ($minute==60){
                                                                $minute=0;
                                                                 $hour++;
                                                            }
                                                        @endphp

                                                    @endfor

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
    </div>

@stop


@section('js')

    <script type="text/javascript" src="{{asset('assets_blog/js/jquery-migrate-1.2.1.min.js')}}"></script>



    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>


    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>


    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>





    <script src="{{asset('assets_blog/plugins/select2/js/select2.min.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>



    <script src="{{asset('date_assets/js/persianDatepicker.js')}}"></script>


    <script src="{{asset('assets_blog/js/script.js')}}" type="1cce86bdda76a43346990492-text/javascript"></script>
    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="1cce86bdda76a43346990492-|49" defer=""></script></body>


    <script>

        function change_week(value) {


            document.getElementById('week').value = value;


            let user_id = '{{Auth::id()}}'
            $.ajax({
                url: `{{url('api/doctor_schedule_time')}}/${value}/${user_id}`,
            }).done(function (data) {
                document.getElementById("schedule_info_content").innerHTML = null;
                document.getElementById("schedule_info_content").innerHTML = data;
            });


        }

    </script>
    <script>
        $(".date").persianDatepicker();

    </script>
@stop
