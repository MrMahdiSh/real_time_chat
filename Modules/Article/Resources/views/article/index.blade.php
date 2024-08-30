@extends('layouts.master_forms')

@section('title')
    لیست مقالات
@endsection

@section('css')

@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            @include('partials.breadcrumb',['title'=>'لیست مقالات'])


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
                                <th>عکس</th>
                                <th>عنوان</th>
                                <th>دسته بندی</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            @if(isset($data))

                                <tbody>
                                @foreach($data as $key=>$item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td class="product-img sorting_1"><img class="rounded rounded-circle"
                                                                               width="100" height="100"
                                                                               src="{{isset($item->media) ? $item->media->url : asset('assets_blog/img/no_image.png')}}"
                                                                               alt="">
                                        </td>
                                        <td class="product-name">{{$item->title}}</td>
                                        <td class="product-name">{{isset($item->category) ? $item->category->title : 'نامشخص'}}</td>
                                        <td>
                                            @if(auth()->user()->can('Article.edit'))

                                                <a href="{{route('Article.status',['id'=>$item->id])}}">

                                                    <div
                                                        class="chip {{(int)$item->status==1 ? 'chip-success' : 'chip-danger'}}">
                                                        <div class="chip-body">
                                                            <div
                                                                class="chip-text">{{(int)$item->status==1 ? 'فعال' : 'غیرفعال'}}</div>
                                                        </div>
                                                    </div>
                                                </a>

                                            @endif
                                        </td>
                                        <td class="product-action">
                                            @if(auth()->user()->can('Article.index'))
                                                <a href="{{route('Article.show',['Article'=>$item->id])}}"><span
                                                        title="مشاهده نظرات" class="action-edit"><i
                                                            class="feather icon-message-circle"></i></span>{{$item->all_comments()->count()}}
                                                </a>
                                            @endif

                                            @if(auth()->user()->can('Article.edit'))
                                                <a href="{{route('Article.edit',['Article'=>$item->id])}}"><span
                                                        class="action-edit"><i class="feather icon-edit"></i></span></a>
                                            @endif


                                            @if(auth()->user()->can('Article.destroy'))
                                                <a href="#"
                                                   onclick="delete_item('{{route('Article.destroy',['Article'=>$item->id])}}')">
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
