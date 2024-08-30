@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">
    @include('partials.ck_editor_css')

@endsection
@section('title')
    تنظیمات کلید
@endsection

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @include('partials.breadcrumb',['title'=>'تنظیمات کلید'])
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
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">تنظیمات کلید</span>
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
                                              action="{{route('InstaKey.update',['InstaKey'=>$data->id])}}"
                                              method="post" enctype="multipart/form-data">


                                            <input hidden name="_method" value="PUT">
                                            @csrf


                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>app_id</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="insert your app id"
                                                                   value="{{$data->app_id}}"
                                                                   name="app_id"

                                                                   id="app_id">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>app_secret</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="insert your app secret"
                                                                   value="{{$data->app_secret}}"
                                                                   name="app_secret"

                                                                   id="app_secret">
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>redirect_url</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="insert your redirect url"
                                                                   value="{{$data->redirect_url}}"
                                                                   name="redirect_url"

                                                                   id="redirect_url">
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
    {!! JsValidator::formRequest('Modules\Setting\Http\Requests\CreateInstaKeyValidation', '#form'); !!}

    <script src="{{asset('assets/slim_cropper/js/require.js')}}"
            data-main="{{asset('assets/slim_cropper/js/main.min')}}"></script>
    @include('partials.ck_editor_js')
    <script>

        CKEDITOR.replace('fa_description');

    </script>
@endsection


