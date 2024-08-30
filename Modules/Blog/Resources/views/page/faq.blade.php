@extends('blog::layouts.master_index')


@section('title')
سوالات متداول
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/feather.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

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
                    <h2 class="breadcrumb-title">سوالات متداول</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="terms-content">
                        <div class="terms-text">
                            <div id="accordion">

                                @isset($data)


                                    @foreach($data as $key=>$item)
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link" data-toggle="collapse" href="#collapse{{$key}}">
                                                    {{$item->question}}
                                                </a>
                                            </div>
                                            <div id="collapse{{$key}}" class="collapse {{$key==0 ? 'show' : ''}}"
                                                 data-parent="#accordion">
                                                <div class="card-body">
                                                    {!! $item->answer !!}

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endisset


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
