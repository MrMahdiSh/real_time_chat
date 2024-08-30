@extends('blog::layouts.master_index')


@section('title')
    صورتحساب
@stop

@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">


    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">


    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

@stop


@section('content')

    @include('blog::partials.patient_breadcrumb',['title'=>'صورتحساب '])

    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-8 offset-lg-2">

                    <div class="other-info">
                        <td class="text-end">
                            <div class="table-action">
                                @if($data->status==\App\OrderStatus::Paid)
                                    <a href="#" onclick="PrintElem()"
                                       class="btn btn-sm bg-primary-light">
                                        <i class="fas fa-print"></i> پرینت
                                    </a>
                                @endif

                                @if($data->status==\App\OrderStatus::Unpaid || $data->status=='')
                                    <a href="{{route('patient.service.payment.factor',['id'=>$data->id])}}"
                                       class="btn btn-sm bg-warning">
                                        <i class="far fa-money-bill-alt "></i> پرداخت
                                    </a>
                                @endif
                                @if($data->status==\App\OrderStatus::Unpaid || $data->status=='')
                                    <a href="{{route('patient.service.payment.wallet',['id'=>$data->id])}}"
                                       class="btn btn-sm bg-warning">
                                        <i class="fa fa-wallet "></i> پرداخت با کیف پول
                                    </a>
                                @endif


                            </div>
                        </td>
                        <div class="invoice-content"
                             style="border: 1px grey solid;border-radius: 20px;background-color:whitesmoke"
                             id="factor_cont">
                            <div class="invoice-item">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="invoice-logo">
                                            <img src="{{$setting->logo ? $setting->logo->url :  ''}}" alt="logo">
                                        </div>
                                    </div>


                                    @if($data->status==\App\OrderStatus::Paid)

                                        <div class="col-md-6">
                                            <p class="invoice-logo alert alert-primary">

                                                <strong class=""> تاریخ ثبت شده نوبت
                                                    : </strong> {{$data->res_date}}
                                            </p>
                                        </div>
                                    @elseif($data->status==\App\OrderStatus::Unpaid || $data->status=='')
                                        <div class="col-md-6">
                                            <div class="invoice-logo">
                                                <h5 class="alert  text-danger text-center bold btn-outline-danger bg-light">
                                                    در انتظار پرداخت</h5>
                                            </div>
                                        </div>

                                    @endif


                                    <hr>
                                    <div class="col-md-6">
                                        <p class="invoice-logo">
                                            <strong>عنوان:</strong> #{{$data->service? $data->service->title : ''}}
                                            / {{isset($data->service->category) ? $data->service->category->title : ''}}
                                            <br>
                                            <strong> صادر شده: </strong> {{$data->fa_created_at}}
                                        </p>
                                    </div>


                                    <br>
                                    <div class="col-md-6">
                                        <p class="invoice-logo">
                                            <strong>بیمار/مراجعه کننده
                                                : </strong> {{$data->patient ? $data->patient->full_name : ''}} <br>
                                            <strong>آدرس :</strong> {{$data->patient ? $data->patient->address : ''}}
                                        </p>
                                    </div>
                                </div>
                            </div>


                            @if($data->doctor)
                                <div class="invoice-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="invoice-info">
                                                <strong class="customer-text"> پزشک مربوطه </strong>
                                                <p class="invoice-details invoice-details-two">
                                                    {{$data->doctor->full_name}}
                                                    / {{ $data->doctor->category ? $data->doctor->category->title : '' }}
                                                    <br>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="invoice-item invoice-table-wrap">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="invoice-table table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th class="text-center"> توضیحات</th>
                                                    <th class="text-center">تعداد</th>

                                                    <th class="text-center">کل</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td class="text-center">رزرو خدمات</td>
                                                    <td class="text-center">1</td>


                                                    <td class="text-center">{{number_format($data->last_price,null)}}
                                                        تومان
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-4 ms-auto">
                                        <div class="table-responsive">
                                            <table class="invoice-table-two table">
                                                <tbody>

                                                <tr>
                                                    <th>مبلغ کل:</th>
                                                    <td><span> {{number_format($data->last_price,null)}} تومان</span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            @if($data->setting_pay  )
                                <h4> سایر اطلاعات </h4>
                                <p class="text-muted mb-0">{{$data->setting_pay->factor_description}}</p>
                                @if($data->status==\App\OrderStatus::Paid)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="invoice-logo">
                                                <img width="150" height="150"
                                                     src="{{$data->setting_pay->media ? $data->setting_pay->media->url :  ''}}"
                                                     alt="{{$data->doctor ?  $data->doctor->full_name : ''}}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="invoice-logo">
                                                <h5 class="alert  text-success text-center bg-light bold btn-outline-success">
                                                    پرداخت شد</h5>
                                            </div>
                                        </div>
                                    </div>

                                @endif

                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@section('js')
    <script type="text/javascript" src="{{asset('assets_blog/js/jquery-migrate-1.2.1.min.js')}}"></script>



    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/script.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>


    <script src="{{asset('assets_blog/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="e8bd4ced2e01588821be6849-|49" defer=""></script></body>
    <script>

        function PrintElem() {
            // $("#factor_cont").show();
            // window.print();

            var printContents = document.getElementById('factor_cont').outerHTML;
            window.document.body.innerHTML = printContents;
            window.print();
            location.reload();
        }
    </script>
@stop
