@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">
    @include('partials.ck_editor_css')

@endsection
@section('title')
    ثبت تبلیغات صفحه
@endsection

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @include('partials.breadcrumb',['title'=>'ثبت تبلیغات صفحه'])
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
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">ثبت تبلیغات صفحه</span>
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
                                              action="{{route('AdvertisePage.store')}}"
                                              method="post" enctype="multipart/form-data">


                                            {{--                                            <input hidden name="_method" value="PUT">--}}
                                            @csrf

                                            @include('partials.single_upload_image',[
                                                                                                                                                                                                                             'title'=>'آپلود تصویر',
                                                                                                                                                                                                                             'ratio'=>'3:1',
                                                                                                                                                                                                                             'size'=>'1024,768',
                                                                                                                                                                                                                             'image'=>null,
                                                                                                                                                                                                                             'name'=>'image',
                                                                                                                                                                                                                             ])
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>عنوان</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="  عنوان  را وارد کنید"
                                                                   name="title"
                                                                   id="title">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>لینک</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="  لینک  را وارد کنید"
                                                                   name="link"
                                                                   id="link">
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>نوع</label>
                                                        <select class="form-control" name="type" id="type"
                                                        >
                                                            <option
                                                                value="{{\Modules\Advertise\Entities\BannerType::Text}}">
                                                                متنی
                                                            </option>
                                                            <option
                                                                value="{{\Modules\Advertise\Entities\BannerType::Media}}">
                                                                تصویری
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <p class=" alert alert-info">آدرس را به صورت : doctor.login
                                                                وارد نمایید</p>

                                                            <p class=" alert alert-warning">طبق توضیحات ارسالی در صورت
                                                                وجود / در آدرس از . استفاده نمایید</p>

                                                            <label> آدرس صفحه</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="  آدرس صفحه  را وارد کنید"
                                                                   name="route_name"
                                                                   id="route_name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <p class=" alert alert-info">در صورت ایجاد تبلیغات متنی
                                                                توضیحات قابل نمایش خواهد بود</p>
                                                            <label>توضیحات</label>
                                                            <textarea name="description"
                                                                      id="editor"></textarea>
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
    {!! JsValidator::formRequest('Modules\Advertise\Http\Requests\AdvertisePageValidation', '#form'); !!}

    <script src="{{asset('assets/slim_cropper/js/require.js')}}"
            data-main="{{asset('assets/slim_cropper/js/main.min')}}"></script>
    @include('partials.ck_editor_js')

    <script>

        CKEDITOR.replace('fa_description');

    </script>
@endsection


