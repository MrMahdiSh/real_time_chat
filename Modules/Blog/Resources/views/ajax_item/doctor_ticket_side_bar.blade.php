<div class="chat-scroll">
    @isset($data)
        @foreach($data as $item)
            <a href="#" onclick="chat_content('{{$item->id}}')" class="media d-flex   @if(isset($user_id)){{$user_id==$item->id ? 'active' : ''}} @endif">
                <div class="media-img-wrap flex-shrink-0">
                    <div class="avatar  ">
                        <img
                            src="{{isset($item->media) ? $item->media->url : asset('assets/img/avatar.jpg')}}"
                            alt="{{$item->full_name   }}"
                            class="avatar-img rounded-circle">
                    </div>
                </div>
                <div class="media-body flex-grow-1">
                    <div>
                        <div class="user-name">{{$item->full_name}}</div>
                        <div
                            class="user-last-chat">{{$item->LastTicket()->where('doc_id',\Illuminate\Support\Facades\Auth::id())->first()  ? $item->LastTicket()->where('doc_id',\Illuminate\Support\Facades\Auth::id())->first()->text : ''}}</div>
                    </div>
                    <div>
                        <div
                            class="badge badge-danger rounded-pill">{{$item->UnseenChat()->where('doc_id',Auth::id())->get()->count()    }}</div>
                    </div>
                </div>
            </a>

        @endforeach
    @endisset

</div>
