@php

    $data=$item->doctor;
@endphp

<li style="border: lightslategrey 1px solid;border-radius: 15px;padding: 15px">
    <div class="comment">
        <img class="avatar avatar-sm rounded-circle"
             alt="{{$item->patient ? $item->patient->full_name : 'مهمان'}}"
             src="@if($item->patient) {{$item->patient->media ? $item->patient->media->url : asset('assets/img/avatar.jpg')}} @else asset('assets/img/avatar.jpg') @endif">
        <div class="comment-body">

            @if($item->suggest=='yes')
                <p class="recommended"><i class="far fa-thumbs-up"></i> این
                    دکتر
                    را
                    پیشنهاد میکنم</p>
            @endif


            <div class="meta-data">
                                                            <span
                                                                class="comment-author">{{$item->patient ? $item->patient->full_name : 'مهمان'}}</span>
                <span
                    class="comment-date">{{$item->fa_date}}</span>
                <div class="review-count rating">
                    <i class="fas fa-star {{$item->star >= 1 ? 'filled' : ''}}"></i>
                    <i class="fas fa-star {{$item->star >= 2 ? 'filled' : ''}}"></i>
                    <i class="fas fa-star {{$item->star >= 3 ? 'filled' : ''}}"></i>
                    <i class="fas fa-star {{$item->star >= 4 ? 'filled' : ''}}"></i>
                    <i class="fas fa-star {{$item->star >= 5 ? 'filled' : ''}}"></i>
                </div>
            </div>


            <p class="comment-content">


                {!! $item->message !!}
            </p>
            <div class="comment-reply">

                @if(!empty($item->answers))
                    <a class="comment-btn" href="#">
                        <i class="fas fa-reply"></i> پاسخ
                    </a>
                @endif

                <p class="recommend-btn">

                    @if($item->suggest=='yes')
                        <a href="#" class="like-btn">
                            <i class="far fa-thumbs-up"></i>
                        </a>
                    @else
                        <a href="#" class="dislike-btn">
                            <i class="far fa-thumbs-down"></i>
                        </a>
                    @endif


                </p>
            </div>
        </div>
    </div>
    @if(!empty($item->answers))

        @if(isset($data))
            <ul class="comments-reply">
                <li>
                    <div class="comment">
                        <img class="avatar avatar-sm rounded-circle"
                             alt="User Image"
                             src="{{$data->media ? $data->media->url : asset('assets/img/avatar.jpg')}}">
                        <div class="comment-body">
                            <div class="meta-data">
                                                                        <span
                                                                            class="comment-author">{{$data->full_name}}</span>
                                <span
                                    class="comment-date">{{$item->fa_date_doc}}</span>

                            </div>
                            <p class="comment-content">
                                {!! $item->answers !!}
                            </p>

                        </div>
                    </div>
                </li>
            </ul>
        @endif
    @endif
</li>
