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
                                              action="{{route('Insta.update',['Instum'=>'1'])}}"
                                              method="post" enctype="multipart/form-data">


                                            <input hidden name="_method" value="PUT">
                                            @csrf


                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    @isset($login_url)
                                                        <div class="form-group">
                                                            <a target="_blank"
                                                               href="{{isset($login_url) ? $login_url : '#'}}"
                                                               class="btn btn-success">Login To Instagram/ ورود به
                                                                اینستاگرام</a>
                                                        </div>
                                                    @endisset
                                                    <div class="form-group">
                                                        <a target="_blank"
                                                           href="{{route('set_auth_token',['auth_token'=>'auth_token'])}}"
                                                           class="btn btn-success">Set Auth Token _1</a>
                                                    </div>


                                                </div>
                                                @if (isset($result))
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <strong>نوع اکانت :</strong>
                                                                <p>{{$result->account_type}}
                                                                </p>
                                                            </div>


                                                            <div class="row">
                                                                <strong>آیدی :</strong>
                                                                <p>{{$result->id}}
                                                                </p>
                                                            </div>


                                                            <div class="row">
                                                                <strong>تعداد مدیا :</strong>
                                                                <p>{{$result->media_count}}
                                                                </p>
                                                            </div>


                                                            <div class="row">
                                                                <strong> آیدی کاربر :</strong>
                                                                <p>{{$result->username}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endif
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
    {!! JsValidator::formRequest('Modules\Setting\Http\Requests\CreateInstaValidation', '#form'); !!}

    <script src="{{asset('assets/slim_cropper/js/require.js')}}"
            data-main="{{asset('assets/slim_cropper/js/main.min')}}"></script>
    @include('partials.ck_editor_js')
    <script>

        CKEDITOR.replace('fa_description');

    </script>
@endsection


