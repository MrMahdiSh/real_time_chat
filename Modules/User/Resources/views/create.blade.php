@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">
    @include('partials.ck_editor_css')

@endsection
@section('title')
    @lang('default.create_user')
@endsection

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            {{--            @include('partials.breadcrumb',['title'=>@lang('default.create_user')])--}}
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
                                            <i class="feather icon-user mr-25"></i><span
                                                class="d-none d-sm-block">@lang('default.create_user')</span>
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
                                              action="{{route('Admins.store')}}"
                                              method="post" enctype="multipart/form-data">


                                            {{--                                            <input hidden name="_method" value="PUT">--}}
                                            @csrf
                                            @include('partials.single_upload_image',[
                                                                                            'title'=>null,
                                                                                            'ratio'=>'2:2',
                                                                                            'size'=>'400,400',
                                                                                            'image'=>null,
                                                                                            'name'=>'image',
                                                                                            ])

                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>@lang('default.name')</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="@lang('default.name')"

                                                                   name="name"

                                                                   id="name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>@lang('default.family')</label>
                                                            <input type="text" class="form-control"
                                                                   name="family"
                                                                   id="family"
                                                                   placeholder="@lang('default.family')"

                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>@lang('default.username')</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="@lang('default.username')"
                                                                   name="username"
                                                                   id="username"
                                                            >
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label>@lang('default.role')</label>
                                                        <select name="role" id="role" class="form-control">

                                                            @if(isset($roles))

                                                                @foreach($roles as $item)
                                                                    <option
                                                                        value="{{$item->id}}">{{$item->display_name}}</option>

                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="col-12 col-sm-6">


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>@lang('default.mobile')</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="@lang('default.mobile')"
                                                                   name="mobile"
                                                                   id="mobile"
                                                            >
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>@lang('default.email')</label>
                                                            <input type="email" class="form-control"
                                                                   placeholder="@lang('default.email')"
                                                                   name="email"
                                                                   id="email"
                                                            >
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>@lang('default.password')</label>
                                                            <input type="password" class="form-control"
                                                                   placeholder="@lang('default.password')"
                                                                   name="password"
                                                                   id="password"
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>@lang('default.conf_password')</label>
                                                            <input type="password" class="form-control"
                                                                   placeholder="@lang('default.conf_password')"
                                                                   name="password_confirmation"
                                                                   id="password_confirmation"
                                                            >
                                                        </div>
                                                    </div>


                                                </div>


                                                {{--                                                <div class="col-12 col-sm-12">--}}


                                                {{--                                                                                                        <div class="form-group">--}}
                                                {{--                                                                                                            <div class="controls">--}}
                                                {{--                                                                                                                <label>توضیحات</label>--}}
                                                {{--                                                                                                                <textarea name="description" id="editor"></textarea>--}}

                                                {{--                                                                                                            </div>--}}
                                                {{--                                                                                                        </div>--}}


                                                {{--                                                </div>--}}


                                                <div
                                                    class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit"
                                                            class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                                                        @lang('default.save')
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
    {!! JsValidator::formRequest('App\Http\Requests\CreateUserValidation', '#form'); !!}

    <script src="{{asset('assets/slim_cropper/js/require.js')}}"
            data-main="{{asset('assets/slim_cropper/js/main.min')}}"></script>
    @include('partials.ck_editor_js')

@endsection


