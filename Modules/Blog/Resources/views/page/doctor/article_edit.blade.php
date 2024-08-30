@extends('blog::layouts.master_index')


@section('title')
    ویرایش مقاله
@stop

@section('css')

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">



    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">



    <link rel="stylesheet" href="{{asset('assets_blog/plugins/dropzone/dropzone.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">
    @include('partials.ck_editor_css')
    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">

@stop


@section('content')

    @include('blog::partials.doctor_breadcrumb',['title'=>'ویرایش مقاله'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                    @include('blog::partials.doctor_sidebar')

                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">

                    <form method="post" name="form" id="form"
                          action="{{route('doctor.article.update',['id'=>$data->id])}}"
                          enctype="multipart/form-data">
                        @csrf
                        {{method_field('PUT')}}

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">ویرایش مقاله</h4>
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="change-avatar">
                                                @include('partials.single_upload_image',[
                                                                                                                                                  'title'=>'آپلود تصویر',
                                                                                                                                                  'ratio'=>'2:2',
                                                                                                                                                  'size'=>'1200,800',
                                                                                                                                                  'image'=> $data ? $data->media : null,
                                                                                                                                                  'name'=>'image',
                                                                                                                                                  ])
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> عنوان<span class="text-danger">*</span></label>
                                            <input type="text" name="title" id="title" value="{{$data->title}}"
                                                   class="form-control"
                                            >
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>دسته بندی</label>
                                            <select name="category_id" id="category_id"
                                                    class="form-select form-control">
                                                @foreach($categories as $item)
                                                    <option
                                                        {{(int)$item->id==$data->category_id ? 'selected' : ''}} value="{{$item->id}}">{{$item->title}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @php

                                        $my_tags=!empty($data->tags) ? json_decode($data->tags) : '';
                                    @endphp
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>برچسب ها</label>
                                            <select name="tags[]" id="tags"
                                                    class="form-select form-control " multiple>
                                                @foreach($tags as $item)
                                                    <option
                                                        @if(isset($my_tags))
                                                        @foreach($my_tags as $val)
                                                        {{(int)$val==(int)$item->id ?'selected' : ''}}
                                                        @endforeach
                                                        @endif


                                                        value="{{$item->id}}">{{$item->title}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> لینک اشتراک گذاری اینستاگرام<span
                                                    class="text-danger"></span></label>
                                            <input name="insta_link" value="{{$data->insta_link}}" id="insta_link"
                                                   type="text" class="form-control"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> لینک اشتراک گذاری واتساپ<span class="text-danger"></span></label>
                                            <input type="text" name="whatsapp_link" value="{{$data->whatsapp_link}}"
                                                   id="whatsapp_link"
                                                   class="form-control"
                                            >
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <div class="card-body">
                                <h4 class="card-title"> توضیحات </h4>
                                <div class="form-group mb-0">

                                    <textarea name="description" id="description" class="form-control"
                                              rows="5">{!! $data->description !!}</textarea>
                                </div>
                            </div>


                        </div>
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
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\ArticleValidation', '#form'); !!}


    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>


    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>






    <script src="{{asset('assets_blog/js/profile-settings.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/js/script.js')}}" type="1cce86bdda76a43346990492-text/javascript"></script>
    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="1cce86bdda76a43346990492-|49" defer=""></script></body>


    <script src="{{asset('assets/slim_cropper/js/require.js')}}"
            data-main="{{asset('assets/slim_cropper/js/main.min')}}"></script>
    @include('partials.ck_editor_js')

    <script>

        CKEDITOR.replace('description');

    </script>
@stop
