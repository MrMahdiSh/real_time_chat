<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8">
    <title>@yield('title')|{{ $setting->site_name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <link href="{{ $setting->logo ? $setting->logo->url : '' }}" rel="icon">

    <style>
        :root {
            --main_color: {{ $setting->site_color }} !important;
        }
    </style>
    <style>
        #ad-image {
            width: 100%;
            height: 300px;
            object-fit: fill;
            /* تصویر به اندازه صفحه نمایش کامل می‌شود */
        }
    </style>
    @yield('css')


</head>

<body>


    <div class="main-wrapper">
        @php
            $ads_page = \Modules\Advertise\Entities\AdvertisePage::where('route_name', Request::route()->getName())
                ->with('media')
                ->get();
        @endphp

        @if (count($ads_page) > 0)
            @foreach ($ads_page as $ad)
                @if ($ad->type == \Modules\Advertise\Entities\BannerType::Text)
                    <p class="alert alert-info text-center"><a
                            @if (!empty($ad->link)) href="{{ $ad->link }}" @endif>{{ \App\Helper\Core::subStrStripTagCustomLenth($ad->description) }}</a>
                    </p>
                @else
                    <img src="{{ $ad->media ? $ad->media->url : '' }}" alt="{{ $ad->title }}" id="ad-image">
                @endif
            @endforeach

        @endif


        @if (Session::has('success'))
            <p class="alert alert-success text-center">
                {{ Session::get('success', ' عملیات با موفقیت انجام گردید ') == 'success' ? ' عملیات با موفقیت انجام گردید ' : Session::get('success', ' عملیات با موفقیت انجام گردید ') }}
            </p>
        @elseif(Session::has('error'))
            <p class="alert alert-danger text-center">
                {{ Session::get('error', 'خطا در انجام عملیات') == 'error' ? 'خطا در انجام عملیات' : Session::get('error', 'خطا در انجام عملیات') }}
            </p>
        @endif

        @include('blog::partials.header_master')

        @if (session('backToAdminSession'))
            <div class="col-md-12 text-center mt-4 mb-4">
                <a style="background: white;
                            padding: 0.65rem !important;
                            min-width:170px;
                            border: 3px solid #b02727;
                            color: #000000ad;
                            font-weight: 400;
                            font-size: 13px;"
                    class="btn" href="{{ route('backToAdminSession') }}">
                    برگشت به پنل ادمین
                    <i class="fa fa-user"> </i>
                </a>
            </div>
        @endif

        @yield('content')
        @include('blog::partials.footer_master')

    </div>
</body>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<script type="text/javascript" src="{{ asset('assets_blog/js/jquery-1.11.0.min.js') }}?ver=1"></script>

@yield('js')
<script>
    // Mobile menu sidebar overlay

    $('body').append('<div class="sidebar-overlay"></div>');
    $(document).on('click', '#mobile_btn', function() {
        $('main-wrapper').toggleClass('slide-nav');
        $('.sidebar-overlay').toggleClass('opened');
        $('html').addClass('menu-opened');
        return false;
    });

    $(document).on('click', '.sidebar-overlay', function() {
        $('html').removeClass('menu-opened');
        $(this).removeClass('opened');
        $('main-wrapper').removeClass('slide-nav');
    });

    $(document).on('click', '#menu_close', function() {
        $('html').removeClass('menu-opened');
        $('.sidebar-overlay').removeClass('opened');
        $('main-wrapper').removeClass('slide-nav');
    });


    if ($(window).width() <= 991) {
        var Sidemenu = function() {
            this.$menuItem = $('.main-nav a');
        };

        function init() {
            var $this = Sidemenu;
            $('.main-nav a').on('click', function(e) {
                if ($(this).parent().hasClass('has-submenu')) {
                    e.preventDefault();
                }
                if (!$(this).hasClass('submenu')) {
                    $('ul', $(this).parents('ul:first')).slideUp(350);
                    $('a', $(this).parents('ul:first')).removeClass('submenu');
                    $(this).next('ul').slideDown(350);
                    $(this).addClass('submenu');
                } else if ($(this).hasClass('submenu')) {
                    $(this).removeClass('submenu');
                    $(this).next('ul').slideUp(350);
                }
            });
        }

        // Sidebar Initiate
        init();








        // document.addEventListener("DOMContentLoaded", function () {
        //     var lazyImages = document.querySelectorAll(".lazyload");

        //     var lazyLoadOptions = {
        //         rootMargin: "0px 0px 200px 0px", // Adjust this value to control when images load
        //         threshold: 0.1, // Adjust this value to control how much of the element needs to be visible
        //     };

        //     var lazyLoadCallback = function (entries, observer) {
        //         entries.forEach(function (entry) {
        //             if (entry.isIntersecting) {
        //                 var lazyImage = entry.target;
        //                 lazyImage.src = lazyImage.getAttribute("data-src");
        //                 lazyImage.classList.remove("lazyload");
        //                 observer.unobserve(lazyImage);
        //             }
        //         });
        //     };

        //     var imageObserver = new IntersectionObserver(lazyLoadCallback, lazyLoadOptions);

        //     lazyImages.forEach(function (lazyImage) {
        //         imageObserver.observe(lazyImage);
        //     });
        // });
    }
    $(document).ready(function() {
        $('.navbar-toggler').click(function() {
            $('.navbar-collapse').toggleClass('show');
        });
    });
</script>

</html>
