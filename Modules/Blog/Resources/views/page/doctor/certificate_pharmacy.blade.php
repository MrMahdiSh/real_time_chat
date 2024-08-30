@extends('blog::layouts.master_index')


@section('title')
    درخواست فعال سازی داروخانه
@stop

@section('css')

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">



    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">



    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/fstdropdown/fstdropdown.css')}}">


@stop


@section('content')

    @include('blog::partials.doctor_breadcrumb',['title'=>'درخواست فعال سازی داروخانه'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                    @include('blog::partials.doctor_sidebar')

                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">

                    <form method="post" class="form" name="form" id="form"
                          action="{{route('doctor.certificate.product.post')}}"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> درخواست فعال سازی داروخانه</h4>

                                <p class="alert alert-info">لطفا ابتدا از قسمت تیکت درخواست ثبت داروخانه خود را انجام
                                    دهید!</p>
                                <div class="row form-row">

                                    @isset($pharmacy)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>داروخانه</label>
                                                <select required name="p_id" id="p_id"
                                                        class="fstdropdown-select ">
                                                    <option value="">انتخاب کنید</option>
                                                    @foreach($pharmacy as $item)
                                                        <option
                                                            value="{{$item->id}}">{{"{$item->title} - {$item->city_state}"}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                    @endisset


                                </div>
                            </div>
                        </div>


                        @csrf

                        <div class="submit-section submit-btn-bottom">
                            <button type="submit" class="btn btn-primary submit-btn">ذخیره</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@stop


@section('js')

    <script type="text/javascript" src="{{asset('assets_blog/js/jquery-migrate-1.2.1.min.js')}}"></script>



    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\PharmacyValidation', '#form'); !!}



    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>


    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets/slim_cropper/js/require.js')}}"
            data-main="{{asset('assets/slim_cropper/js/main.min')}}"></script>


    <script src="{{asset('assets_blog/fstdropdown/fstdropdown.js')}}"></script>






    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="1cce86bdda76a43346990492-|49" defer=""></script>



@stop
