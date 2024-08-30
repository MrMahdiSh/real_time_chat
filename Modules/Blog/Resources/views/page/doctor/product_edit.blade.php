@extends('blog::layouts.master_index')


@section('title')
    ویرایش محصول
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

    @include('blog::partials.doctor_breadcrumb',['title'=>'ویرایش محصول'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                    @include('blog::partials.doctor_sidebar')

                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">

                    <form method="post" class="form" name="form" id="form"
                          action="{{route('doctor.product.update',['id'=>$data->id])}}"
                          enctype="multipart/form-data">
                        {{method_field('PUT')}}
                        @csrf
                        <input name="step" id="step" value="1" hidden>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> ویرایش محصول</h4>
                                <div class="row form-row">
                                    <div class="col-12">
                                        @include('partials.single_upload_image',[
                                                                                                                                             'title'=>' ',
                                                                                                                                             'ratio'=>'2:2',
                                                                                                                                             'size'=>'510,600',
                                                                                                                                             'image'=>isset($data->media)  ? $data->media :null,
                                                                                                                                             'name'=>'image',
                                                                                                                                             ])
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> عنوان<span class="text-danger">*</span></label>
                                            <input name="title" value="{{$data->title}}" id="title" type="text"
                                                   class="form-control"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>قیمت<span class="text-danger">*</span></label>
                                            <input name="price" value="{{$data->price}}" id="price" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>تعداد موجودی<span class="text-danger">*</span></label>
                                            <input name="count" value="{{$data->count}}" id="count" type="number"
                                                   class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> کشور سازنده <span class="text-danger">*</span></label>
                                            <input name="country" value="{{$data->country}}" id="country" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> سایز <span class="text-danger">*</span></label>
                                            <input name="size" value="{{$data->size}}" id="size" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>تخفیف(درصد)<span class="text-danger"></span></label>
                                            <input name="offer" value="{{$data->offer}}" id="offer" type="number"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    @isset($categories)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>دسته بندی</label>
                                                <select name="category_id" id="category_id"
                                                        class="fstdropdown-select ">
                                                    @foreach($categories as $item)
                                                        <option
                                                            {{(int)$data->category_id==$item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->title}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                    @endisset


                                    @isset($brands)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>برند</label>
                                                <select name="brand_id" id="brand_id"
                                                        class="fstdropdown-select  ">
                                                    @foreach($brands as $item)
                                                        <option
                                                            {{(int)$data->brand_id==$item->id ? 'selected' : ''}}value="{{$item->id}}">{{$item->title}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endisset

                                    {{-- <div class="col-md-6">
                                         <div class="form-group mb-0">
                                             <label>تاریخ تولد</label>
                                             <input name="birth_day" id="birth_day"
                                                    type="text" class="form-control date">
                                         </div>
                                     </div>--}}

                                    <div class="card-body">
                                        <h4 class="card-title"></h4>
                                        <div class="form-group mb-0">
                                            <label>توضیحات</label>
                                            <textarea name="description" id="description" class="form-control"
                                                      rows="5"> {{$data->description}}</textarea>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <h4 class="card-title"></h4>
                                        <div class="form-group mb-0">
                                            <label>طریقه مصرف</label>
                                            <textarea name="how_to_use" id="how_to_use" class="form-control"
                                                      rows="5">{{$data->how_to_use}} </textarea>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <h4 class="card-title"></h4>
                                        <div class="form-group mb-0">
                                            <label> دستورالعمل</label>
                                            <textarea name="instruction" id="instruction" class="form-control"
                                                      rows="5"> {{$data->instruction}}</textarea>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title"></h4>
                                        <div class="form-group mb-0">
                                            <label> احتیاط</label>
                                            <textarea name="warning" id="warning" class="form-control"
                                                      rows="5">{{$data->warning}} </textarea>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <h4 class="card-title"></h4>
                                        <div class="form-group mb-0">
                                            <label> نگهداری</label>
                                            <textarea name="keeping" id="keeping" class="form-control"
                                                      rows="5"> {{$data->keeping}}</textarea>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>


                        @csrf

                        <div class="submit-section submit-btn-bottom">
                            <button type="submit" class="btn btn-primary submit-btn">ذخیره تغییرات</button>
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
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\ProductValidation', '#form'); !!}



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
