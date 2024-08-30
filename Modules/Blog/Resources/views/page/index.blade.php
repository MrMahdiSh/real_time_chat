@extends('blog::layouts.master_index')


@section('title')

@stop

@section('css')
    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/fstdropdown/fstdropdown.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

    <style>
        body {
            font-family: 'Noto Sans', sans-serif; /* Replace with the desired font name */
        }

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


    @if(count($doctors)>0)
        <section class="section section-doctor" id="section_doctor">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="section-header aos">
                            <h2>رزرو نوبت پزشک</h2>
                            <p>به سادگی نوبت خود را رزرو کنید</p>
                        </div>
                        <div class="about-content aos">
                            <p>در این سایت شما قادر به جست و جو پزشک مورد نظر بر اساس شهر و استان خود هستید و
                                براساس
                                نیازمندی خود قابلیت رزرو نوبت برای دکتر مورد نظر خود را دارا می باشید</p>

                            <a href="{{route('doctor.search')}}">جست و جو دیگر پزشکان</a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="doctor-slider slider aos">

                            @foreach($doctors as $item)

                                @component('blog::componets.doctor_item',['item'=>$item])

                                @endcomponent
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </section>

    @endif



    @if(count($articles)>0)

        <section class="section section-blogs">
            <div class="container-fluid">

                <div class="section-header text-center aos">
                    <h2>اخبار و مقالات </h2>
                    <p class="sub-title"></p>
                </div>

                <div class="row blog-grid-row aos">
                    @foreach($articles as $item)
                        @component('blog::componets.blog_item',['item'=>$item])

                        @endcomponent
                    @endforeach


                </div>
                <div class="view-all text-center aos">
                    <a href="{{route('blogs')}}" class="btn btn-primary">مشاهده همه</a>
                </div>
            </div>
        </section>

    @endif






@stop


@section('js')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('assets_blog/js/jquery-migrate-1.2.1.min.js')}}"></script>


    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
    ></script>


    <script src="{{asset('assets_blog/fstdropdown/fstdropdown.js')}}"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
    ></script>

    <script src="{{asset('assets_blog/js/slick.js')}}"
    ></script>


    <script src="{{asset('assets_blog/js/script.js')}}"
    ></script>

    <link rel="stylesheet" href="{{asset('assets_blog/css/swiper-bundle.min.css')}}">
    <script src="{{asset('assets_blog/css/swiper-bundle.min.js')}}"></script>


    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}"
    ></script>


    <script>

        spaceBetween = 30;
        slidesPerView = 5;
            @isset($categoryService)
            @foreach($categoryService as $key=>$item)
        const swiper{{$key}} = new Swiper('.swiper-container{{$key}}', {
                slidesPerView: slidesPerView,
                spaceBetween: spaceBetween,
                loop: true,
                navigation: {
                    nextEl: '',
                    prevEl: '',
                },
            });
            @endforeach
            @endisset



        const swiper_container_category = new Swiper('.swiper-container-category', {
                slidesPerView: slidesPerView,
                spaceBetween: spaceBetween,
                loop: true,
                navigation: {
                    nextEl: '',
                    prevEl: '',
                },
            });


        var width = $(window).width()
        if (width <= 991) {
            const swiper_container_service = new Swiper('.swiper-container-service', {
                slidesPerView: 1,
                spaceBetween: spaceBetween,
                loop: true,
                navigation: {
                    nextEl: '',
                    prevEl: '',
                },
            });


        } else {

            const swiper_container_service = new Swiper('.swiper-container-service', {
                slidesPerView: 5,
                spaceBetween: spaceBetween,
                loop: true,
                navigation: {
                    nextEl: '',
                    prevEl: '',
                },
            });

        }


    </script>

@stop
