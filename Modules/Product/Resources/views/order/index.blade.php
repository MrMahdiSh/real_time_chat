@extends('layouts.master_forms')

@section('title')
    لیست سفارشات
@endsection

@section('css')

@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            @include('partials.breadcrumb',['title'=>'لیست سفارشات'])


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
                                <th>شماره سفارش</th>
                                <th>مبلغ</th>
                                <th>وضعیت</th>
                                <th>جزییات</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            @if(!empty($data))
                                <tbody>
                                @foreach($data as $item)
                                    <tr>

                                        <td>{{$item->id}}</td>
                                        <td>{{$item->number}}</td>
                                        <td>{{number_format($item->price,null)}}</td>

                                        @switch($item->status)
                                            @case(\App\OrderStatus::Paid)
                                            <td class="alert alert-success">پرداخت شده ، در حال ارسال</td>
                                            @break
                                            @case(\App\OrderStatus::Unpaid)
                                            <td class="alert alert-danger">پرداخت نشده</td>
                                            @break
                                            @case(\App\OrderStatus::Delivered)
                                            <td class="alert alert-primary">ارسال شده</td>
                                            @break
                                        @endswitch
                                        <td>
                                            <button
                                                class="btn btn-primary show-subtable-button">
                                                مشاهده
                                                جزییات
                                            </button>
                                        </td>
                                        <td>
                                            @if($item->status!=\App\OrderStatus::Unpaid && $item->status!=\App\OrderStatus::Delivered)
                                                <a href="{{route('ProductOrder.confirm',['id'=>$item->id])}}"
                                                   class="btn btn-primary show-subtable-button">
                                                    تاییدیه تحویل
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @isset($item->detail)
                                        <tr class="subtable-row" style="display: none;">
                                            <td colspan="3">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>پزشک</th>
                                                        <th scope="col">محصول</th>
                                                        <th scope="col">مبلغ</th>
                                                        <th scope="col">تعداد</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($item->detail as $val)
                                                        <tr>
                                                            <td>{{$val->doctor ? $val->doctor->full_name : 'نامشخص'}}</td>
                                                            <td>{{$val->title}}</td>
                                                            <td>{{number_format($val->price,null).' تومان '}}</td>
                                                            <td>{{$val->count}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endisset
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
    <script>
        $(document).ready(function () {
            // تابع برای نمایش/مخفی کردن زیرمجموعه‌ها با کلیک بر روی دکمه
            $(".show-subtable-button").click(function () {
                $(this).closest('tr').next('tr.subtable-row').toggle();
            });
        });
    </script>

@endsection
