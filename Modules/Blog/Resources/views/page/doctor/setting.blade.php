@extends('blog::layouts.master_index')


@section('title')
    تنظیمات
@stop

@section('css')

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">


    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">



    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">


@stop


@section('content')

    @include('blog::partials.doctor_breadcrumb',['title'=>'تنظیمات پروفایل'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                    @include('blog::partials.doctor_sidebar')

                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">

                    <form method="post" name="form" id="form" action="{{route('doctor.setting.post')}}"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">تنظیمات</h4>
                                <div class="row form-row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="change-avatar">
                                                @include('partials.single_upload_image',[
                                                                                                                                                  'title'=>'امضا/مهر',
                                                                                                                                                  'ratio'=>'2:2',
                                                                                                                                                  'size'=>'510,600',
                                                                                                                                                  'image'=>$data->media ? $data->media : null,
                                                                                                                                                  'name'=>'image',
                                                                                                                                                  ])
                                            </div>
                                        </div>
                                    </div>





                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>   مدت زمان بازدید هر بیمار <span class="text-danger">*</span></label>
                                            <input value="{{$data->reserve_time}}" type="number" class="form-control"
                                                   name="reserve_time">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-body">
                                <h4 class="card-title"> فاکتور </h4>
                                <div class="form-group mb-0">
                                    <label>متن دلخواه فاکتور بیمار</label>
                                    <textarea name="factor_description" id="factor_description" class="form-control"
                                              rows="5">{!! $data->factor_description !!}</textarea>
                                </div>
                            </div>


                        </div>
                        <div class="submit-section submit-btn-bottom">
                            <button type="submit" class="btn btn-primary submit-btn">ذخیره تغییرات</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

@stop


@section('js')

    <script type="text/javascript" src="{{asset('assets_blog/js/jquery-migrate-1.2.1.min.js')}}"></script>



    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\DoctorSettingValidation', '#form'); !!}


    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>



    <script src="{{asset('assets_blog/js/profile-settings.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/js/script.js')}}" type="1cce86bdda76a43346990492-text/javascript"></script>
    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="1cce86bdda76a43346990492-|49" defer=""></script>

    <script src="{{asset('assets/slim_cropper/js/require.js')}}"
            data-main="{{asset('assets/slim_cropper/js/main.min')}}"></script>


@stop
