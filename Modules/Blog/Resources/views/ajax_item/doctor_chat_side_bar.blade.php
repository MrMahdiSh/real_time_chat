<div class="chat-scroll">
    @isset($data)
        @foreach($data as $item)
            @if(!empty($item->patient))

                <a href="#" onclick="chat_content('{{$item->patient_id}}')" class="media d-flex">
                    <div class="media-img-wrap flex-shrink-0">
                        <div class="avatar  ">
                            <img
                                src="{{isset($item->patient->media) ? $item->patient->media->url : asset('assets/img/avatar.jpg')}}"
                                alt="{{$item->patient ->full_name}}"
                                class="avatar-img rounded-circle">
                        </div>
                    </div>
                    <div class="media-body flex-grow-1">
                        <div>
                            <div class="user-name">{{$item->patient->full_name}}</div>
                            <div class="user-last-chat">{{!empty($item->text) ? $item->text : ''}}</div>
                        </div>
                        <div>
                            <div class="last-chat-time block">{{$item->fa_created_at[0]}}</div>
                            <div class="badge badge-success rounded-pill">{{$item->fa_created_at[1]}}</div>
                            <div class="badge badge-danger rounded-pill">{{$item->unseen[1]}}</div>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
    @endisset

</div>
