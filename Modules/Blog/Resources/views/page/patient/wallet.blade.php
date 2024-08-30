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
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="account-card bg-success-light">
                                                <span>{{number_format((int)$data,null)}}
                                                    تومان</span> موجودی
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <div class="row">
                                        <form action="{{route('patient.wallet.charge')}}" name="form" id="form" method="get">

                                            <p class="alert alert-info">
                                                شارژ کیف پول
                                            </p>
                                            @csrf
                                            <div class="form-group">
                                                <label>مبلغ مورد نظر خود را وارد نمایید(تومان)<span
                                                        class="text-danger">*</span></label>
                                                <input onkeyup="NumberSeprator(this)" type="text" id="price"
                                                       class="form-control"
                                                       name="price">
                                            </div>


                                            <div class="row">

                                                @isset($prices)

                                                    @foreach($prices as $item )

                                                        <p onclick="SetPrice('{{$item}}')" style="cursor: pointer"
                                                           class="col-2 p-2 m-1 border rounded">
                                                            {{number_format((int)$item,null)}}تومان</p>
                                                    @endforeach

                                                @endisset
                                            </div>

                                            <br>
                                            <div class="col-md-12 text-center">
                                                <button
                                                    class="btn btn-primary request_btn"
                                                    data-bs-toggle="modal"> انتقال به درگاه پرداخت
                                                </button>
                                            </div>


                                        </form>
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
