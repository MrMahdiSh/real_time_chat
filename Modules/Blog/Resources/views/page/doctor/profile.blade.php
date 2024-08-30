@extends('blog::layouts.master_index')


@section('title')
    تنظیمات پروفایل
@stop

@section('css')

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <link rel="stylesheet" href="{{asset('assets/slim_cropper/css/style.css?v=5.3.1')}}">


    <link rel="stylesheet" href="{{asset('assets_blog/css/bootstrap.rtl.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/select2/css/select2.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/plugins/dropzone/dropzone.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets_blog/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('date_assets/css/persianDatepicker-default.css')}}"/>

    <link rel="stylesheet" href="{{asset('assets_blog/fstdropdown/fstdropdown.css')}}">
    <link rel="stylesheet" href="{{asset('assets_blog/leaflet/leaflet.css')}}"
    />
    <script src="{{asset('assets_blog/leaflet/leaflet.js')}}"></script>


@stop


@section('content')

    @include('blog::partials.doctor_breadcrumb',['title'=>'تنظیمات پروفایل'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                    @include('blog::partials.doctor_sidebar')

                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">

                    <form method="post" name="form" id="form" action="{{route('doctor.profile.post')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <input name="step" id="step" value="1" hidden>

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
                                            <label>نام کاربری<span class="text-danger">*</span></label>
                                            <input value="{{Auth::user()->username}}" type="text" class="form-control"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ایمیل<span class="text-danger">*</span></label>
                                            <input value="{{$data->email}}" name="email" id="email" type="email"
                                                   class="form-control">
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
                                            <label>جنسیت</label>
                                            <select name="gender" id="gender" class="form-select form-control">
                                                <option {{$data->gender=='male' ? 'selected' : ''}} value="male">مرد
                                                </option>
                                                <option {{$data->gender=='female' ? 'selected' : ''}} value="female">زن
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


                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label>کد نظام پزشکی</label>
                                            <input name="medical_system_code" id="medical_system_code"
                                                   value="{{$data->medical_system_code}}"
                                                   type="text" class="form-control  ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">محل تحصیل</h4>
                                <div class="row form-row">


                                    <div class="col-md-12">
                                        <div class="form-group"><select name="category_id"
                                                                        class="fstdropdown-select form-control"
                                                                        id="category_id">

                                                @foreach($categories as $item)
                                                    <option
                                                        {{(int)$data->category_id==$item->id ? 'selected' : ''}} value="{{$item->id}}">{{"$item->title "}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="card-body">
                                <h4 class="card-title"> درباره من </h4>
                                <div class="form-group mb-0">
                                    <label>بیوگرافی</label>
                                    <textarea name="about_me" id="about_me" class="form-control"
                                              rows="5">{!! $data->about_me !!}</textarea>
                                </div>
                            </div>


                        </div>


                        @csrf

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">اطلاعات کلینیک</h4>
                                <div class="row form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>آدرس </label>
                                            <input value="{{$data->contact ? $data->contact->address_1 : ''}}"
                                                   name="address_1" id="address_1" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">شماره تماس اول</label>
                                            <input value="{{$data->contact ? $data->contact->phone_1 : ''}}"
                                                   name="phone_1" id="phone_1" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">شماره تماس دوم</label>
                                            <input value="{{$data->contact ? $data->contact->phone_2 : ''}}"
                                                   name="phone_2" id="phone_2" type="text" class="form-control">
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
                                                        @if($data->contact)
                                                        {{(int)$data->contact->state_id==(int)$item->id ? 'selected' : ''}}
                                                        @endif
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
                                    <input hidden name="lang_map" id="lang_map"/>
                                    <input hidden name="lat_map" id="lat_map"/>
                                    <div id="map" style="width: 100%;height: 350px "
                                         class="col-12 col-sm-12">
                                    </div>

                                </div>
                            </div>

                        </div>


                        @csrf




                        @csrf


                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> تحصیلات </h4>
                                <div class="education-info">
                                    <div class="row form-row education-cont">
                                        <div class="col-12 col-md-10 col-lg-11">

                                            @if( $data->education()->first())
                                                @foreach($data->get_education->edu_title    as $key=>$item)
                                                    @if(!empty($item))
                                                        <div class="row form-row education-cont">
                                                            <div class="col-12 col-md-6 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>مدرک</label>
                                                                    <input name="edu_title[]" id="edu_title" type="text"
                                                                           value="{{$item}}"
                                                                           class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>دانشگاه/موسسه</label>
                                                                    <input name="edu_university[]" id="edu_university"
                                                                           type="text"
                                                                           value="{{$data->get_education->edu_university[$key] ? $data->get_education->edu_university[$key] : ''}}"
                                                                           class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>سال اتمام</label>
                                                                    <input name="edu_date[]" id="edu_date"
                                                                           placeholder="مثال : 1401"
                                                                           type="text"
                                                                           value="{{$data->get_education->edu_date[$key] ? $data->get_education->edu_date[$key] : ''}}"
                                                                           class="form-control ">
                                                                </div>

                                                            </div>

                                                            <div class="col-12 col-md-2 col-lg-1"><label
                                                                    class="d-md-block d-sm-none d-none">&nbsp;</label><a
                                                                    href="#" class="btn btn-danger trash"><i
                                                                        class="far fa-trash-alt"></i></a></div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                            <hr>

                                            <div class="row form-row">
                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label>مدرک</label>
                                                        <input name="edu_title[]" id="edu_title" type="text"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label>دانشگاه/موسسه</label>
                                                        <input name="edu_university[]" id="edu_university"
                                                               type="text"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label>سال اتمام</label>
                                                        <input name="edu_date[]" id="edu_date" placeholder="مثال : 1401"
                                                               type="text"
                                                               class="form-control ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-more">
                                    <a href="javascript:void(0);" class="add-education"><i
                                            class="fa fa-plus-circle"></i>
                                        افزودن</a>
                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">تجربیات کاری</h4>
                                <div class="experience-info">
                                    @if( $data->exprience()->first())
                                        @foreach($data->get_experience->ex_title    as $key=>$item)
                                            @if(!empty($item))
                                                <div class="row form-row experience-cont">
                                                    <div class="col-12 col-md-10 col-lg-11">


                                                        <div class="row form-row">
                                                            <div class="col-12 col-md-6 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>نام بیمارستان</label>
                                                                    <input name="ex_title[]" id="ex_title" type="text"
                                                                           value="{{$item}}" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>از</label>
                                                                    <input name="ex_from[]" id="ex_from"
                                                                           placeholder="مثال : 1399"
                                                                           value="{{$data->get_experience->ex_from[$key]}}"
                                                                           type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-3">
                                                                <div class="form-group">
                                                                    <label>تا</label>
                                                                    <input name="ex_to[]" id="ex_to"
                                                                           value="{{$data->get_experience->ex_to[$key]}}"
                                                                           placeholder="مثال : 1401"
                                                                           type="text"
                                                                           class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6 col-lg-3">
                                                                <div class="form-group">
                                                                    <label> نقش</label>
                                                                    <input name="ex_role[]" id="ex_role" type="text"
                                                                           value="{{$data->get_experience->ex_role[$key]}}"
                                                                           class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-2 col-lg-1"><label
                                                            class="d-md-block d-sm-none d-none">&nbsp;</label><a
                                                            href="#" class="btn btn-danger trash"><i
                                                                class="far fa-trash-alt"></i></a></div>

                                                </div>

                                            @endif
                                        @endforeach
                                    @endif
                                    <hr>


                                    <div class="row form-row experience-cont">
                                        <div class="col-12 col-md-10 col-lg-11">


                                            <div class="row form-row">
                                                <div class="col-12 col-md-6 col-lg-3">
                                                    <div class="form-group">
                                                        <label>نام بیمارستان</label>
                                                        <input name="ex_title[]" id="ex_title" type="text"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-3">
                                                    <div class="form-group">
                                                        <label>از</label>
                                                        <input name="ex_from[]" id="ex_from"
                                                               placeholder="مثال : 1399"
                                                               type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-3">
                                                    <div class="form-group">
                                                        <label>تا</label>
                                                        <input name="ex_to[]" id="ex_to"
                                                               placeholder="مثال : 1401"
                                                               type="text"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-3">
                                                    <div class="form-group">
                                                        <label> نقش</label>
                                                        <input name="ex_role[]" id="ex_role" type="text"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-more">
                                    <a href="javascript:void(0);" class="add-experience"><i
                                            class="fa fa-plus-circle"></i>
                                        افزودن</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">جوایز/دریافتی ها</h4>
                                <div class="awards-info">

                                    @if( $data->reward()->first())
                                        @foreach($data->get_reward->rew_title    as $key=>$item)
                                            @if(!empty($item))

                                                <div class="row form-row awards-cont">
                                                    <div class="col-12 col-md-5">
                                                        <div class="form-group">
                                                            <label>عنوان</label>
                                                            <input name="rew_title[]" id="rew_title" type="text"
                                                                   value="{{$item}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-5">
                                                        <div class="form-group">
                                                            <label>سال</label>
                                                            <input name="rew_date[]" id="rew_date" type="text"
                                                                   value="{{$data->get_reward->rew_date[$key]}}"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-2 col-lg-1"><label
                                                            class="d-md-block d-sm-none d-none">&nbsp;</label><a
                                                            href="#" class="btn btn-danger trash"><i
                                                                class="far fa-trash-alt"></i></a></div>
                                                </div>

                                            @endif
                                        @endforeach
                                    @endif
                                    <hr>


                                    <div class="row form-row awards-cont">
                                        <div class="col-12 col-md-5">
                                            <div class="form-group">
                                                <label>عنوان</label>
                                                <input name="rew_title[]" id="rew_title" type="text"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-5">
                                            <div class="form-group">
                                                <label>سال</label>
                                                <input name="rew_date[]" id="rew_date" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-more">
                                    <a href="javascript:void(0);" class="add-award"><i class="fa fa-plus-circle"></i>
                                        افزودن</a>
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
    {!! JsValidator::formRequest('Modules\Blog\Http\Requests\DoctorProfile2Validation', '#form2'); !!}


    <script data-cfasync="false" src="{{asset('assets_blog/scripts/cloudflare-static/email-decode.min.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/js/bootstrap.bundle.min.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/ResizeSensor.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>


    <script src="{{asset('assets_blog/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}"
            type="1cce86bdda76a43346990492-text/javascript"></script>

    <script src="{{asset('assets/slim_cropper/js/require.js')}}"
            data-main="{{asset('assets/slim_cropper/js/main.min')}}"></script>



    <script src="{{asset('assets_blog/plugins/select2/js/select2.min.js')}}"
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
        @if($data->contact)
        set_city('{{$data->contact->city_id}}')

        @endif

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
    <script src="{{asset('assets_blog/js/custom_leaftLeatMap.js')}}"
    ></script>
    <script>


        @if(!empty($data->contact->lat_map))
            map = new Custom_leaftLeatMap();
        map.ShowMap('{{$data->contact->lat_map}}', '{{$data->contact->lang_map}}');
        @endif
    </script>
@stop
