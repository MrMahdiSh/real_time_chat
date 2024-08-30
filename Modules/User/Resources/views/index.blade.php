@extends('layouts.master_forms')

@section('title')
    کاربران پنل
@endsection

@section('css')

@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            {{--            @include('partials.breadcrumb',['title'=>'لیست کاربران'])--}}


            <div class="content-body">
                <!-- Data list view starts -->
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
                                <th>@lang('default.name')</th>
                                <th>@lang('default.family')</th>
                                <th>@lang('default.username')</th>
                                <th>@lang('default.mobile')</th>
                                <th>@lang('default.email')</th>
                                <th>@lang('default.setting')</th>
                            </tr>
                            </thead>
                            @if(isset($users))

                                <tbody>
                                @foreach($users as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td class="product-name">{{$item->name}}</td>
                                        <td class="product-category">{{$item->family}}</td>

                                        <td>
                                            <div class="chip chip-warning">
                                                <div class="chip-body">
                                                    <div class="chip-text">{{$item->username}}</div>
                                                </div>
                                            </div>
                                        </td>


                                        <td class="product-price">{{$item->mobile}}</td>
                                        <td class="product-price">{{$item->email}}</td>
                                        <td class="product-action">

                                            @if(auth()->user()->can('Admins.edit'))
                                                <a href="{{route('Admins.edit',['Admin'=>$item->id])}}"><span
                                                        class="action-edit"><i class="feather icon-edit"></i></span></a>

                                            @endif

                                            @if(auth()->user()->can('Admins.destroy'))

                                                <a href="#"
                                                   onclick="delete_item('{{route('Admins.destroy',['Admin'=>$item->id])}}')">
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
                <!-- Data list view end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection

@include('partials.delete_item_sweet_alert')

@section('js')


@endsection
