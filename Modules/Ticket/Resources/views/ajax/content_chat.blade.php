<div class="active-chat ">
    <div class="chat_navbar">
        <header class="chat_header d-flex justify-content-between align-items-center p-1">
            <div class="vs-con-items d-flex align-items-center">
                <div class="sidebar-toggle d-block d-lg-none mr-1"><i
                        class="feather icon-menu font-large-1"></i></div>
                <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                    <img src="{{$doctor->media ? $doctor->media->url : asset('assets/img/avatar.jpg')}}" alt=""
                         height="40" width="40"/>
                    {{--                    <span class="avatar-status-busy"></span>--}}
                </div>
                <h6 class="mb-0">{{$doctor->full_name}}</h6>
            </div>

        </header>
    </div>
    <div class="user-chats" style="overflow:scroll;">
        <div class="chats">

            @isset($data)


                @foreach($data as $date=>$val)
                    <div class="divider">
                        <div class="divider-text">{{$date}}</div>
                    </div>

                    @foreach($val as $item)


                        <div class="chat {{(int)$item->doc_id==(int)$item->sender_id ? 'chat-left' : ''}}">
                            @if($item->doc)
                                <div class="chat-avatar">
                                    <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right"
                                       title="" data-original-title="">
                                        <img
                                            src="{{$item->doc->media ? $item->doc->media->url : asset('assets/img/avatar.jpg')}}"
                                            alt="avatar" height="40" width="40"/>
                                    </a>
                                </div>

                            @endif


                            <div class="chat-body">
                                <div class="chat-content">

                                    @if(!empty($item->text))
                                        <p>{!! $item->text !!}</p>
                                    @endif

                                    @if(!empty($item->file_name))
                                        <a target="_blank" href="{{$item->url}}"><i class="fa fa-download"> </i> پیوست </a>
                                    @endif


                                </div>
                            </div>
                        </div>

                    @endforeach

                @endforeach



            @endisset


        </div>


    </div>
    <div class="chat-app-form">
        <form method="post" enctype="multipart/form-data" name="form" id="form" class="chat-app-input d-flex"
              onsubmit="{{route('Ticket.store')}}"
              action="{{route('Ticket.store')}}">
            @csrf
            <input hidden id="doc_id" name="doc_id" value="{{$doctor->id}}">

            <input name="text"  required type="text" class="form-control message mr-1 ml-50" id="text"
                   placeholder="پیام خود را اینجا وارد کنید">
            <input value="ارسال" type="submit" class="btn btn-primary send"><i
                    class="fa fa-paper-plane-o d-lg-none"></i> <span class="d-none d-lg-block"> </span>
            </input>
        </form>
    </div>
</div>
