@extends('layouts.master_forms')

@section('title')
    لیست دکترها
@endsection

@section('css')
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            @include('partials.breadcrumb', ['title' => 'لیست دکترها'])


            <div class="content-body">
                <!-- Data list view starts -->
                <section id="data-list-view" class="data-list-view-header">

                    <!-- DataTable starts -->
                    <div class="table-responsive">
                        <table class="table data-list-view">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>کد</th>
                                    <th>نام</th>
                                    <th>شماره تماس</th>
                                    <th>دسته</th>
                                    <th>ویژه</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            @if (isset($data))
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td class="product-name">{{ $item->username }}</td>
                                            <td class="product-name">{{ $item->full_name }} </td>
                                            <td class="product-name">{{ $item->mobile }}</td>
                                            <td class="product-name">{{ $item->category ? $item->category->title : '' }}
                                            </td>



                                            <td class="">
                                                @if (auth()->user()->can('Doctor.edit'))
                                                    <a class="btn btn-{{ $item->certificate == \App\Status::True ? 'success' : 'danger' }}"
                                                        href="{{ route('Doctor.certificate.status', ['id' => $item->id]) }}">{{ $item->certificate == \App\Status::True ? 'فعال' : 'غیرفعال' }}
                                                        (ضربه بزنید)
                                                    </a>
                                                @endif

                                            </td>



                                            <td class="product-action">
                                               
                                                <a class="float- mx-1"
                                                    href="{{ route('doSignIn', ['id' => $item->id]) }}"><span
                                                        class="action-edit"><i class="feather icon-log-in"></i></span></a>
                                                @if (auth()->user()->can('Doctor.edit'))
                                                    <a href="{{ route('Doctor.edit', ['Doctor' => $item->id]) }}"><span
                                                            class="action-edit"><i class="feather icon-edit"></i></span></a>
                                                @endif
                                                @if (auth()->user()->can('Doctor.destroy'))
                                                    <a href="#"
                                                        onclick="delete_item('{{ route('Doctor.destroy', ['Doctor' => $item->id]) }}')">
                                                        <span class=""><i class="feather icon-trash"></i></span>
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
