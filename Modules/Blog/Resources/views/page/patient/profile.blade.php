@extends('blog::layouts.master_index')


@section('title')
    تنظیمات پروفایل
@stop

@section('css')

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">



    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/select2/css/select2.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/dropzone/dropzone.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('date_assets/css/persianDatepicker-default.css')}}"/>

    <link rel="stylesheet" href="{{asset('assets_blog/fstdropdown/fstdropdown.css')}}">
    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">

@stop


@section('content')

    @include('blog::partials.patient_breadcrumb',['title'=>'تنظیمات پروفایل'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                    @include('blog::partials.patient_sidebar')

                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">

                    <form method="post" name="form" id="form" action="{{route('patient.profile.post')}}"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> اطلاعات پایه</h4>
                                <div class="row form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="change-avatar">
                                                @include('partials.single_upload_image',[
                                                                                                                                                  'title'=>null,
                                                                                                                                                  'ratio'=>'2:2',
                                                                                                                                                  'size'=>'510,600',
                                                                                                                                                  'image'=>$data->media ? $data->media : null,
                                                                                                                                                  'name'=>'image',
                                                                                                                                                  ])
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>نام<span class="text-danger">*</span></label>
                                            <input name="name" id="name" value="{{$data->name}}" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> نام خانوادگی <span class="text-danger">*</span></label>
                                            <input name="family" id="family" value="{{$data->family}}" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>شماره تماس</label>
                                            <input maxlength="12" name="mobile" id="mobile" value="{{$data->mobile}}"
                                                   minlength="11" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>گروه خونی</label>
                                            <select name="blood" id="blood" class="form-select form-control">
                                                <option {{$data->blood=='O+' ? 'selected' : ''}} value="O+">O+
                                                </option>
                                                <option {{$data->blood=='O-' ? 'selected' : ''}} value="O-">O-
                                                </option>


                                                <option {{$data->blood=='A+' ? 'selected' : ''}} value="A+">A+
                                                </option>
                                                <option {{$data->blood=='A-' ? 'selected' : ''}} value="A-">A-
                                                </option>


                                                <option {{$data->blood=='B+' ? 'selected' : ''}} value="B+">B+
                                                </option>
                                                <option {{$data->blood=='B-' ? 'selected' : ''}} value="B-">B-
                                                </option>


                                                <option {{$data->blood=='AB+' ? 'selected' : ''}} value="AB+">AB+
                                                </option>
                                                <option {{$data->blood=='AB-' ? 'selected' : ''}} value="AB-">
                                                    <AB></AB>
                                                    -
                                                </option>


                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label>تاریخ تولد</label>
                                            <input name="birth_day" id="birth_day" value="{{$data->fa_birth_day}}"
                                                   type="text" class="form-control date">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">استان</label>
                                            <select name="state_id"
                                                    class="fstdropdown-select form-control selected"
                                                    id="state_id">
                                                <option value="">استان خود را انتخاب نمایید</option>
                                                @foreach($states as $item)
                                                    <option
                                                        {{(int)$data->state_id==(int)$item->id ? 'selected' : ''}}
                                                        value="{{$item->id}}">{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">شهر</label>
                                            <select name="city_id"
                                                    class=" form-control city_id"
                                                    id="city_id">
                                                <option>شهر خود را انتخاب کنید</option>

                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-body">
                                <h4 class="card-title">نشانی</h4>
                                <div class="form-group mb-0">
                                    <label>آدرس</label>
                                    <textarea name="address" id="address" class="form-control"
                                              rows="5">{!! $data->address !!}</textarea>
                                </div>
                            </div>


                        </div>
                        <div class="submit-section submit-btn-bottom">
                            <button type="submit" class="btn btn-primary submit-btn">ذخیره تغییرات</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

@stop


@section('js')

    <script type="text/javascript" src="{{asset('assets_blog/js/jquery-migrate-1.2.1.min.js')}}"></script>



    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\DoctorProfileValidation', '#form'); !!}


    <script src="{{asset('assets/slim_cropper/js/require.js')}}"
            data-main="{{asset('assets/slim_cropper/js/main.min')}}"></script>

    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>
    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/plugins/select2/js/select2.min.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/plugins/dropzone/dropzone.min.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/js/profile-settings.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/js/script.js')}}" type="1cce86bdda76a43346990492-text/javascript"></script>
    <script src="{{asset('assets_blog/scripts/cloudflare-static/rocket-loader.min.js')}}"
            data-cf-settings="1cce86bdda76a43346990492-|49" defer=""></script></body>

    <script src="{{asset('assets_blog/fstdropdown/fstdropdown.js')}}"></script>

    <script src="{{asset('date_assets/js/persianDatepicker.js')}}"></script>


    <script>
        $("#state_id").change(function () {

            set_city()

        });
        set_city('{{$data->city_id}}')

        function set_city(city_id) {

            let option = $('#state_id').val()

            $("#city_id").find('option').remove().end();
            $("#city_id").append(new Option('انتخاب کنید', ''));

            $.ajax({
                url: `{{url('api/get_cities')}}/${option}`,
            }).done(function (data) {
                if (data != 'no parametr')
                    $.each(data, function (index, value) {

                        text = city_id == value.id ? 'selected' : '';

                        $('#city_id').append(`<option ${text}  value="${value.id}">
                                       ${value.title}
                                  </option>`);

                    });

            });
        }

    </script>

    <script>
        $(".date").persianDatepicker();

    </script>
@stop
