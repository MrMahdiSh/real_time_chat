@extends('layouts.master_forms')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">
    @include('partials.ck_editor_css')

@endsection
@section('title')
    ثبت شهر های استان |  {{$state->title}}
@endsection

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @include('partials.breadcrumb',['title'=>' ثبت شهر های استان |'.$state->title])
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
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">    ثبت شهر های استان |  {{$state->title}}
</span>
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
                                              action="{{route('City.store')}}"
                                              method="post" enctype="multiState/form-data">

                                            <input hidden name="state_id" id="state_id" value="{{$state->id}}">
                                            @csrf


                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>عنوان را وارد کنید</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="عنوان را وارد کنید"
                                                                   name="title"
                                                                   id="title">
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
                <section id="data-list-view" class="data-list-view-header">
                    {{--                    <div class="action-btns d-none">--}}
                    {{--                        <div class="btn-dropdown mr-1 mb-1">--}}
                    {{--                            <div class="btn-group dropdown actions-dropodown">--}}
                    {{--                                <button type="button"--}}
                    {{--                                        class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light"--}}
                    {{--                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                    {{--                                    Actions--}}
                    {{--                                </button>--}}
                    {{--                                <div class="dropdown-menu">--}}
                    {{--                                    <a class="dropdown-item" href="#"><i class="feather icon-trash"></i>Delete</a>--}}
                    {{--                                    <a class="dropdown-item" href="#"><i class="feather icon-archive"></i>Archive</a>--}}
                    {{--                                    <a class="dropdown-item" href="#"><i class="feather icon-file"></i>Print</a>--}}
                    {{--                                    <a class="dropdown-item" href="#"><i class="feather icon-save"></i>Another--}}
                    {{--                                        Action</a>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <!-- DataTable starts -->
                    <div class="table-responsive">
                        <table class="table data-list-view">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            @if(isset($data))

                                <tbody>
                                @foreach($data as $key=>$item)
                                    <tr>
                                        <td>{{$key+1}}</td>


                                        <td class="product-name">{{$item->title}}</td>

                                        <td class="product-action">




                                            @if(auth()->user()->can('State.edit'))
                                                <a href="{{route('City.edit',['City'=>$item->id])}}"><span
                                                        class="action-edit"><i class="feather icon-edit"></i></span></a>
                                            @endif
                                            @if(auth()->user()->can('State.destroy'))
                                                <a href="#"
                                                   onclick="delete_item('{{route('City.destroy',['City'=>$item->id])}}')">
                                                    <span class=""><i
                                                            class="feather icon-trash"></i></span>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>

                            @endif
                        </table>
                    </div>
                    <!-- DataTable ends -->


                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\State\Http\Requests\StateValidation', '#form'); !!}

    <script src="{{asset('assets/slim_cropper/js/require.js')}}"
            data-main="{{asset('assets/slim_cropper/js/main.min')}}"></script>
    @include('partials.ck_editor_js')
    @include('partials.delete_item_sweet_alert')

    <script>

        CKEDITOR.replace('fa_description');

    </script>
@endsection


