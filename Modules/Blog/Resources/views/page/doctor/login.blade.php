@extends('blog::layouts.master_index')


@section('title')
    فرم ورود متخ
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">


    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

@stop


@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src="{{asset('assets_blog/img/login-banner.png')}}" class="img-fluid"
                                     alt="Login Banner">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <h3>فرم ورود پزشکان</h3>
                                </div>

                                <form action="{{route('doctor.login.post')}}" method="post" name="form" id="form">

                                    @csrf

                                    <div class="form-group form-focus">
                                        <input name="mobile" id="mobile" maxlength="12" minlength="11" type="text"
                                               class="form-control floating">
                                        <label class="focus-label">شماره موبایل </label>
                                    </div>
                                    <div class="form-group form-focus">
                                        <input name="password" id="password" type="password"
                                               class="form-control floating">
                                        <label class="focus-label">رمزعبور</label>
                                    </div>


                                    <div class="text-end">
                                        <a class="forgot-link" href="{{route('doctor.register')}}">حساب کاربری ندارید ؟
                                            از
                                            اینجا وارد
                                            شوید</a>
                                    </div>
                                    <button class="btn btn-primary w-100 btn-lg login-btn" type="submit">ورود
                                    </button>
                                </form>

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
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\DoctorLoginValidation', '#form'); !!}


    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/slick.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/aos.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/script.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>

@stop
