@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">
    @include('partials.ck_editor_css')
    <link rel="stylesheet" href="{{asset('assets_blog/fstdropdown/fstdropdown.css')}}">

@endsection
@section('title')
    ویرایش خدمت
@endsection

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @include('partials.breadcrumb',['title'=>'ویرایش خدمت'])
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
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">ویرایش خدمت</span>
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
                                              action="{{route('ServiceModel.update',['ServiceModel'=>$data->id])}}"
                                              method="post" enctype="multiLink/form-data">
                                            {{method_field('PUT')}}

                                            {{--                                            <input hidden name="_method" value="PUT">--}}
                                            @csrf


                                            @include('partials.single_upload_image',[
                                                                                                                                                                                                                         'title'=>'آپلود تصویر',
                                                                                                                                                                                                                         'ratio'=>'2:2',
                                                                                                                                                                                                                         'size'=>'510,600',
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
                                                            <label>قیمت</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="  قیمت  را وارد کنید"
                                                                   name="price"
                                                                   value="{{$data->price}}"
                                                                   id="price">
                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="col-12 col-sm-6">

                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>
                                                                تخفیف
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="  تخفیف  را وارد کنید"
                                                                   name="offer"
                                                                   value="{{$data->offer}}"
                                                                   id="offer">
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

                                                </div>
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
    {!! JsValidator::formRequest('Modules\Service\Http\Requests\ServiceModelValidation', '#form'); !!}

    <script src="{{asset('assets/slim_cropper/js/require.js')}}"
            data-main="{{asset('assets/slim_cropper/js/main.min')}}"></script>
    @include('partials.ck_editor_js')

    <script>

        CKEDITOR.replace('fa_description');

    </script>
    <script src="{{asset('assets_blog/fstdropdown/fstdropdown.js')}}"></script>

@endsection


