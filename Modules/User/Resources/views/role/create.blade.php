@extends('layouts.master')


@section('title')
    @lang('default.create_role')
@endsection

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            {{--            @include('partials.breadcrumb',['title'=>'ثبت نقش'])--}}

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
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">@lang('default.create_role')</span>
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
                                              action="{{route('Roles.store')}}"
                                              method="post" enctype="multipart/form-data">


                                            {{--                                            <input hidden name="_method" value="PUT">--}}
                                            @csrf


                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>@lang('default.role_name')</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="@lang('default.role_name')"

                                                                   name="name"

                                                                   id="name">
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="col-12 col-sm-6">

                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>@lang('default.role_en_name')</label>
                                                            <input type="text" class="form-control"
                                                                   name="display_name"
                                                                   id="display_name"
                                                                   placeholder="@lang('default.role_en_name')"

                                                            >
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-12">
                                                    <div class="table-responsive border rounded px-1 ">
                                                        <h6 class="border-bottom py-1 mx-1 mb-0 font-medium-2"><i
                                                                class="feather icon-lock mr-50 "></i> @lang('default.permissions')
                                                        </h6>
                                                        <table class="table table-borderless">
                                                            <thead>
                                                            <tr>
                                                                <th>@lang('default.module')</th>
                                                                <th>@lang('default.index')</th>
                                                                <th>@lang('default.edit')</th>
                                                                <th>@lang('default.create')</th>
                                                                <th>@lang('default.delete')</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @isset($packages)
                                                                @foreach($packages as $item)

                                                                    <tr>
                                                                        <td>{{$item->display_name}}</td>

                                                                        @php

                                                                            $index= Spatie\Permission\Models\Permission::where('name',$item->title.'.index')->first();
                                                                            $create= Spatie\Permission\Models\Permission::where('name',$item->title.'.create')->first();
                                                                            $edit= Spatie\Permission\Models\Permission::where('name',$item->title.'.edit')->first();
                                                                            $destroy= Spatie\Permission\Models\Permission::where('name',$item->title.'.destroy')->first();



                                                                        @endphp


                                                                        <td>

                                                                            <div
                                                                                class="vs-checkbox-con vs-checkbox-primary">
                                                                                <input type="checkbox"

                                                                                       {{isset($index) ? '' : 'disabled'}}
                                                                                       id="roles"
                                                                                       name="roles[]"
                                                                                       value="{{isset($index->id) ? $index->id : ''}}"

                                                                                >
                                                                                <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                                                <span class=""></span>
                                                                            </div>

                                                                        </td>


                                                                        <td>

                                                                            <div
                                                                                class="vs-checkbox-con vs-checkbox-primary">
                                                                                <input type="checkbox"

                                                                                       {{isset($create) ? '' : 'disabled'}}
                                                                                       id="roles"
                                                                                       name="roles[]"
                                                                                       value="{{isset($create->id) ? $create->id : ''}}"

                                                                                >
                                                                                <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                                                <span class=""></span>
                                                                            </div>
                                                                        </td>
                                                                        <td>


                                                                            <div
                                                                                class="vs-checkbox-con vs-checkbox-primary">
                                                                                <input type="checkbox"

                                                                                       {{isset($edit) ? '' : 'disabled'}}
                                                                                       id="roles"
                                                                                       name="roles[]"
                                                                                       value="{{isset($edit->id) ? $edit->id : ''}}"

                                                                                >
                                                                                <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                                                <span class=""></span>
                                                                            </div>
                                                                        </td>
                                                                        <td>


                                                                            <div
                                                                                class="vs-checkbox-con vs-checkbox-primary">
                                                                                <input type="checkbox"

                                                                                       {{isset($destroy) ? '' : 'disabled'}}
                                                                                       id="roles"
                                                                                       name="roles[]"
                                                                                       value="{{isset($destroy->id) ? $destroy->id : ''}}">

                                                                                <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
                                                                                <span class=""></span>
                                                                            </div>


                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endisset

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>


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
    {!! JsValidator::formRequest('App\Http\Requests\CreateRoleValidation', '#form'); !!}

@endsection

@section('js')

@endsection
