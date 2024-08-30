@extends('layouts.master_forms')

@section('title')
    تماس باما
@endsection

@section('css')

@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            @include('partials.breadcrumb',['title'=>'تماس باما'])


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
                                <th>نام</th>
                                <th>زمان</th>
                                <th>پیام</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            @if(isset($data))

                                <tbody>
                                @foreach($data as $key=>$item)
                                    <tr>
                                        <td>{{$key+1}}</td>

                                        <td class="product-name">{{$item->name}}</td>
                                        <td class="product-name">{{$item->date}}</td>
                                        <td class="product-name"
                                            title="{{$item->message}}">{{\App\Helper\Core::subStrStripTagCustomLenth($item->message,50)}}</td>
                                        <td>
                                            <a href="{{route('ContactUs.status',['id'=>$item->id])}}">

                                                <div
                                                    class="chip {{(int)$item->seen==1 ? 'chip-success' : 'chip-danger'}}">
                                                    <div class="chip-body">
                                                        <div
                                                            class="chip-text">{{(int)$item->seen==1 ? 'دیده شده' : 'دیده نشده'}}</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>

                                        <td class="product-action">

                                            @if(auth()->user()->can('Setting.destroy'))


                                                <a href="#"
                                                   onclick="delete_item('{{route('ContactUs.destroy',['ContactU'=>$item->id])}}')">
                                                    <span class=""><i
                                                            class="feather icon-trash"></i></span>
                                                </a>



                                                <a onclick="show_msg('{{$item->message}}')" href="#" title="مشاهده پیام"
                                                >
                                                    <span class=""><i
                                                            class="feather icon-eye"></i></span>
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
    <div class="modal fade" id="MessageModal" tabindex="-1" role="dialog" aria-labelledby="MessageModal"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">نمایش کل پیام ارسال شده</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="message_content">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>

                </div>
            </div>
        </div>
    </div>
@endsection

@include('partials.delete_item_sweet_alert')

@section('js')
    <script>

        function show_msg(val) {

            $('#MessageModal').modal('show');
            document.getElementById('message_content').innerHTML = val;

        }

    </script>

@endsection
