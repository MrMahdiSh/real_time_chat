@extends('blog::layouts.master_index')


@section('title')
    خدمات
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/aos.css')}}">

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
                            <li class="breadcrumb-item active" aria-current="page">خدمات</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">‌لیست خدمات</h2>
                </div>
            </div>
        </div>
    </div>



    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-3 col-xl-3 theiaStickySidebar">

                    <form action="{{route('services')}}" method="get" id="form" name="form">

                        <div class="card search-filter">
                            <div class="card-header">
                                <h4 class="card-title mb-0">فیلتر</h4>
                            </div>
                            @csrf
                            <div class="input-group">
                                <input type="text" name="text" id="text" value="{{request('text',null)}}"
                                       placeholder="جست و جو بر اساس دکتر ، خدمت ..."
                                       class="form-control">
                            </div>
                            @isset($categories)
                                <div class="card-body">
                                    <div class="filter-widget">
                                        @foreach($categories as $val)
                                            <h4>{{$val ? $val->title : ''}}</h4>
                                            @if($val->child)
                                                @foreach($val->child as $item)
                                                    <div style="text-align: right;">
                                                        <label class="custom_check">
                                                            <img loading="lazy"
                                                                 src="{{ isset($item->media) ? $item->media->url : asset('assets_blog/img/no_image.png') }}"
                                                                 alt="{{$item->title}}" class=" rounded lazyload"
                                                                 width="30" height="30">
                                                            <input type="checkbox"
                                                                   {{in_array($item->id, request('category',[]))  ? 'checked' : '' }} name="category[]"
                                                                   value="{{ $item->id }}">
                                                            <span class="checkmark"></span>
                                                            {{$item->title}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                            @endisset

                            <label for="sorting"></label><input hidden value="{{request('sorting','last')}}"
                                                                id="sorting" name="sorting" type="text"/>
                            <div class="btn-search">
                                <button class="btn w-100">   جستجو <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="col-md-7 col-lg-9 col-xl-9">
                    <div class="row align-items-center pb-3">
                        <div class="col-md-4 col-12 d-md-block d-none custom-short-by">

                        </div>
                        <div class="col-md-8 col-12 d-md-block d-none custom-short-by">
                            <div class="sort-by pb-1">
                                <span class="sort-title">مرتب سازی</span>
                                <span class="">
<select onchange="getSelectSorting()" id="sortingSelect" class="form-select">
<option value="last" {{request('sorting',null)=='last' ? 'selected' : ''}} class="sorting">آخرین</option>
    <option {{request('sorting',null)=='max_price' ? 'selected' : ''}} value="max_price"
            class="sorting">بیشترین قیمت</option>
<option {{request('sorting',null)=='min_price' ? 'selected' : ''}} value="min_price"
        class="sorting">کمترین قیمت</option>
</select>
</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        @isset($data)

                            @foreach($data as $item)
                                @component('blog::componets.service',['item'=>$item])
                                @endcomponent
                            @endforeach

                        @endisset


                    </div>
                    <div class="col-md-12 text-center">
                        <div class="col-md-12">
                            <div class="blog-pagination">
                                <nav>

                                    {{$data->links('blog::componets.paginate')}}

                                </nav>
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
    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/slick.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/aos.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/script.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>
    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="b97d855d680359945684ceb5-|49" defer=""></script></body>



    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="942f7db5747e2b6949c592c8-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="942f7db5747e2b6949c592c8-text/javascript"></script>
    <script>
        function getSelectSorting() {
            // Get the select element
            var select = document.getElementById('sortingSelect');

            // Get the selected option value
            var selectedValue = select.options[select.selectedIndex].value;


            document.getElementById('sorting').value = selectedValue;
            // Log or use the selected value as needed
        }
    </script>
@stop
