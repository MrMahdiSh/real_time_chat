<li>
    <div class="comment">
        <div class="comment-author">
            <img class="avatar" alt=""
                 src="{{asset('http://127.0.0.1:8000/assets/img/avatar.jpg')}}">
        </div>
        <div class="comment-block">
<span class="comment-by">
<span class="blog-author-name">{{$item->user_id}}</span>
</span>
            <p>{{$item->message}}</p>
            <p class="blog-date">{{$item->fa_date}}</p>
            <a class="comment-btn" href="#">
                <i class="fas fa-reply"></i> پاسخ
            </a>
        </div>
    </div>
    <ul class="comments-list reply">
        <li>
            <div class="comment">
                <div class="comment-author">
                    <img class="avatar" alt=""
                         src="{{asset('http://127.0.0.1:8000/assets/img/avatar_male.jpg')}}">
                </div>
                <div class="comment-block">
<span class="comment-by">
<span class="blog-author-name">ادمین</span>
</span>
                    <p>{!! $item->replay !!}</p>
                    <p class="blog-date">{{$item->fa_date2}}</p>
                </div>
            </div>
        </li>
    </ul>
</li>
