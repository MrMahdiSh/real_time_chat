@extends('blog::layouts.master_index')


@section('title')

@stop

@section('css')
    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/fstdropdown/fstdropdown.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

    <style>

        .list-group {
            background-color: white;
            display: none;
            list-style-type: none;
            margin: 0 0 0 10px;
            padding: 0;
            position: absolute;
            width: 100%;
        }

        .fstdropdown {

            min-height: 46px !important;
        }

        .list-group > li {
            border-color: gray;
            border-image: none;
            border-style: solid solid none;
            border-width: 1px 1px 0;
            padding-left: 5px;
        }

        .list-group > li:last-child {
            border-bottom: 1px solid gray;
        }

        .form-control:focus + .list-group {
            display: block;
        }

    </style>

@stop


@section('content')

    @if(count($teams)>0)
        <section class="section home-tile-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9 m-auto">
                        <div class="section-header text-center aos">
                            <h2>تیم ما</h2>
                        </div>
                        <div class="row">
                            @foreach($teams as $item)
                                <div class="col-lg-4 mb-3 aos">
                                    <div class="card text-center doctor-book-card">
                                        <img
                                            src="{{$item->media ? $item->media->url : asset('assets_blog/img/no_image.png')}}"
                                            alt=""
                                            class="img-fluid">
                                        <div class="doctor-book-card-content tile-card-content-1">
                                            <div>
                                                <h3 class="card-title mb-0">{{$item->name}}</h3>

                                                @if(!empty($item->insta_link))
                                                    <a

                                                        class="btn book-btn1 px-3 py-2 mt-3 btn-one-light"
                                                        tabindex="0">{{$item->degree}}</a>

                                                    <a target="_blank"
                                                       href="{{!empty($item->insta_link) ? $item->insta_link : '#'}}"
                                                       class="btn book-btn1 px-3 py-2 mt-3 btn-one-light"
                                                       tabindex="0">ارتباط</a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@stop


@section('js')
    <script type="text/javascript" src="{{asset('assets_blog/js/jquery-migrate-1.2.1.min.js')}}"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>



    <script src="{{asset('assets_blog/js/script.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>
    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="b97d855d680359945684ceb5-|49" defer=""></script>





@stop
