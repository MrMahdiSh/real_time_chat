@extends('blog::layouts.master_index')


@section('title')
    زمان بندی
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

    @include('blog::partials.doctor_breadcrumb',['title'=>'زمان بندی'])

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
                                            <div class="col-md-12">
                                                <div class="card schedule-widget mb-0">

                                                    <div class="schedule-header">

                                                        <div class="schedule-nav">
                                                            <ul class="nav nav-tabs nav-justified">
                                                                <li class="nav-item">
                                                                    <a onclick="change_week('Saturday')"
                                                                       class="nav-link active" data-bs-toggle="tab"
                                                                       href="#slot_saturday">شنبه</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a onclick="change_week('Sunday')" class="nav-link "
                                                                       data-bs-toggle="tab"
                                                                       href="#slot_sunday">یکشنبه</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a onclick="change_week('Monday')" class="nav-link"
                                                                       data-bs-toggle="tab"
                                                                       href="#slot_monday">دوشنبه</a>
                                                                </li>


                                                                <li class="nav-item">
                                                                    <a onclick="change_week('Tuesday')" class="nav-link"
                                                                       data-bs-toggle="tab"
                                                                       href="#slot_tuesday">سه شنبه</a>
                                                                </li>


                                                                <li class="nav-item">
                                                                    <a onclick="change_week('Wednesday')"
                                                                       class="nav-link" data-bs-toggle="tab"
                                                                       href="#slot_wednesday">چهارشنبه</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a onclick="change_week('Thursday')"
                                                                       class="nav-link" data-bs-toggle="tab"
                                                                       href="#slot_thursday">پنج شنبه</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a onclick="change_week('Friday')" class="nav-link"
                                                                       data-bs-toggle="tab"
                                                                       href="#slot_friday">جمعه</a>
                                                                </li>

                                                            </ul>
                                                        </div>

                                                    </div>


                                                    <div class="tab-content schedule-cont">

                                                        <div id="slot_sunday" class="tab-pane fade">
                                                            <h4 class="card-title d-flex justify-content-between">
                                                                <span>زمان بندی</span>
                                                                <a class="edit-link" data-bs-toggle="modal"
                                                                   href="#add_time_slot"><i
                                                                        class="fa fa-plus-circle"></i> افزودن
                                                                    زمانبندی</a>
                                                            </h4>
                                                            <div class="doc-times">
                                                                @foreach($data->where('week','Sunday') as $item)
                                                                    <div class="doc-slot-list">
                                                                        {{"$item->begin_time - $item->end_time"}}
                                                                        <a href="{{route('doctor.schedule_time.delete',['id'=>$item->id])}}"
                                                                           class="delete_schedule">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>


                                                        <div id="slot_monday" class="tab-pane fade ">
                                                            <h4 class="card-title d-flex justify-content-between">
                                                                <span>زمان بندی</span>
                                                                <a class="edit-link" data-bs-toggle="modal"
                                                                   href="#add_time_slot"><i
                                                                        class="fa fa-plus-circle"></i> افزودن
                                                                    زمانبندی</a>
                                                            </h4>

                                                            <div class="doc-times">
                                                                @foreach($data->where('week','Monday') as $item)
                                                                    <div class="doc-slot-list">
                                                                        {{"$item->begin_time - $item->end_time"}}
                                                                        <a href="{{route('doctor.schedule_time.delete',['id'=>$item->id])}}"
                                                                           class="delete_schedule">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </div>
                                                                @endforeach

                                                            </div>

                                                        </div>


                                                        <div id="slot_tuesday" class="tab-pane fade">
                                                            <h4 class="card-title d-flex justify-content-between">
                                                                <span>زمان بندی</span>
                                                                <a class="edit-link" data-bs-toggle="modal"
                                                                   href="#add_time_slot"><i
                                                                        class="fa fa-plus-circle"></i> افزودن
                                                                    زمانبندی</a>
                                                            </h4>
                                                            <div class="doc-times">
                                                                @foreach($data->where('week','Tuesday') as $item)
                                                                    <div class="doc-slot-list">
                                                                        {{"$item->begin_time - $item->end_time"}}
                                                                        <a href="{{route('doctor.schedule_time.delete',['id'=>$item->id])}}"
                                                                           class="delete_schedule">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>


                                                        <div id="slot_wednesday" class="tab-pane fade">
                                                            <h4 class="card-title d-flex justify-content-between">
                                                                <span>زمان بندی</span>
                                                                <a class="edit-link" data-bs-toggle="modal"
                                                                   href="#add_time_slot"><i
                                                                        class="fa fa-plus-circle"></i> افزودن
                                                                    زمانبندی</a>
                                                            </h4>
                                                            <div class="doc-times">
                                                                @foreach($data->where('week','Wednesday') as $item)
                                                                    <div class="doc-slot-list">
                                                                        {{"$item->begin_time - $item->end_time"}}
                                                                        <a href="{{route('doctor.schedule_time.delete',['id'=>$item->id])}}"
                                                                           class="delete_schedule">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>


                                                        <div id="slot_thursday" class="tab-pane fade">
                                                            <h4 class="card-title d-flex justify-content-between">
                                                                <span>زمان بندی</span>
                                                                <a class="edit-link" data-bs-toggle="modal"
                                                                   href="#add_time_slot"><i
                                                                        class="fa fa-plus-circle"></i> افزودن
                                                                    زمانبندی</a>
                                                            </h4>
                                                            <div class="doc-times">
                                                                @foreach($data->where('week','Thursday') as $item)
                                                                    <div class="doc-slot-list">
                                                                        {{"$item->begin_time - $item->end_time"}}
                                                                        <a href="{{route('doctor.schedule_time.delete',['id'=>$item->id])}}"
                                                                           class="delete_schedule">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>

                                                        <div id="slot_friday" class="tab-pane fade">
                                                            <h4 class="card-title d-flex justify-content-between">
                                                                <span>زمان بندی</span>
                                                                <a class="edit-link" data-bs-toggle="modal"
                                                                   href="#add_time_slot"><i
                                                                        class="fa fa-plus-circle"></i> افزودن
                                                                    زمانبندی</a>
                                                            </h4>
                                                            <div class="doc-times">
                                                                @foreach($data->where('week','Friday') as $item)
                                                                    <div class="doc-slot-list">
                                                                        {{"$item->begin_time - $item->end_time"}}
                                                                        <a href="{{route('doctor.schedule_time.delete',['id'=>$item->id])}}"
                                                                           class="delete_schedule">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>


                                                        <div id="slot_saturday" class="tab-pane fade show active">
                                                            <h4 class="card-title d-flex justify-content-between">
                                                                <span>زمان بندی</span>
                                                                <a class="edit-link" data-bs-toggle="modal"
                                                                   href="#add_time_slot"><i
                                                                        class="fa fa-plus-circle"></i> افزودن
                                                                    زمانبندی</a>
                                                            </h4>
                                                            <div class="doc-times">
                                                                @foreach($data->where('week','Saturday') as $item)
                                                                    <div class="doc-slot-list">
                                                                        {{"$item->begin_time - $item->end_time"}}
                                                                        <a href="{{route('doctor.schedule_time.delete',['id'=>$item->id])}}"
                                                                           class="delete_schedule">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </div>
                                                                @endforeach

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
            </div>
        </div>
    </div>

@stop


@section('js')
    <div class="modal fade custom-modal" id="add_time_slot">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">افزودن زمانبندی</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="{{route('doctor.schedule_time.post')}}" method="post">
                        @csrf
                        <input name="week" value="Saturday" id="week" hidden required>

                        <div class="hours-info">
                            <div class="row form-row hours-cont">
                                <div class="col-12 col-md-10">
                                    <div class="row form-row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>زمان شروع</label>
                                                <select name="begin_time" id="begin_time"
                                                        class="form-select form-control">
                                                    <option>5 صبح</option>
                                                    <option>6 صبح</option>
                                                    <option>7 صبح</option>
                                                    <option>8 صبح</option>
                                                    <option>9 صبح</option>
                                                    <option>10 صبح</option>
                                                    <option>11 صبح</option>
                                                    <option>12 صبح</option>


                                                    <option>13 عصر</option>
                                                    <option>14 عصر</option>
                                                    <option>15 عصر</option>
                                                    <option>16 عصر</option>
                                                    <option>17 عصر</option>
                                                    <option>18 عصر</option>
                                                    <option>19 عصر</option>
                                                    <option>20 عصر</option>
                                                    <option>21 عصر</option>
                                                    <option>22 عصر</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>زمان پایان</label>
                                                <select name="end_time" id="end_time" class="form-select form-control">
                                                    <option>13 عصر</option>
                                                    <option>14 عصر</option>
                                                    <option>15 عصر</option>
                                                    <option>16 عصر</option>
                                                    <option>17 عصر</option>
                                                    <option>18 عصر</option>
                                                    <option>19 عصر</option>
                                                    <option>20 عصر</option>
                                                    <option>21 عصر</option>
                                                    <option>22 عصر</option>

                                                    <option>5 صبح</option>
                                                    <option>6 صبح</option>
                                                    <option>7 صبح</option>
                                                    <option>8 صبح</option>
                                                    <option>9 صبح</option>
                                                    <option>10 صبح</option>
                                                    <option>11 صبح</option>
                                                    <option>12 صبح</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="submit-section text-center">
                            <button type="submit" class="btn btn-primary submit-btn">ذخیره تغییرات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



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
@stop
