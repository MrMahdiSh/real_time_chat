<div class="col-md-6 col-lg-4 col-xl-3">
    <div class="profile-widget">
        <div class="doc-img">
            <a href="{{route('doctor_profile',['doctor'=>$item->full_name,'id'=>$item->id])}}">
                <img  loading="lazy"   class="img-fluid lazyload" alt="{{$item->full_name}}"
                     src="{{isset($item->media) ? $item->media->url : asset('assets/img/avatar.jpg')}}">
            </a>


            @component('blog::componets.btn_favorite',['id'=>$item->id])
            @endcomponent

        </div>
        <div class="pro-content">
            <h3 class="title">
                <a href="{{route('doctor_profile',['doctor'=>$item->full_name,'id'=>$item->id])}}">{{$item->full_name }}</a>
                <i class="fas fa-check-circle verified"></i>
            </h3>
            <p class="speciality">{{$item->category ? $item->category->title : ''}}</p>
            <div class="rating">
                <i class="fas fa-star  {{$item->stars >= 1 ? 'filled' : ''}}"></i>
                <i class="fas fa-star {{$item->stars >= 2 ? 'filled' : ''}}"></i>
                <i class="fas fa-star {{$item->stars >= 3 ? 'filled' : ''}}"></i>
                <i class="fas fa-star {{$item->stars >= 4 ? 'filled' : ''}}"></i>
                <i class="fas fa-star {{$item->stars >= 5 ? 'filled' : ''}}"></i>
                <span class="d-inline-block average-rating">({{$item->stars}})</span>
            </div>
            <ul class="available-info">
                <li>
                    <i class="fas fa-map-marker-alt"></i> {{$item->address_info}}
                </li>
                <li>
                    <i class="far fa-clock"></i> در دسترس
                </li>
                <li>
                    <i class="far fa-money-bill-alt"></i>{{$item->setting_pay ? number_format($item->setting_pay->reserve_price) : number_format(5000,null)}}
                    تومان
                    <i class="fas fa-info-circle" data-bs-toggle="tooltip"
                       title="Lorem Ipsum"></i>
                </li>
            </ul>
            <div class="row row-sm">
                <div class="col-6">
                    <a href="{{route('doctor_profile',['doctor'=>$item->full_name,'id'=>$item->id])}}"
                       class="btn view-btn">مشاهده
                        پروفایل</a>
                </div>
                <div class="col-6">
                    <a href="{{route('doctor_reserved',['id'=>$item->id])}}" class="btn book-btn">رزرو کنید</a>
                </div>
            </div>
        </div>
    </div>


</div>
