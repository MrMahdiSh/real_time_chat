<div class="col-md-6 col-lg-4 col-xl-3">
    <div class="card widget-profile pat-widget-profile">
        <div class="card-body">
            <div class="pro-widget-content">
                <div class="profile-info-widget">
                    <a href="{{route('doctor.patient.profile',['id'=>$item->patient->id])}}" class="booking-doc-img">
                        <img   loading="lazy" class="lazyload"
                               src="{{isset($item->patient->media) ? $item->patient->media->url : asset('assets/img/avatar.jpg')}}"
                            alt="User Image">
                    </a>
                    <div class="profile-det-info">
                        <h3>
                            <a href="{{route('doctor.patient.profile',['id'=>$item->patient->id])}}">{{$item->patient->full_name}}</a>
                        </h3>
                        <div class="patient-details">
                            <h5><b>شناسه بیمار :</b> {{$item->patient->id}}</h5>
                            <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i>
                                {{$item->patient->full_town}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="patient-info">
                <ul>
                    <li>شماره<span>{{$item->patient->mobile}}</span></li>

                    <li>گروه خونی<span>{{$item->patient->blood}}</span></li>
                    <li> تاریخ
                        تولد<span>{{\App\Helper\Core::birthdayAge($item->patient->birth_day).'ساله - ' .$item->patient->fa_birth_day }}</span>
                    </li>
                    <li> آدرس<span>{{$item->patient->address}}</span></li>


                </ul>
            </div>
        </div>
    </div>
</div>
