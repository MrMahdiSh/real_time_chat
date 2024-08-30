@extends('layouts.master_forms')

@section('title')
    تراکنشات
@endsection

@section('css')

@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            @include('partials.breadcrumb',['title'=>'تراکنشات'])


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
                                <th>کاربر</th>
                                <th>عنوان</th>
                                <th>شماره</th>
                                <th>مبلغ</th>
                                <th>وضعیت</th>
                                <th>تاریخ</th>

                            </tr>
                            </thead>
                            @if(isset($data))

                                <tbody>
                                @foreach($data as $key=>$item)
                                    <tr>
                                        <td>{{$key+1}}</td>

                                        <td class="product-name">{{isset($item->user) ? $item->user->name.' '.$item->user->family : 'نامشخص'}}</td>
                                        <td class="product-name">{{$item->title}}</td>
                                        <td class="product-name">{{$item->order ? $item->order->number : ''}}</td>
                                        <td class="product-name">{{number_format($item->price).'تومان'}}</td>
                                        <td>
                                            <a href="#">
                                                <div
                                                    class="chip {{(int)$item->status==1 ? 'chip-success' : 'chip-danger'}}">
                                                    <div class="chip-body">
                                                        <div
                                                            class="chip-text">{{(int)$item->status==1 ? 'پرداخت شده' : 'پرداخت نشده'}}</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="product-name">{{$item->date}}</td>


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
