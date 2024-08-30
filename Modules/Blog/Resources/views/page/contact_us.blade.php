@extends('blog::layouts.master_index')


@section('title')
تماس با ما
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/feather.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">


@stop


@section('content')

    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">خانه</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> دیگر صفحات

                            </li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">تماس با ما</h2>
                </div>
            </div>
        </div>
    </div>

    <section class="contact-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h3 class="mb-4">‌تماس با ما</h3>
                    <p>{{$data->contact_us_title}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 d-flex">
                    <div class="contact-box flex-fill">
                        <div class="infor-img">
                            <div class="image-circle">
                                <i class="feather-phone"></i>
                            </div>
                        </div>
                        <div class="infor-details text-center">
                            <label>شماره تماس</label>
                            <p>{{$data->phone}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="contact-box flex-fill">
                        <div class="infor-img">
                            <div class="image-circle bg-primary">
                                <i class="feather-mail"></i>
                            </div>
                        </div>
                        <div class="infor-details text-center">
                            <label>ایمیل</label>
                            <p><a href="mailto:{{$data->email}}" class="__cf_email__"
                                >{{$data->email}}</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="contact-box flex-fill">
                        <div class="infor-img">
                            <div class="image-circle">
                                <i class="feather-map-pin"></i>
                            </div>
                        </div>
                        <div class="infor-details text-center">
                            <label>آدرس</label>
                            <p>{{$data->address}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-form">
        <div class="container">
            <div class="section-header text-center">
                <h2>{{$data->contact_us}}</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form method="post" id="form" action="{{route('contact_us.post')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>نام و نام خانوادگی <span>*</span></label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> ایمیل<span>*</span></label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>شماره تماس</label>
                                    <input type="number" name="mobile" id="mobile" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>متن پیام شما <span>*</span></label>
                                    <textarea name="message" id="message" class="form-control">
</textarea>
                                </div>
                            </div>
                        </div>
                        <input type="submit" value="ارسال پیام" class="btn bg-primary"/>
                    </form>
                </div>
            </div>
        </div>
    </section>



@stop


@section('js')
    <script type="text/javascript" src="{{asset('assets_blog/js/jquery-migrate-1.2.1.min.js')}}"></script>



    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\ContactUsValidation', '#form'); !!}



    <script data-cfasync="false"
            src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>


    <script src="{{asset('assets_blog/js/script.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>
    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="b97d855d680359945684ceb5-|49" defer=""></script></body>
    <script>


    </script>
@stop
