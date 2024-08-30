@if(!empty($data[0]->doctor))
    <div class="chat-header">
        <a id="back_user_list" href="javascript:void(0)" class="back-user-list">
            <i class="material-icons">chevron_left</i>
        </a>
        <div class="media d-flex">
            <div class="media-img-wrap flex-shrink-0">
                <div class="avatar  ">
                    <img
                        src="{{isset($data[0]->doctor->media) ? $data[0]->doctor->media->url : asset('assets/img/avatar.jpg')}}"
                        alt="User Image"
                        class="avatar-img rounded-circle">
                </div>
            </div>
            <div class="media-body flex-grow-1">
                <div class="user-name">{{$data[0]->doctor->full_name}}</div>
                {{--                            <div class="user-status">آنلاین</div>--}}
            </div>
        </div>
        <div class="chat-options">
            {{--            <a href="tel:{{$data[0]->doctor->mobile}}">--}}
            {{--                <i class="material-icons">local_phone</i>--}}
            {{--            </a>--}}

            <a href="javascript:void(0)">
                <i class="material-icons">more_vert</i>
            </a>
        </div>
    </div>
@endif

<div class="chat-body">
    <div class="chat-scroll">
        <ul class="list-unstyled">

            @isset($data)
                @foreach($data as $item)


                    <li class="media d-flex  {{(int)$item->sender_id==(int)$item->doc_id ? 'received' : 'sent'}}">


                        @if((int)$item->sender_id==(int)$item->doc_id)
                            <div class="avatar flex-shrink-0">
                                <img
                                    src="{{isset($data[0]->doctor->media) ? $data[0]->doctor->media->url : asset('assets/img/avatar.jpg')}}"
                                    alt="User Image"
                                    class="avatar-img rounded-circle">
                            </div>
                        @endif

                        <div class="media-body flex-grow-1">
                            @if(!empty($item->text))

                                <div class="msg-box">
                                    <div>
                                        {!! $item->text !!}
                                        <ul class="chat-msg-info">
                                            <li>
                                                <div class="chat-time">
                                                    <span>{{$item->fa_created_at[0].'-'.$item->fa_created_at[1]}}</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($item->file_name))
                                <div class="msg-box">
                                    <div>
                                        <div class="chat-msg-attachments">


                                            <div class="chat-attachment">
                                                <img src="{{asset('assets_blog/img/Attachment-icon.png')}}" alt="پیوست">
                                                <div class="chat-attach-caption">پیوست</div>
                                                <a target="_blank" href="{{url('/files/'.$item->file_name)}}"
                                                   class="chat-attach-download">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <ul class="chat-msg-info">
                                            <li>
                                                <div class="chat-time">
                                                    <span>{{$item->fa_created_at[0].'-'.$item->fa_created_at[1]}}</span>

                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </li>



                @endforeach
            @endisset




            {{--            <li class="chat-date">امروز</li>--}}


        </ul>
    </div>
</div>


<div class="chat-footer">

    <form id="chat_form" name="chat_form" method="post" enctype="multipart/form-data"
          action="{{route('patient.chat.post')}}">

        <input hidden name="sender_id" id="sender_id" value="{{$sender_id}}">
        <input hidden name="doc_id" id="doc_id" value="{{$doc_id}}">
        <input hidden name="patient_id" id="patient_id" value="{{$patient_id}}">

        @csrf
        <div class="input-group">
            <div class="btn-file btn">
                <i class="fa fa-paperclip"></i>
                <input name="file" id="file" type="file">
            </div>
            <input type="text" name="text" id="text" required class="input-msg-send form-control rounded-pill"
                   placeholder="چیزی تایپ کنید ">
            <button onclick="document.getElementById('chat_form').submit();" type="button"
                    class="btn msg-send-btn rounded-pill ms-2"><i
                    class="fab fa-telegram-plane"></i></button>
            <input type="submit" hidden>
        </div>
    </form>

</div>
