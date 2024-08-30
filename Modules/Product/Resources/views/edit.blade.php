@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">
    @include('partials.ck_editor_css')
    <link rel="stylesheet" href="{{asset('assets_blog/fstdropdown/fstdropdown.css')}}">

@endsection
@section('title')
    ویرایش محصول
@endsection

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @include('partials.breadcrumb',['title'=>'ویرایش محصول'])
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
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">ویرایش محصول</span>
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
                                              action="{{route('Product.update',['Product'=>$data->id])}}"
                                              method="post" enctype="multiLink/form-data">
                                            {{method_field('PUT')}}

                                            <input hidden name="_method" value="PUT">
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
                                                            <label>مبلغ</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="  مبلغ  را وارد کنید"
                                                                   name="price"
                                                                   value="{{$data->price}}"
                                                                   id="price">
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>تخفیف</label>
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
                                                <div class="col-12 col-sm-6">

                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>تعداد</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="  تعداد  را وارد کنید"
                                                                   name="count"
                                                                   value="{{$data->count}}"
                                                                   id="تعداد">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>کشور</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="  کشور  را وارد کنید"
                                                                   name="country"
                                                                   value="{{$data->country}}"
                                                                   id="country">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>سایز</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="  سایز  را وارد کنید"
                                                                   name="size"
                                                                   value="{{$data->size}}"
                                                                   id="size">
                                                        </div>
                                                    </div>
                                                    @isset($brands)
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>برند</label>
                                                                <select name="brand_id" id="brand_id"
                                                                        class="fstdropdown-select  ">
                                                                    @foreach($brands as $item)
                                                                        <option
                                                                            {{(int)$data->brand_id==$item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->title}}
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
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>طریقه استفاده</label>
                                                            <textarea name="how_to_use"
                                                                      id="how_to_use">{{$data->how_to_use}}</textarea>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>نگهداری</label>
                                                            <textarea name="keeping"
                                                                      id="keeping">{{$data->keeping}}</textarea>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>دستور مصرف</label>
                                                            <textarea name="instruction"
                                                                      id="instruction">{{$data->instruction}}</textarea>

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>احتیاط</label>
                                                            <textarea name="warning"
                                                                      id="warning">{{$data->warning}}</textarea>

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
    {!! JsValidator::formRequest('Modules\Product\Http\Requests\ProductBrandValidation', '#form'); !!}

    <script src="{{asset('assets/slim_cropper/js/require.js')}}"
            data-main="{{asset('assets/slim_cropper/js/main.min')}}"></script>
    @include('partials.ck_editor_js')

    <script>

        CKEDITOR.replace('keeping');
        CKEDITOR.replace('how_to_use');
        CKEDITOR.replace('instruction');
        CKEDITOR.replace('warning');

    </script>
    <script src="{{asset('assets_blog/fstdropdown/fstdropdown.js')}}"></script>


@endsection


