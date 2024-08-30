<div class="card">
    <div class="card-body">
        <div class="doctor-widget">
            <div class="doc-info-left">
                <div class="doctor-img">
                    <a href="{{ route('doctor_profile', ['doctor' => $item->full_name, 'id' => $item->id]) }}">
                        <img src="{{ isset($item->media) ? $item->media->url : asset('assets/img/avatar.jpg') }}"
                            loading="lazy" class="img-fluid lazyload" alt="{{ $item->full_name }}">
                    </a>
                </div>

                <div class="doc-info-cont">
                    <h4 class="doc-name"><a
                            href="{{ route('doctor_profile', ['doctor' => $item->full_name, 'id' => $item->id]) }}">{{ $item->full_name }}</a>
                        @if ($item->certificate == \App\Status::True)
                            <i class="text-success fas fa-check-circle verified"></i>
                        @endif
                    </h4>
                    <p class="doc-speciality">{{ $item->specialist }}</p>

                    @if ($item->category)
                        <h5 class="doc-department"><img loading="lazy"
                                src="{{ $item->category->media ? $item->category->media->url : '' }}"
                                class="img-fluid lazyload" alt="Speciality">
                            {{ $item->category ? $item->category->title : '' }}</h5>
                    @endif
                    <div class="rating">
                        <i class="fas fa-star  {{ $item->stars >= 1 ? 'filled' : '' }}"></i>
                        <i class="fas fa-star {{ $item->stars >= 2 ? 'filled' : '' }}"></i>
                        <i class="fas fa-star {{ $item->stars >= 3 ? 'filled' : '' }}"></i>
                        <i class="fas fa-star {{ $item->stars >= 4 ? 'filled' : '' }}"></i>
                        <i class="fas fa-star {{ $item->stars >= 5 ? 'filled' : '' }}"></i>
                        <span class="d-inline-block average-rating">({{ $item->stars }})</span>
                    </div>


                    @if ($item->contact)
                        <div class="clinic-details">
                            <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                آدرس مطب : {{ $item->contact->address_1 }}</p>
                            <ul class="clinic-gallery">


                            </ul>
                        </div>
                    @endif





                    @if ($item->clinic)
                        <div class="clinic-details">
                            <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                آدرس کلینیک : {{ $item->clinic->title }}</p>
                            <ul class="clinic-gallery">

                                @if (count($item->clinic->gallery) > 0)
                                    @foreach ($item->clinic->gallery as $val)
                                        <li>
                                            <a target="_blank" href="{{ $val->url }}" data-fancybox="gallery">
                                                <img loading="lazy" class="lazyload" src="{{ $val->url }}"
                                                    alt="{{ $item->clinic->title }}">
                                            </a>
                                        </li>
                                    @endforeach
                                @endif


                            </ul>
                        </div>
                    @endif

                    @if (isset($item->services))
                        <div class="clinic-services">
                            @foreach (explode(',', $item->services) as $val)
                                <span>{{ $val }}</span>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
            <div class="doc-info-right">
                <div class="clini-infos">
                    <ul>

                        <li><i class="fas fa-map-marker-alt"></i>{{ $item->address_info }}</li>
                        <li>
                            <i class="far fa-money-bill-alt"></i>
                            {{ $item->setting_pay ? number_format($item->setting_pay->reserve_price) : number_format(5000, null) }}
                            تومان <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                        </li>
                    </ul>
                </div>
                <div class="clinic-booking">
                    <a class="view-pro-btn"
                        href="{{ route('doctor_profile', ['doctor' => $item->full_name, 'id' => $item->id]) }}">
                        مشاهده پروفایل</a>
                    <a class="apt-btn" href="{{ route('doctor_reserved', ['id' => $item->id]) }}">رزرو نوبت</a>
                </div>
            </div>
        </div>
    </div>
</div>
