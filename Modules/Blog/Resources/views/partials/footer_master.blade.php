<footer class="footer d-none d-md-block">

    <div class="footer-top aos">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6">

                    <div class="footer-widget footer-about">
                        <div class="footer-logo">
                            <img style="border-radius: 10px" width="200" height="50" src="{{$setting->logo  ? $setting->logo->url  : ''}}" alt="{{$setting->site_name}}">
                        </div>
                        <div class="footer-about-content">
                            <p>{{$setting->footer_text}}</p>
                            <div class="social-icon">
                                <ul>
                                    @if(!empty($setting->telegram_link))
                                        <li>
                                            <a href="{{$setting->telegram_link}}" target="_blank"><i
                                                    class="fab fa-telegram"></i> </a>
                                        </li>

                                    @endif
                                    @if(!empty($setting->insta_link))
                                        <li>
                                            <a href="{{$setting->insta_link}}" target="_blank"><i
                                                    class="fab fa-instagram"></i> </a>
                                        </li>

                                    @endif
                                    @if(!empty($setting->linkedin_link))

                                        <li>
                                            <a href="{{$setting->linkedin_link}}" target="_blank"><i
                                                    class="fab fa-linkedin-in"></i></a>
                                        </li>
                                    @endif


                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-2 col-md-6">

                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">برای بیماران</h2>
                        <ul>
                            <li><a href="{{route('doctor.search')}}">جستجو پزشک</a></li>
                            <li><a href="{{route('patient.login')}}">‌ورود</a></li>
                            <li><a href="{{route('patient.register')}}">‌ثبت‌نام</a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-2 col-md-6">

                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">برای پزشکان</h2>
                        <ul>
                            <li><a href="{{route('doctor.login')}}">‌ورود</a></li>
                            <li><a href="{{route('doctor.register')}}">‌ثبت‌نام</a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-2 col-md-6">

                    <div class="footer-widget footer-menu">
                        <h2 class="footer-title">دسترسی سریع</h2>
                        <ul>
                            <li><a href="{{route('about_us')}}">درباره ما</a></li>
                            <li><a href="{{route('contact_us')}}">تماس با ما</a></li>
                            <li><a href="{{route('faq')}}">سوالات متداول</a></li>
                            @isset($links)

                                @foreach($links->where('type','bottom') as $item)
                                    <li><a href="{{$item->url}}">{{$item->title}}</a></li>
                                @endforeach
                            @endisset

                        </ul>
                    </div>

                </div>
                <div class="col-lg-3 col-md-6">

                    <div class="footer-widget footer-contact">
                        <h2 class="footer-title">‌تماس با ما</h2>
                        <div class="footer-contact-info">
                            <div class="footer-address">
                                <span><i class="fas fa-map-marker-alt"></i></span>
                                <p>{{$setting->address}}</p>
                            </div>
                            <p>
                                <i class="fas fa-phone-alt"></i>
                                {{$setting->phone}}
                            </p>
                            <p class="mb-0 text-white">
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:{{$setting->email}}"
                                   class="text-white">{{$setting->email}}</a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="footer-bottom">
        <div class="container-fluid">

            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="copyright-text text-white">
                        تمامی حقوق متعلق به مرکز درمان‌های ابن سینا می‌باشد.
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">

                        <div class="copyright-menu">
                            <ul class="policy-menu">
                                <li><a href="{{route('policy')}}"> شرایط و ضوابط </a></li>
                                <li><a href="{{route('privacy')}}">حریم خصوصی </a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</footer>

