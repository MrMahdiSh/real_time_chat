<div class="profile-sidebar">
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
            <a href="#" class="booking-doc-img">
                <img src="{{Auth::user()->media ? Auth::user()->media->url : asset('assets/img/avatar.jpg')}}"
                     alt="User Image">
            </a>
            <div class="profile-det-info">
                <h3>{{Auth::user()->full_name}}</h3>
                <div class="patient-details">
                    <h5 class="mb-0">{{Auth::user()->specialist}}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                <li
                    class=" {{Request::route()->getName()=='patient.dashboard' ? 'active' : ''}}  ">
                    <a href="{{route('patient.dashboard')}}">
                        <i class="fas fa-columns"></i>
                        <span>داشبورد</span>
                    </a>
                </li>

                <li class=" {{Request::route()->getName()=='patient.profile' ? 'active' : ''}}  ">
                    <a href="{{route('patient.profile')}}">
                        <i class="fas fa-user-cog"></i>
                        <span>تنظیمات پروفایل</span>

                    </a>
                </li>

                <li class=" {{Request::route()->getName()=='patient.reserves' ? 'active' : ''}}  ">
                    <a href="{{route('patient.reserves')}}">
                        <i class="fas fa-calendar-check"></i>
                        <span>نوبت های من</span>

                    </a>
                </li>


                <li class=" {{Request::route()->getName()=='patient.orders' ? 'active' : ''}}  ">
                    <a href="{{route('patient.orders')}}">
                        <i class="fas fa-shopping-basket"></i>
                        <span>(محصول)سفارشات من</span>
                    </a>
                </li>


                <li class=" {{Request::route()->getName()=='patient.service.orders' ? 'active' : ''}}  ">
                    <a href="{{route('patient.service.orders')}}">
                        <i class="fas fa-shopping-basket"></i>
                        <span>نوبت خدمات</span>
                    </a>
                </li>


{{--                <li class=" {{Request::route()->getName()=='patient.factors' ? 'active' : ''}}  ">--}}
{{--                    <a href="{{route('patient.factors')}}">--}}
{{--                        <i class="fas fa-file-invoice"></i>--}}
{{--                        <span>فاکتورهای من</span>--}}
{{--                    </a>--}}
{{--                </li>--}}


                <li class=" {{Request::route()->getName()=='patient.wallet' ? 'active' : ''}}  ">
                    <a href="{{route('patient.wallet')}}">
                        <i class="fas fa-wallet"></i>
                        <span>کیف پول</span>
                    </a>
                </li>


                <li class=" {{Request::route()->getName()=='patient.transaction' ? 'active' : ''}}  ">
                    <a href="{{route('patient.transaction')}}">
                        <i class="fas fa-file"></i>
                        <span>تراکنشات من</span>
                    </a>
                </li>


                <li class=" {{Request::route()->getName()=='patient.reviews' ? 'active' : ''}}  ">
                    <a href="{{route('patient.reviews')}}">
                        <i class="fas fa-comment"></i>
                        <span>نظرات من</span>
                    </a>
                </li>


                <li class=" {{Request::route()->getName()=='patient.chats' ? 'active' : ''}}  ">
                    <a href="{{route('patient.chats')}}">
                        <i class="fas fa-comments"></i>
                        <span>پیام ها</span>
                    </a>
                </li>

                <li class=" {{Request::route()->getName()=='patient.favorite' ? 'active' : ''}}  ">
                    <a href="{{route('patient.favorite')}}">
                        <i class="fas fa-bookmark"></i>
                        <span>پزشک های من</span>
                    </a>
                </li>
                <li class=" {{Request::route()->getName()=='patient.favorite.product' ? 'active' : ''}}  ">
                    <a href="{{route('patient.favorite.product')}}">
                        <i class="fas fa-bookmark"></i>
                        <span>محصولات من</span>
                    </a>
                </li>


                <li class=" {{Request::route()->getName()=='patient.profile.change_password' ? 'active' : ''}}  ">
                    <a href="{{route('patient.profile.change_password')}}">
                        <i class="fas fa-lock"></i>
                        <span>‌تغییر رمز عبور</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('patient.logout')}}">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>خروج</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
