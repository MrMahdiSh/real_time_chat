<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>ارتباط با پزشکان</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/css/feather.css')}}">
    <style>

        .card span {
            font-family: 'Vazir' !important
        }
    </style>
    @include('partials.dashboard_css')
    @yield('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static chat-application "
      data-open="click"
      data-menu="vertical-menu-modern" data-col="2-columns">
@include('partials.dashboard_header')


@include('partials.sidebar')
@yield('menu')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-area-wrapper">
        <div class="sidebar-left">
            <div class="sidebar">

                <!-- Chat Sidebar area -->
                <div class="sidebar-content card">
                        <span class="sidebar-close-icon">
                            <i class="feather icon-x"></i>
                        </span>
                    <div class="chat-fixed-search">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-profile-toggle position-relative d-inline-flex">

                                <div class="bullet-success bullet-sm position-absolute"></div>
                            </div>
                            <fieldset class="form-group position-relative has-icon-left mx-1 my-0 w-100">
                                <input type="text" class="form-control round" id="chat-search"
                                       placeholder="جست و جو کنید - چت تازه ای شروع کنید">
                                <div class="form-control-position">
                                    <i class="feather "></i>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div id="users-list" class="chat-user-list list-group position-relative">

                        @isset($categories)


                            @foreach($categories as $val)
                                @if(count($val->doctors) >0)
                                    <h3 class="primary p-1 mb-0">{{$val->title}}</h3>


                                    <ul class="chat-users-list-wrapper media-list">

                                        @foreach($val->doctors as $item)
                                            <li
                                                class="@if(Session::has('doc_id')){{$item->id==Session::get('doc_id') ? 'active' : ''}}@endif"

                                                onclick="chat_content('{{$item->id}}')">
                                                <div class="pr-1">
                                        <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle"
                                                                                src="{{$item->media ? $item->media->url : asset('assets/img/avatar_male.jpg')}}"
                                                                                height="42" width="42"
                                                                                alt="{{$item->full_name}}">
                                            <i></i>
                                        </span>
                                                </div>
                                                <div class="user-chat-info">
                                                    <div class="contact-info">
                                                        <h5 class="font-weight-bold mb-0">{{$item->full_name}}</h5>
                                                        <p class="truncate">{!! $item->ticket ? $item->ticket->text : 'برای شروع گفت و گو کلیک کنید' !!}</p>
                                                    </div>
                                                    <div class="contact-meta">
                                                        <span class="float-right mb-25">{{$item->fa_date_ticket}}</span>
                                                        <span
                                                            class="badge badge-primary badge-pill float-right">{{$item->tickets ? $item->tickets->where('seen_admin',1)->count() : '0'}}</span>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach


                                    </ul>
                                @endif
                            @endforeach

                        @endisset


                    </div>
                </div>
                <!--/ Chat Sidebar area -->

            </div>
        </div>
        <div class="content-right">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="chat-overlay"></div>
                    <section class="chat-app-window">
                        <div class="start-chat-area    {{Session::has('doc_id') ? 'd-none' : ''}} ">
                            <span class="mb-1 start-chat-icon feather icon-message-square"></span>
                            <h4 class="py-50 px-1 sidebar-toggle start-chat-text">شروع گفت و گو</h4>
                        </div>

                        <div class="chat_content" id="chat_content">


                        </div>

                    </section>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>


@include('partials.footer')


@include('partials.dashboard_js')
@yield('js')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('Modules\Ticket\Http\Requests\TicketValidation', '#form'); !!}

<script>


    // // autoscroll to bottom of Chat area
    //
    // $(".chat-users-list-wrapper li").on("click", function () {
    //
    //
    // });
    var chatContainer = document.getElementById('chat_content');

    function chat_content(doc_id) {
        chatContainer.innerHTML = null;


        const base_url = '{{route('Ticket.chat.content')}}';
        // let url = `${base_url}`;
        let url = `${base_url}?doc_id=${doc_id}`;
        console.log(url)
        $.ajax({
            url: url,
        }).done(function (data) {
            chatContainer.innerHTML = data;

            chatContainer.animate({scrollTop: chatContainer[0].scrollHeight}, 400)
        });
    }


    @if(Session::has('doc_id'))
    chat_content('{{Session::get('doc_id')}}');
    @endif
</script>
</body>
<!-- END: Body-->

</html>
