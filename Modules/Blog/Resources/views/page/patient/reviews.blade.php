@extends('blog::layouts.master_index')


@section('title')

@stop

@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">


    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/select2/css/select2.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">


@stop


@section('content')

    @include('blog::partials.doctor_breadcrumb',['title'=>'کیف پول'])


    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    @include('blog::partials.patient_sidebar')
                </div>


                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="doc-review review-listing">

                        <ul class="comments-list">

                            @isset($data['DoctorRates'])


                                @foreach($data['DoctorRates'] as $item)
                                    @component('blog::componets.reviews',['item'=>$item])
                                    @endcomponent
                                @endforeach
                            @endisset

                        </ul>

                    </div>
                </div>


            </div>
        </div>
    </div>



@stop


@section('js')
    <script type="text/javascript" src="{{asset('assets_blog/js/jquery-migrate-1.2.1.min.js')}}"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\WalletValidation', '#form'); !!}


    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>


    <script src="{{asset('assets_blog/plugins/select2/js/select2.min.js')}}"
            type="f3ba515de7ef394e4a6d11c0-text/javascript"></script>


    <script src="{{asset('assets_blog/js/script.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="e8bd4ced2e01588821be6849-|49" defer=""></script></body>

    <script>

        function SetPrice(price) {

            document.getElementById('price').value = price;
        }

    </script>
    <script>
        function NumberSeprator(_obj) {

            console.log(_obj)
            console.log(_obj.value)


            var num = getNumber(_obj.value);

            if (num == 0) {
                _obj.value;
            } else {
                _obj.value = num.toLocaleString();
            }
        }


        function getNumber(_str) {
            var arr = _str.split('');
            var out = new Array();
            for (var cnt = 0; cnt < arr.length; cnt++) {
                if (isNaN(arr[cnt]) == false) {
                    out.push(arr[cnt]);
                }
            }
            return Number(out.join(''));
        }

    </script>
@stop
