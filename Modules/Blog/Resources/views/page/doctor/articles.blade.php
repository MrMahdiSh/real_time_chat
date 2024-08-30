@extends('blog::layouts.master_index')


@section('title')
    مقالات
@stop

@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">


    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">


    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

@stop


@section('content')

    @include('blog::partials.doctor_breadcrumb',['title'=>'مقالات'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    @include('blog::partials.doctor_sidebar')
                </div>

                <div class="col-md-7 col-lg-8 col-xl-9">


                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{route('doctor.article')}}" class="btn btn-info "><i class="fa fa-plus"></i> ثبت
                                مقاله جدید </a>
                            <br>
                        </div>


                        <hr>

                        <div class="col-md-12">
                            <br>

                            <h4 class="mb-4">مقالات من</h4>
                            <div class="appointment-tab">

                                <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane show active" id="upcoming-appointments">
                                        <div class="card card-table mb-0">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-center mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>تصویر</th>
                                                            <th>عنوان</th>
                                                            <th>دسته بندی</th>
                                                            <th>وضعیت</th>
                                                            <th>نظرات</th>
                                                            <th class="text-center">عملیات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @isset($articles)

                                                            @foreach($articles as $key=>$item)

                                                                <tr>
                                                                    <td class="product-img sorting_1"><img width="60"
                                                                                                           class="rounded-circle rounded"
                                                                                                           height="60"
                                                                                                           src="{{isset($item->media) ? $item->media->url : asset('assets_blog/img/no_image.png')}}"
                                                                                                           alt="{{$item->title}}">
                                                                    </td>
                                                                    <td class="product-name">{{$item->title}}</td>
                                                                    <td class="product-name">{{isset($item->category) ? $item->category->title : 'نامشخص'}}</td>
                                                                    <td>
                                                                        <a>

                                                                            <div
                                                                                class="btn {{(int)$item->status==1 ? 'btn-success' : 'btn-danger'}}">
                                                                                <div class="chip-body">
                                                                                    <div
                                                                                        class="chip-text">{{(int)$item->status==1 ? 'فعال' : 'غیرفعال'}}</div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td class="product-action">
                                                                        <a href="{{route('doctor.article.comments',['id'=>$item->id])}}"><span
                                                                                title="مشاهده نظرات"
                                                                                class="action-edit"><i
                                                                                    class="feather icon-message-circle"></i></span>{{$item->all_comments()->count()}}
                                                                        </a>
                                                                    </td>
                                                                    <td class="product-action">


                                                                        <a href="{{route('doctor.article.edit',['id'=>$item->id])}}"><span
                                                                                class="action-edit"><i
                                                                                    class="fa fa-edit"></i></span></a>


                                                                        <a href="{{route('doctor.article.delete',['id'=>$item->id])}}"
                                                                        >
                                                    <span class=""><i
                                                            class="fa fa-trash"></i></span>


                                                                        </a>
                                                                    </td>
                                                                </tr>


                                                            @endforeach
                                                        @endisset

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@section('js')
    <script type="text/javascript" src="{{asset('assets_blog/js/jquery-migrate-1.2.1.min.js')}}"></script>


    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\DoctorLoginValidation', '#form'); !!}


    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/slick.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/aos.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>




    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>

    <script src="{{asset('assets_blog/js/circle-progress.min.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>

    <script src="{{asset('assets_blog/js/script.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>
    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="b97d855d680359945684ceb5-|49" defer=""></script></body>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
@stop
