@extends('blog::layouts.master_index')


@section('title')
    جست و جو پزشک/دکتر
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('assets_blog/css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_blog/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets_blog/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets_blog/plugins/fancybox/jquery.fancybox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets_blog/css/style.css') }}">

    <style>
        @media (max-width: 479px) {
            .clinic-booking {
                min-width: 300px;
                display: flex;
                justify-content: space-between;
                /* background: indianred !important; */
            }
        }

        @media only screen and (max-width: 479px) {
            .clinic-booking a.view-pro-btn {
                width: 45%;
                margin-bottom: 0 !important; // کامنت بشه
            }
        }

        @media only screen and (max-width: 479px) {
            .clinic-booking a.apt-btn {
                width: 43%;
                margin-top: 0 !important; // کامنت بشه
            }
        }
    </style>

    <div class="">






    @stop


    @section('content')

        <div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">خانه</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> صفحات

                                </li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title"> جست و جو پزشک/دکتر</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">

                        <form id="form" name="form" method="get" action="{{ route('doctor.search') }}">

                            <div class="card search-filter">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">فیلتر جستجو</h4>
                                </div>
                                <div class="card-body">
                                    <div class="filter-widget">
                                        <div class="">
                                            <input hidden name="city" id="city" value="{{ request('city') }}">

                                            <input type="text"
                                                value=" @if (request('type') != 'reset') {{ request('search', '') }} @endif"
                                                name="search" id="search" class="form-control "
                                                placeholder="جست و جو بر اساس تخصص ، نام دکتر ، خدمات ">
                                        </div>
                                    </div>
                                    <div class="filter-widget">
                                        <h4>جنسیت</h4>

                                        <div>
                                            <label class="custom_check">
                                                <input {{ request('gender') == '' ? 'checked' : '' }} id="all_gender"
                                                    type="radio" value="" name="gender">
                                                <span class="checkmark"></span> همه
                                            </label>
                                        </div>

                                        <div>
                                            <label class="custom_check">
                                                <input
                                                    @if (request('type') != 'reset') {{ request('gender') == 'male' ? 'checked' : '' }} @endif
                                                    id="gender" type="radio" name="gender" value="male">
                                                <span class="checkmark"></span> پزشک مرد
                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check">
                                                <input
                                                    @if (request('type') != 'reset') {{ request('gender') == 'female' ? 'checked' : '' }} @endif
                                                    id="gender" type="radio" value="female" name="gender">
                                                <span class="checkmark"></span> پزشک زن
                                            </label>
                                        </div>
                                    </div>

                                    @if (isset($categories))

                                        <div class="filter-widget">
                                            <h4> متخصص را انتخاب کنید </h4>
                                            <div>
                                                <label class="custom_check">

                                                    <input id="all_category_id" value=""
                                                        {{ request('category_id') == '' ? 'checked' : '' }} type="radio"
                                                        name="category_id">
                                                    <span class="checkmark"></span>همه

                                                </label>
                                            </div>
                                            @foreach ($categories as $item)
                                                <div>
                                                    <label class="custom_check">


                                                        <input value="{{ $item->id }}"
                                                            @if (request('type') != 'reset') {{ request('category_id') == $item->id ? 'checked' : '' }} @endif
                                                            type="radio" name="category_id">
                                                        <span class="checkmark"></span> {{ $item->title }}
                                                    </label>
                                                </div>
                                            @endforeach


                                        </div>


                                    @endisset

                                    <input name="type" id="type_btn" hidden>

                                    <div class="btn-search">
                                        <input type="submit" value="جستجو" class="btn w-100" />
                                        <hr>
                                        <input type="submit"
                                            onclick="document.getElementById('type_btn').value ='reset'"
                                            value="پاکسازی فرم" class="btn w-100" />
                                    </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-md-12 col-lg-8 col-xl-9">

                    @if (count($doctors) > 0)
                        @foreach ($doctors as $item)
                            @component('blog::componets.doctor_search_item', ['item' => $item])
                            @endcomponent
                        @endforeach
                    @else
                        <p class="alert alert-danger">
                            @if (request('type') == 'reset') برای جست و جو مجدد ،
                                فیلتر را
                                اعمال کنید @elseنتیجه ای یافت نشد ! @endif
                        </p>


                    @endif
                    {{--                    <div class="load-more text-center"> --}}
                    {{--                        <a class="btn btn-primary btn-sm" href="javascript:void(0);">بارگذاری بیشتر</a> --}}
                    {{--                    </div> --}}
                </div>
            </div>

        </div>
    </div>


@stop


@section('js')
    <script type="text/javascript" src="{{ asset('assets_blog/js/jquery-migrate-1.2.1.min.js') }}"></script>




    <script data-cfasync="false"
            src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>


    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="4301580c5e2c07898d598503-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="4301580c5e2c07898d598503-text/javascript"></script>

    <script src="{{asset('assets_blog/plugins/select2/js/select2.min.js')}}"
            type="4301580c5e2c07898d598503-text/javascript"></script>
    <script src="{{asset('assets_blog/js/moment.min.js')}}" type="4301580c5e2c07898d598503-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/fancybox/jquery.fancybox.min.js')}}"
            type="4301580c5e2c07898d598503-text/javascript"></script>

    <script src="{{asset('assets_blog/js/script.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>
    <script src="{{ asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js') }}"
        data-cf-settings="b97d855d680359945684ceb5-|49" defer=""></script>





@stop
