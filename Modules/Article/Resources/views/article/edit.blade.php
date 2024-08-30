@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">
    @include('partials.ck_editor_css')

@endsection
@section('title')
    ویرایش مقاله
@endsection

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @include('partials.breadcrumb',['title'=>'ویرایش مقاله'])
            <div class="content-body">
                <!-- users edit start -->
                <section class="users-edit">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="account-tab"
                                           data-toggle="tab" href="#account" aria-controls="account" role="tab"
                                           aria-selected="true">
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">ویرایش مقاله</span>
                                        </a>
                                    </li>

                                </ul>


                                <div class="tab-content">

                                    <div class="tab-pane active" id="account" aria-labelledby="account-tab"
                                         role="tabpanel">
                                        <!-- users edit media object start -->


                                        <!-- users edit media object ends -->
                                        <!-- users edit account form start -->
                                        <form id="form" name="form"
                                              action="{{route('Article.update',['Article'=>$data->id])}}"
                                              method="post" enctype="multiArticle/form-data">

                                            {{method_field('PUT')}}
                                            {{--                                            <input hidden name="_method" value="PUT">--}}
                                            @csrf

                                            @include('partials.single_upload_image',[
                                                                                                                                                                                'title'=>null,
                                                                                                                                                                                'ratio'=>'2:2',
                                                                                                                                                                                                                                                                                                                                                               'size'=>'1200,800',

                                                                                                                                                                                'image'=>isset($data->media) ? $data->media : null,
                                                                                                                                                                                'name'=>'image',
                                                                                                                                                                                ])
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>عنوان</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="  عنوان  را وارد کنید"
                                                                   name="title"
                                                                   value="{{$data->title}}"
                                                                   id="title">
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>لینک اینستاگرامی</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="آدرس را وارد کنید"
                                                                   name="insta_link"
                                                                   value="{{$data->insta_link}}"
                                                                   id="insta_link">
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>لینک تلگرامی</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="آدرس را وارد کنید"
                                                                   name="whatsapp_link"
                                                                   value="{{$data->whatsapp_link}}"
                                                                   id="whatsapp_link">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>دسته بندی</label>
                                                        <select name="category_id" id="category_id"
                                                                class="form-control">

                                                            @if(isset($categories))

                                                                @foreach($categories as $item)
                                                                    <option
                                                                        {{(int)$data->category_id==(int)$item->id ? 'selected' : ''}}
                                                                        value="{{$item->id}}">{{$item->title}}</option>

                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>نویسنده</label>
                                                        <select name="writer_id" id="writer_id"
                                                                class="form-control">
                                                            @if(isset($teams))
                                                                @foreach($teams as $item)
                                                                    <option
                                                                        {{(int)$data->writer_id==$item->id ? 'selected' : ''}}
                                                                        value="{{$item->id}}">{{$item->name.'('.$item->degree.')'}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12">
                                                    <div class="controls">
                                                        <label>تگ ها</label>

                                                        @php

                                                            $my_tags=!empty($data->tags) ? json_decode($data->tags) : '';
                                                        @endphp
                                                        @foreach($tags as $item)
                                                            <div
                                                                class="vs-checkbox-con vs-checkbox-primary">
                                                                <input type="checkbox"
                                                                       @if(isset($my_tags))
                                                                           @foreach($my_tags as $val)
                                                                               {{(int)$val==(int)$item->id ?'checked' : ''}}
                                                                           @endforeach
                                                                       @endif
                                                                       id="tags"
                                                                       name="tags[]"
                                                                       value="{{$item->id}}"

                                                                >{{$item->title}}
                                                                <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                                <span class=""></span>
                                                            </div>
                                                        @endforeach
                                                    </div>


                                                </div>
                                                <br>
                                                <hr>
                                                <br>
                                                <div class="col-12 col-sm-12">


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>توضیحات</label>
                                                            <textarea name="description"
                                                                      id="editor">{{$data->description}}</textarea>

                                                        </div>
                                                    </div>


                                                </div>

                                                <div
                                                    class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit"
                                                            class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                                                        ذخیره
                                                    </button>

                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit account form ends -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\Article\Http\Requests\CreateArticleValidation', '#form'); !!}

    <script src="{{asset('assets/slim_cropper/js/require.js')}}"
            data-main="{{asset('assets/slim_cropper/js/main.min')}}"></script>
    @include('partials.ck_editor_js')

    <script>

        CKEDITOR.replace('fa_description');

    </script>
@endsection


