@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">
    @include('partials.ck_editor_css')

@endsection
@section('title')
    تنظیمات صفحه اصلی
@endsection

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @include('partials.breadcrumb',['title'=>'تنظیمات صفحه اصلی'])
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
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">تنظیمات صفحه اصلی</span>
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
                                              action="{{route('SettingIndex.update',['SettingIndex'=>isset($data) ? $data->id : 0  ])}}"
                                              method="post" enctype="multipart/form-data">

                                            {{method_field('PUT')}}
                                            {{--                                            <input hidden name="_method" value="PUT">--}}
                                            @csrf


                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    {{--                                                    <div class="form-group">--}}
                                                    {{--                                                        <div class="controls">--}}
                                                    {{--                                                            <label>عنوان متن صفحه اول</label>--}}
                                                    {{--                                                            <input type="text" class="form-control"--}}
                                                    {{--                                                                   placeholder="عنوان متن صفحه اول"--}}
                                                    {{--                                                                   name="site_title"--}}
                                                    {{--                                                                   value="{{isset($data) ? $data->site_title : ''}}"--}}
                                                    {{--                                                                   id="site_title">--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}
                                                    {{--                                                    <div class="form-group">--}}
                                                    {{--                                                        <div class="controls">--}}
                                                    {{--                                                            <label>توضیحات متن صفحه اول</label>--}}
                                                    {{--                                                            <input type="text" class="form-control"--}}
                                                    {{--                                                                   placeholder="توضیحات متن صفحه اول"--}}
                                                    {{--                                                                   name="site_description"--}}
                                                    {{--                                                                   value="{{isset($data) ? $data->site_description : ''}}"--}}
                                                    {{--                                                                   id="site_description">--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}


                                                </div>


                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>درباره ما</label>
                                                            <textarea name="about_us" id="about_us">
                                                                {{isset($data) ? $data->about_us : ''}}
                                                            </textarea>

                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="col-12 col-sm-6">


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>عنوان صفحه </label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="متن مورد نظر را وارد کنید"
                                                                   name="site_title"
                                                                   value="{{isset($data) ? $data->site_title : ''}}"
                                                                   id="site_title">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>توضیحات زیر عنوان</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="متن مورد نظر را وارد کنید"
                                                                   name="site_description"
                                                                   value="{{isset($data) ? $data->site_description : ''}}"
                                                                   id="site_description">
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

        CKEDITOR.replace('about_us');

    </script>
@endsection


