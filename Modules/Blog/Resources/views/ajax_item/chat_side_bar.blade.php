<div class="chat-scroll">
    @isset($data)
        @foreach($data as $item)
            @if(!empty($item->doctor))

                <a href="#" onclick="chat_content('{{$item->doc_id}}')" class="media d-flex">
                    <div class="media-img-wrap flex-shrink-0">
                        <div class="avatar  ">
                            <img
                                src="{{isset($item->doctor->media) ? $item->doctor->media->url : asset('assets/img/avatar.jpg')}}"
                                alt="{{$item->doctor->full_name}}"
                                class="avatar-img rounded-circle">
                        </div>
                    </div>
                    <div class="media-body flex-grow-1">
                        <div>
                            <div class="user-name">{{$item->doctor->full_name}}</div>
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
