@extends('blog::layouts.master_index')


@section('title')

    تقویم عادت ماهانه
@stop

@section('css')












    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <link rel="stylesheet" href="{{ asset('assets/slim_cropper/css/style.css?v=5.3.1') }}">


    <link rel="stylesheet" href="{{ asset('assets_blog/css/bootstrap.rtl.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_blog/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets_blog/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets_blog/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_blog/plugins/dropzone/dropzone.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets_blog/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('date_assets/css/persianDatepicker-default.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets_blog/fstdropdown/fstdropdown.css') }}">

@stop


@section('content')

    @include('blog::partials.patient_breadcrumb', ['title' => 'یادآوری عادت ماهیانه  '])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    @include('blog::partials.patient_sidebar')

                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="row row-grid">
                        <div class="">
                            <div class="mb-3">
                                <div class="schedule-calendar-col justify-content-start">
                                    <form method="POST" name="form" id="form" method="get"
                                        action="{{ route('patient.profile.perdiodReminderUpdateInfo') }}" class="">

                                        @csrf
                                        <div class="d-flex justify-content-center flex-wrap">
                                            <div class="d-flex">
                                                <span class="input-group-text mb-2"
                                                    style="margin-left: 5px;margin-right: 5px">تاریخ
                                                    آخرین پریودی:</span>
                                                <div class="me-3">
                                                    <input style="width: 110px" type="text"
                                                        class="form-control date mb-2" name="date" id="date"
                                                        required value="{{ @$time }}" min="2021-05-21">
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <span class="input-group-text mb-2"
                                                    style="margin-left: 5px;margin-right: 5px">طول چرخه پریود به روز
                                                    :</span>
                                                <div class="me-3">
                                                    <input placeholder="28" style="width: 90px" type="text"
                                                        class="form-control text-center mb-2 " name="period_days"
                                                        id="period_days" required value="{{ $item->period_days }}">
                                                </div>


                                            </div>
                                            <div class="d-flex">
                                                {{-- <span class="input-group-text mb-2"
                                                    style="margin-left: 5px;margin-right: 5px">طول هر دوره :</span>
                                                <div class="me-3">
                                                    <input style="width: 90px" type="text"
                                                        class="form-control text-center mb-2 " name="each_sycle_length"
                                                        id="each_sycle_length" required value="{{ $item->each_sycle_length }}">
                                                </div> --}}
                                                <div class="search-time-mobile">
                                                    <input style="width: 80px ; height:45px !important;" type="submit"
                                                        name="submit" value="ثبت" class="btn btn-primary h-100">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 border mt-5 rounded ">
                        <div id="next-periods-container">
                            <h5>تاریخ شروع دوره‌های بعدی:</h5>
                            <ul id="next-periods-list">
                                <!-- Dates will be dynamically inserted here -->
                            </ul>
                        </div>
                        <div id="calendar">
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@section('js')
    <script type="text/javascript" src="{{ asset('assets_blog/js/jquery-migrate-1.2.1.min.js') }}"></script>



    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="b97d855d680359945684ceb5-text/javascript"></script>


    <script src="{{asset('assets_blog/js/script.js')}}" type="b97d855d680359945684ceb5-text/javascript"></script>




    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>

    <script src="{{asset('assets_blog/js/circle-progress.min.js')}}"
            type="e8bd4ced2e01588821be6849-text/javascript"></script>

    <script src="{{ asset('assets_blog/cloudflare-static/rocket-loader.min.js') }}"
        data-cf-settings="e8bd4ced2e01588821be6849-|49" defer=""></script>
    </body>







    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>





    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>
    <script src="{{ asset('date_assets/js/persianDatepicker.js') }}"></script>
    <script src="{{asset('assets_blog/js/script.js')}}" type="1cce86bdda76a43346990492-text/javascript"></script>
    <script src="{{ asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js') }}"
        data-cf-settings="1cce86bdda76a43346990492-|49" defer=""></script>
    </body>




    <script>
        // Convert Persian date to JavaScript Date object
        $(document).ready(function() {
            $(".date").persianDatepicker();

            var lastPeriodDate = @json($item->period_at);
            var periodDays = @json($item->period_days);
            var cycleDaysCount = 5;
            if (lastPeriodDate === null) {
                $('#calendar').html('<br/> برای مشاهده تاریخ‌های پریودی  تاریخ آخرین عادت ماهیانه و تعداد سیکل را وارد کنید.'+'<br/><br/><br/>');
                return 0;
            }

            // Parse the last period date
            var lastDate = new Date(lastPeriodDate);

            // Calculate the next 3 periods
            var nextPeriods = [];
            for (var i = 1; i <= 3; i++) {
                var nextDate = new Date(lastDate);
                nextDate.setDate(lastDate.getDate() + (periodDays * i));
                nextPeriods.push(nextDate.toISOString().split('T')[0]);
            }

            // Display the dates
            var listContainer = document.getElementById('next-periods-list');
            nextPeriods.forEach(function(date) {
                var listItem = document.createElement('li');
                var jalaliDate = convertToJalali(date);
                listItem.textContent = jalaliDate;
                listContainer.appendChild(listItem);
            });
        });
    </script>







    <script>
        // Function to convert Gregorian date to Julian Day Number
        // Function to convert a specific Gregorian date string to a Jalali date string
        // Function to convert Persian numbers to English numbers
        function convertPersianToEnglishNumbers(persianString) {
            const persianDigits = '۰۱۲۳۴۵۶۷۸۹';
            const englishDigits = '0123456789';
            let englishString = '';

            for (let char of persianString) {
                const index = persianDigits.indexOf(char);
                englishString += index === -1 ? char : englishDigits[index];
            }

            return englishString;
        }

        // Function to convert a specific Gregorian date string to a Jalali date string with English numbers
        function convertToJalali(dateIn) {
            // Split the input date string into year, month, and day
            const [year, month, day] = dateIn.split('-').map(Number);

            // Create a Date object with the input date
            const date = new Date(year, month - 1, day);

            // Format the date using Persian locale
            const options = {
                year: 'numeric',
                month: 'numeric',
                day: 'numeric'
            };
            const jalaliDate = date.toLocaleDateString('fa-IR', options);
            console.log(jalaliDate);
            return jalaliDate;

            // Convert the Jalali date from Persian to English numerals
            const jalaliDateEnglish = convertPersianToEnglishNumbers(jalaliDate);

            return jalaliDateEnglish;
        }

        // Example usage
        // const dateIn = '2024-08-29';
        // const jalaliDate = convertToJalali(dateIn);
        // console.log(jalaliDate); // Outputs the Jalali date with English numerals
    </script>
@stop
