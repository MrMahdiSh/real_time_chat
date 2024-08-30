@extends('blog::layouts.master_index')


@section('title')
{{$data->title}}
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

@stop


@section('content')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">خانه</a></li>
                            <li class="breadcrumb-item active" aria-current="page">‌بلاگ</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">{{$data->title}}</h2>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-view">
                        <div class="blog blog-single-post">
                            <div class="blog-image">
                                <a href="javascript:void(0);"><img alt="{{$data->title}}"
                                                                   src="{{$data->media ? $data->media->url : ''}}"
                                                                   class="img-fluid"></a>
                            </div>
                            <h3 class="blog-title">{{$data->title}}</h3>
                            <div class="blog-info clearfix">
                                <div class="post-left">
                                    <ul>
                                        <li>
                                            <div class="post-author">
                                                <a href="#"><img
                                                        src="@if($data->user){{$data->user->media ? $data->user->media->url : ''}} @endif @if($data->doctor) {{$data->doctor->media ? $data->doctor->media->url : ''}} @endif"
                                                        alt="{{$data->user ? $data->user->name.' | '.$data->user->degree : ( $data->doctor ? $data->doctor->full_name : 'ادمین')}}">
                                                    <span>{{$data->user ? $data->user->name.' | '.$data->user->degree : ( $data->doctor ? $data->doctor->full_name : 'ادمین')}}</span></a>
                                            </div>
                                        </li>
                                        <li><i class="far fa-calendar"></i>{{$data->fa_date}}</li>
                                        <li><i class="far fa-comments"></i>{{$data->comments()->count()}} نظر</li>
                                        <li><i class="fa fa-tags"></i>{{$data->category ? $data->category->title : ''}}
                                        </li>
                                        <li><i class="fa fa-tags"></i>{{$data->tag_text}}  </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog-content">
                                <p> {!! $data->description !!}</p>
                            </div>
                        </div>
                        <div class="card blog-share clearfix">
                            <div class="card-header">
                                <h4 class="card-title">اشتراک پست</h4>
                            </div>
                            <div class="card-body">
                                <ul class="social-share">
                                    <li><a target="_blank"
                                           href="{{!empty($data->insta_link) ? $data->insta_link : '#'}}"
                                           title="instagram"><i class="fab fa-instagram"></i></a></li>
                                    <li><a target="_blank"
                                           href="{{!empty($data->whatsapp_link) ? $data->whatsapp_link : '#'}}"
                                           title="telegram"><i class="fab fa-telegram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card author-widget clearfix">
                            <div class="card-header">
                                <h4 class="card-title">درباره نویسنده</h4>
                            </div>
                            <div class="card-body">
                                <div class="about-author">
                                    <div class="about-author-img">
                                        <div class="author-img-wrap">
                                            <a href="#"><img class="img-fluid rounded-circle"
                                                             alt="{{$data->user ? $data->user->name.' | '.$data->user->degree : ( $data->doctor ? $data->doctor->full_name : 'ادمین') }}"
                                                             src=" @if($data->doctor){{$data->doctor->media ? $data->doctor->media->url : ''}} @endif @if($data->user){{$data->user->media ? $data->user->media->url : ''}} @endif"></a>
                                        </div>
                                    </div>
                                    <div class="author-details">
                                        <a href="#"
                                           class="blog-author-name">{{$data->user ? $data->user->name.' | '.$data->user->degree : ( $data->doctor ? $data->doctor->full_name : 'ادمین') }}</a>
                                        <p class="mb-0">{!! isset($data->user) ? $data->user->description : ( $data->doctor ? $data->doctor->about_me : 'ادمین') !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card blog-comments clearfix">
                            <div class="card-header">
                                <h4 class="card-title">نظر ({{$data->comments()->count()}})</h4>
                            </div>
                            <div class="card-body pb-0">
                                <ul class="comments-list">
                                    @isset($data->comments)

                                        @foreach( $data->comments()->get() as $item)

                                            @component('blog::componets.comment',['item'=>$item])

                                            @endcomponent
                                        @endforeach

                                    @endisset


                                </ul>
                            </div>
                        </div>
                        <div class="card new-comment clearfix">
                            <div class="card-header">
                                <h4 class="card-title">ارسال نظر</h4>
                            </div>
                            <div class="card-body">
                                <form name="form" id="form" action="{{route('blog.comment')}}" method="post">
                                    <div class="form-group">

                                        @csrf

                                        <input name="blog_id" value="{{$data->id}}" id="blog_id" hidden>
                                        <label>نام <span class="text-danger">*</span></label>
                                        <input required
                                               @if(Auth::check()) value="{{auth()->user()->name.' '.auth()->user()->family}}"
                                               disabled
                                               @endif name="user_id" id="user_id" type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label> ایمیل <span class="text-danger">*</span></label>
                                        <input required @if(Auth::check()) value="{{auth()->user()->email}}"
                                               disabled
                                               @endif  name="email" id="email" type="email"
                                               class="form-control">
                                    </div>


                                    <div class="form-group">
                                        <label> نظر </label>
                                        <textarea required rows="4" name="message" id="message"
                                                  class="form-control"></textarea>
                                    </div>
                                    <div class="submit-section">
                                        <button class="btn btn-primary submit-btn" type="submit">ارسال</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                @include('blog::partials.article_side_bar')

            </div>
        </div>
    </div>

@stop


@section('js')


    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\ArticleCommentValidation', '#form'); !!}



    <script type="text/javascript" src="{{asset('assets_blog/js/jquery-migrate-1.2.1.min.js')}}"></script>
    <script data-cfasync="false"
            src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/slick.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/aos.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/script.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>
    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="b97d855d680359945684ceb5-|49" defer=""></script></body>



    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="942f7db5747e2b6949c592c8-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="942f7db5747e2b6949c592c8-text/javascript"></script>

@stop
