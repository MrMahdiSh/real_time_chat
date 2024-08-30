@extends('layouts.master_forms')

@section('title')
    لیست نظرات
@endsection

@section('css')

@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            @include('partials.breadcrumb',['title'=>'لیست نظرات'])


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
                                <th>خدمت</th>
                                <th>دکتر</th>
                                <th>بیمار</th>
                                <th>پیام</th>
                                <th>امتیاز</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            @if(isset($data))

                                <tbody>
                                @foreach($data as $key=>$item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td class="product-name">{{$item->service ? $item->service->title : ''}}</td>
                                        <td class="product-name">{{$item->service->doctor ? $item->service->doctor->full_name : ''}}</td>
                                        <td class="product-name">{{$item->patient ? $item->patient->full_name : ''}}</td>
                                        <td class="product-name">{{$item->message}}</td>
                                        <td class="product-name">{{$item->star}}</td>
                                        <td>
                                            @if(auth()->user()->can('Service.edit'))

                                                <div
                                                    class="chip {{$item->status==\App\Status::True ?  'chip-success' : 'chip-danger'}}">
                                                    <div class="chip-body">
                                                        <a href="{{route('service.comment.status',['id'=>$item->id])}}"
                                                           class="btn ">{{$item->status==\App\Status::True ? 'تایید' : 'تایید نشده'}}</a>
                                                    </div>
                                                </div>

                                            @endif
                                        </td>


                                        <td class="product-action">


                                            @if(auth()->user()->can('Service.destroy'))

                                            <a href="#"
                                                   onclick="delete_item('{{route('ServiceRate.destroy',['ServiceRate'=>$item->id])}}')">
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
