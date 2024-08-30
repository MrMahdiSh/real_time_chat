@extends('layouts.master_forms')

@section('title')
    لیست دسته بندی
@endsection

@section('css')

@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            @include('partials.breadcrumb',['title'=>'لیست دسته بندی'])


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
                                @if(request('category_id'))
                                    <th>تصویر</th>
                                @endif
                                <th>عنوان</th>
                                <th>وضعیت</th>
                                @if(!request('category_id'))
                                    <th>زیردسته</th>
                                @endif
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            @if(isset($data))

                                <tbody>
                                @foreach($data as $key=>$item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        @if(request('category_id'))

                                            <td class="Service-img sorting_1 "><img width="100"
                                                                                    class="rounded rounded-circle"
                                                                                    height="100"
                                                                                    src="{{isset($item->media) ? $item->media->url : asset('assets_blog/img/no_image.png')}}"
                                                                                    alt="Img placeholder">
                                            </td>
                                        @endif

                                        <td class="Service-name">{{$item->title}}</td>
                                        <td class="">
                                            @if(auth()->user()->can('Service.edit'))

                                                <a class="btn btn-{{$item->status==\App\Status::True ? 'success' : 'danger'}}"
                                                   href="{{route('ServiceCategory.status',['id'=>$item->id])}}">{{$item->status==\App\Status::True ? 'فعال' : 'غیرفعال'}}
                                                    (ضربه بزنید)</a>

                                            @endif
                                        </td>

                                        @if(!request('category_id'))

                                            <td>

                                                <a
                                                    href="{{route('ServiceCategory.index',['category_id'=>$item->id])}}"><span
                                                        class="action-edit"> مشاهده زیر دسته</span></a>
                                                <p>  </p>


                                                @if(auth()->user()->can('Service.create'))

                                                    <a
                                                        href="{{route('ServiceCategory.create',['category_id'=>$item->id])}}"><span
                                                            class="action-edit"> ثبت زیر دسته</span></a>

                                                @endif

                                            </td>

                                        @endif

                                        <td class="Service-action">
                                            @if(auth()->user()->can('Service.edit'))


                                                <a href="{{route('ServiceCategory.edit',['ServiceCategory'=>$item->id])}}"><span
                                                        class="action-edit"><i class="feather icon-edit"></i></span></a>

                                            @endif
                                            @if(auth()->user()->can('Service.destroy'))
                                                <a href="#"
                                                   onclick="delete_item('{{route('ServiceCategory.destroy',['ServiceCategory'=>$item->id])}}')">
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
