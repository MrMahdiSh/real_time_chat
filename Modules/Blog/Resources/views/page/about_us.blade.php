@extends('blog::layouts.master_index')

@section('title')
درباره ما
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
                    <h2 class="breadcrumb-title">درباره ما</h2>
                </div>
            </div>
        </div>
    </div>
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <a href="javascript:void(0);" class="about-titile mb-4">در مورد ما بیشتر بدانید</a>
                    {!! $data->about_us !!}
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script type="text/javascript" src="{{asset('assets_blog/js/jquery-migrate-1.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\\Blog\\Http\\Requests\\ContactUsValidation', '#form'); !!}
    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>
    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>
    <script src="{{asset('assets_blog/js/script.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>
    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="b97d855d680359945684ceb5-|49" defer=""></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector('.menu-toggle').addEventListener('click', function() {
                document.querySelector('.navbar-menu').classList.toggle('active');
            });
        });
    </script>
@stop
