<div class="profile-sidebar">
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">

            @if (Auth::user()->media)
                <a href="#" class="booking-doc-img">
                    <img src="{{ Auth::user()->media ? Auth::user()->media->url : '' }}" alt="">
                </a>
            @endif
            <div class="profile-det-info">
                <h3>{{ Auth::user()->full_name }}</h3>
                <div class="patient-details">
                    <h5 class="mb-0">{{ Auth::user()->specialist }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                <li class=" {{ Request::route()->getName() == 'doctor.dashboard' ? 'active' : '' }}  ">
                    <a href="{{ route('doctor.dashboard') }}">
                        <i class="fas fa-columns"></i>
                        <span>داشبورد</span>
                    </a>
                </li>

                <li class=" {{ Request::route()->getName() == 'doctor.profile' ? 'active' : '' }}  ">
                    <a href="{{ route('doctor.profile') }}">
                        <i class="fas fa-user-cog"></i>
                        <span>تنظیمات پروفایل</span>
                        @if (Auth::user()->complete_account == 0)
                            <small class="unread-msg">ناقص</small>
                        @endif
                    </a>
                </li>


                <li class=" {{ Request::route()->getName() == 'doctor.avatar' ? 'active' : '' }}  ">
                    <a href="{{ route('doctor.avatar') }}">
                        <i class="fas fa-user-cog"></i>
                        <span>تغییر تصویر پروفایل</span>

                    </a>
                </li>

                <li class="{{ Request::route()->getName() == 'doctor.appointments' ? 'active' : '' }}">
                    <a href="{{ route('doctor.appointments') }}">
                        <i class="fas fa-calendar-check"></i>
                        <span>نوبت‌دهی</span>
                    </a>
                </li>
                <li class="{{ Request::route()->getName() == 'doctor.patients' ? 'active' : '' }}">

                    <a href="{{ route('doctor.patients') }}">
                        <i class="fas fa-user-injured"></i>
                        <span>مراجعه‌کنندگان من</span>
                    </a>
                </li>

                <li class=" {{ Request::route()->getName() == 'doctor.setting' ? 'active' : '' }}  ">
                    <a href="{{ route('doctor.setting') }}">
                        <i class="fas fa-cog"></i>
                        <span>تنظیمات من</span>
                    </a>
                </li>


                <li class=" {{ Request::route()->getName() == 'doctor.schedule_time' ? 'active' : '' }}  ">
                    <a href="{{ route('doctor.schedule_time') }}">
                        <i class="fas fa-hourglass-start"></i>
                        <span>زمان‌بندی</span>
                    </a>
                </li>

                @if (session('backToAdminSession'))
                    <li class=" {{ Request::route()->getName() == 'doctor.reserved_time' ? 'active' : '' }}  ">
                        <a href="{{ route('doctor.reserved_time') }}">
                            <i class="fas fa-clock"></i>
                            <span class="text-danger">نوبت دهی (رزرو)</span>
                        </a>
                    </li>
                @endif


                <li class=" {{ Request::route()->getName() == 'doctor.transactions' ? 'active' : '' }}  ">
                    <a href="{{ route('doctor.transactions') }}">
                        <i class="fas fa-list"></i>
                        <span>تراکنشات من</span>
                    </a>
                </li>


                <li class=" {{ Request::route()->getName() == 'doctor.service.orders' ? 'active' : '' }}  ">
                    <a href="{{ route('doctor.service.orders') }}">
                        <i class="fas fa-list"></i>
                        <span>سفارشات من(خدمات)</span>
                    </a>
                </li>

                <li class=" {{ Request::route()->getName() == 'doctor.service' ? 'active' : '' }}  ">
                    <a href="{{ route('doctor.service') }}">
                        <i class="fas fa-boxes"></i>
                        <span>ثبت خدمات</span>
                    </a>
                </li>

                <li class=" {{ Request::route()->getName() == 'doctor.service.list' ? 'active' : '' }}  ">
                    <a href="{{ route('doctor.service.list') }}">
                        <i class="fas fa-boxes"></i>
                        <span>لیست خدمات</span>
                    </a>
                </li>


                @if (\Illuminate\Support\Facades\Auth::guard('doctor')->user()->certificateDragStore())
                    <li class=" {{ Request::route()->getName() == 'doctor.orders' ? 'active' : '' }}  ">
                        <a href="{{ route('doctor.orders') }}">
                            <i class="fas fa-list"></i>
                            <span>سفارشات من(محصولات)</span>
                        </a>
                    </li>
                    <li class=" {{ Request::route()->getName() == 'doctor.product' ? 'active' : '' }}  ">
                        <a href="{{ route('doctor.product') }}">
                            <i class="fas fa-boxes"></i>
                            <span>ٍثبت محصول</span>
                        </a>
                    </li>
                    <li class=" {{ Request::route()->getName() == 'doctor.product.list' ? 'active' : '' }}  ">
                        <a href="{{ route('doctor.product.list') }}">
                            <i class="fas fa-boxes"></i>
                            <span>لیست محصولات</span>
                        </a>
                    </li>
                @else
                    <li class=" {{ Request::route()->getName() == 'doctor.certificate.product' ? 'active' : '' }}  ">
                        <a href="{{ route('doctor.certificate.product') }}">
                            <i class="fas fa-boxes"></i>
                            <span>فعال سازی داروخانه/فروش محصول</span>
                        </a>
                    </li>
                @endif

                <li class=" {{ Request::route()->getName() == 'doctor.account' ? 'active' : '' }}  ">

                    <a href="{{ route('doctor.account') }}">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>حساب کاربری</span>
                    </a>
                </li>
                <li class=" {{ Request::route()->getName() == 'doctor.articles' ? 'active' : '' }}  ">

                    <a href="{{ route('doctor.articles') }}">
                        <i class="fas fa-book"></i>
                        <span>مقالات</span>
                        <small class="unread-msg">{{ Auth::user()->articles()->count() }}</small>
                    </a>
                </li>
                <li class=" {{ Request::route()->getName() == 'doctor.chats' ? 'active' : '' }}  ">

                    <a href="{{ route('doctor.chats') }}">
                        <i class="fas fa-comments"></i>
                        <span>پیام‌ها</span>
                        <small class="unread-msg">{{ $unseen_chat ? $unseen_chat : 0 }}</small>
                    </a>
                </li>


                <li class=" {{ Request::route()->getName() == 'doctor.tickets' ? 'active' : '' }}  ">

                    <a href="{{ route('doctor.tickets') }}">
                        <i class="fas fa-comments"></i>
                        <span>سیستم تیکت</span>
                        <small class="unread-msg-ticket">{{ $unseen_ticket ? $unseen_ticket : 0 }}</small>
                    </a>
                </li>


                <li class=" {{ Request::route()->getName() == 'doctor.profile.change_password' ? 'active' : '' }}  ">
                    <a href="{{ route('doctor.profile.change_password') }}">
                        <i class="fas fa-lock"></i>
                        <span>‌تغییر رمز عبور</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('doctor.logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>خروج</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
