@extends('layouts.master')

@section('css')
    @include('partials.ck_editor_css')

@endsection
@section('title')
    تنظیمات محصول
@endsection

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @include('partials.breadcrumb',['title'=>'تنظیمات محصول'])
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
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">تنظیمات محصول</span>
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
                                              action="{{route('ProductSetting.update',['ProductSetting'=>$data->id])}}"
                                              method="post" enctype="multiLink/form-data">
                                            {{method_field('PUT')}}

                                            <input hidden name="_method" value="PUT">
                                            @csrf

                                            <div class="row">

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>درصد مالیات</label>
                                                            <input type="number" class="form-control"
                                                                   placeholder="درصد مالیات"
                                                                   name="tax_price"
                                                                   value="{{$data->tax_price}}"
                                                                   id="tax_price">
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>هزینه حمل و نقل</label>
                                                            <input type="number" class="form-control"
                                                                   placeholder="  هزینه حمل و نقل  را وارد کنید"
                                                                   name="transfer_price"
                                                                   value="{{$data->transfer_price}}"
                                                                   id="transfer_price">
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
    {!! JsValidator::formRequest('Modules\Product\Http\Requests\ProductSettingValidation', '#form'); !!}


@endsection


