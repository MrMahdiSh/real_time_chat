@extends('blog::layouts.master_index')


@section('title')
    پیام ها
@stop

@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">


    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">


    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

@stop


@section('content')

    @include('blog::partials.patient_breadcrumb',['title'=>'پیام ها'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="chat-window">

                        @include('blog::partials.chat_sidebar',['id'=>isset($id) ?  $id : null])

                        <div class="chat-cont-right" id="chat_page_content">


                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@stop


@section('js')

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\DoctorLoginValidation', '#form'); !!}


    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>


    <script src="{{asset('assets_blog/js/script.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>



    <script src="{{asset('assets_blog/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="e8bd4ced2e01588821be6849-|49" defer=""></script></body>

    <script>

        var g_doc_id = null;
        side_bar_chat();

        function side_bar_chat(search = '', doc_id = null) {

            g_doc_id = doc_id;
            const pat_id = '{{Auth::guard('patient')->check() ? Auth::id() : ''}}';
            const base_url = '{{route('patient.chat.side_bar')}}';
            // let url = `${base_url}`;
            let url = `${base_url}?p_id=${pat_id}&doc_id=${doc_id}&search=${search}`;
            console.log(url);
            $.ajax({
                url: url,
            }).done(function (data) {
                document.getElementById('chat-users-list_content').innerHTML = data;
            });
        }

        @if(isset($doc_id))
        chat_content('{{$doc_id}}');

        @endif

        function chat_content(doc_id) {
            document.getElementById('chat_page_content').innerHTML = null;

            const pat_id = '{{Auth::guard('patient')->check() ? Auth::id() : ''}}';
            const base_url = '{{route('patient.chat.content')}}';
            // let url = `${base_url}`;
            let url = `${base_url}?p_id=${pat_id}&doc_id=${doc_id}`;
            console.log(url)
            $.ajax({
                url: url,
            }).done(function (data) {
                document.getElementById('chat_page_content').innerHTML = data;
            });
        }


    </script>

@stop
