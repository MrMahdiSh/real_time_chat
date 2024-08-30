@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">
    @include('partials.ck_editor_css')

@endsection
@section('title')
    ثبت نفر
@endsection

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @include('partials.breadcrumb',['title'=>'ثبت نفر'])
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
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">ثبت نفر</span>
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
                                              action="{{route('Team.store')}}"
                                              method="post" enctype="multiTeam/form-data">


                                            {{--                                            <input hidden name="_method" value="PUT">--}}
                                            @csrf
                                            @include('partials.single_upload_image',[
                                                                                                                                     'title'=>null,
                                                                                                                                     'ratio'=>'2:2',
                                                                                                                                     'size'=>'510,600',
                                                                                                                                     'image'=>null,
                                                                                                                                     'name'=>'image',
                                                                                                                                     ])

                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>نام مورد نظر</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="نام مورد نظر  را وارد کنید"
                                                                   name="name"
                                                                   id="name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>سمت</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder=" سمت مورد را وارد کنید"
                                                                   name="degree"
                                                                   id="degree">
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>لینک اینستاگرام</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="لینک اینستاگرام"
                                                                   name="insta_link"

                                                                   id="insta_link">
                                                        </div>
                                                    </div>
{{--                                                    <div class="form-group">--}}
{{--                                                        <div class="controls">--}}
{{--                                                            <label>لینک تلگرام</label>--}}
{{--                                                            <input type="text" class="form-control"--}}
{{--                                                                   placeholder="لینک تلگرام"--}}
{{--                                                                   name="telegram_link"--}}

{{--                                                                   id="telegram_link">--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}


                                                </div>


                                                <div class="col-12 col-sm-12">


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>توضیحات</label>
                                                            <textarea name="description" id="editor"></textarea>

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
    {!! JsValidator::formRequest('Modules\Team\Http\Requests\CreateTeamValidation', '#form'); !!}

    <script src="{{asset('assets/slim_cropper/js/require.js')}}"
            data-main="{{asset('assets/slim_cropper/js/main.min')}}"></script>
    @include('partials.ck_editor_js')

    <script>

        CKEDITOR.replace('fa_description');

    </script>
@endsection


