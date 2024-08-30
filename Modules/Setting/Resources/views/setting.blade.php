@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">
    @include('partials.ck_editor_css')

@endsection
@section('title')
    تنظیمات اصلی
@endsection

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @include('partials.breadcrumb',['title'=>'تنظیمات اصلی'])
            <div class="content-body">
                <!-- users edit start -->
                <section class="users-edit">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="account-tab"
                                           data-toggle="tab" href="#account" aria-controls="account" role="tab"
                                           aria-selected="true">
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">تنظیمات اصلی</span>
                                        </a>
                                    </li>

                                </ul>


                                <div class="tab-content">

                                    <div class="tab-pane active" id="account" aria-labelledby="account-tab"
                                         role="tabpanel">
                                        <!-- users edit media object start -->


                                        <!-- users edit media object ends -->
                                        <!-- users edit account form start -->
                                        <form id="form" name="form"
                                              action="{{route('Setting.update',['Setting'=>isset($data) ? $data->id : 0  ])}}"
                                              method="post" enctype="multipart/form-data">

                                            {{method_field('PUT')}}
                                            {{--                                            <input hidden name="_method" value="PUT">--}}
                                            @csrf
                                            @include('partials.single_upload_image',[
                                                                                                                                                                                                                      'title'=>'لوگوی سایت',
                                                                                                                                                                                                                      'ratio'=>'8:2',
                                                                                                                                                                                                                      'size'=>'400,100',
                                                                                                                                                                                                                      'image'=>isset($data->logo) ? $data->logo : null,
                                                                                                                                                                                                                      'name'=>'image',
                                                                                                                                                                                                                      ])


                                            <div class="row">
                                                <div class="col-12 col-sm-6">


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>نام سایت</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="نام سایت را وارد کنید"
                                                                   name="site_name"
                                                                   value="{{isset($data) ? $data->site_name : ''}}"
                                                                   id="site_name">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>درصد دریافتی کارمزد از متخصصین</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="درصد خود را وارد نمایید "
                                                                   name="percent_financial"
                                                                   value="{{isset($data) ? $data->percent_financial : ''}}"
                                                                   id="percent_financial">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>آدرس</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="آدرس  را وارد کنید"
                                                                   name="address"
                                                                   value="{{isset($data) ? $data->address : ''}}"
                                                                   id="address">
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>ایمیل</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="ایمیل  را وارد کنید"
                                                                   name="email"
                                                                   value="{{isset($data) ? $data->email : ''}}"
                                                                   id="email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>پروفایل لینکدین</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="#"
                                                                   name="linkedin_link"
                                                                   value="{{isset($data) ? $data->linkedin_link : ''}}"
                                                                   id="linkedin_link">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>لینک اینستاگرام</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="لینک اینستاگرام  را وارد کنید"
                                                                   name="insta_link"
                                                                   value="{{isset($data) ? $data->insta_link : ''}}"
                                                                   id="insta_link">
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>متن فوتر (پایین صفحه)</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder=" "
                                                                   name="footer_text"
                                                                   value="{{isset($data) ? $data->footer_text : ''}}"
                                                                   id="footer_text">
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>تلفن</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="تلفن"
                                                                   name="phone"
                                                                   value="{{isset($data) ? $data->phone : ''}}"
                                                                   id="phone">
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>لینک تلگرام</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="لینک تلگرام  را وارد کنید"
                                                                   name="telegram_link"
                                                                   value="{{isset($data) ? $data->telegram_link : ''}}"
                                                                   id="telegram_link">
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>رنگ سایت</label>
                                                            <input type="color" class="form-control"
                                                                   placeholder="رنگ سایت"
                                                                   name="site_color"
                                                                   value="{{isset($data) ? $data->site_color : ''}}"
                                                                   id="site_color">
                                                        </div>
                                                    </div>


                                                    {{--                                                    <div class="form-group">--}}
                                                    {{--                                                        <div class="controls">--}}
                                                    {{--                                                            <label>پس زمینه سایت</label>--}}
                                                    {{--                                                            <input type="color" class="form-control"--}}
                                                    {{--                                                                   placeholder="رنگ مورد نظر را انتخاب کنید"--}}
                                                    {{--                                                                   name="site_color"--}}
                                                    {{--                                                                   value="{{isset($data) ? $data->site_color : ''}}"--}}
                                                    {{--                                                                   id="site_color">--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                                <div class="col-12 col-sm-12">


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>حریم خصوصی</label>
                                                            <textarea name="privacy" id="privacy">
                                                                {{isset($data) ? $data->privacy : ''}}
                                                            </textarea>

                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="col-12 col-sm-12">


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>شرایط و ضوابط</label>
                                                            <textarea name="policy" id="policy">

                                                                {{isset($data) ? $data->policy : ''}}
                                                            </textarea>

                                                        </div>
                                                    </div>


                                                </div>


                                                <div
                                                    class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit"
                                                            class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                                                        ذخیره
                                                    </button>

                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit account form ends -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\Setting\Http\Requests\CreateContactUsValidation', '#form'); !!}

    <script src="{{asset('assets/slim_cropper/js/require.js')}}"
            data-main="{{asset('assets/slim_cropper/js/main.min')}}"></script>
    @include('partials.ck_editor_js')

    <script>

        CKEDITOR.replace('policy');
        CKEDITOR.replace('privacy');


    </script>
@endsection


