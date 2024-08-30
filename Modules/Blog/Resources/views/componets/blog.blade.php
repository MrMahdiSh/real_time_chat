<div class="blog">
    <div class="blog-image">
        <a href="{{route('blog',['id'=>$item->id,'title'=>$item->title])}}"><img class="img-fluid"
                                                                                 src="{{$item->media  ? $item->media->url : ''}}"
                                                                                 alt="{{$item->title}}"></a>
    </div>
    <h3 class="blog-title"><a href="{{route('blog',['id'=>$item->id,'title'=>$item->title])}}">{{$item->title}}</a></h3>
    <div class="blog-info clearfix">
        <div class="post-left">
            <ul>
                <li>
                    <div class="post-author">
                        <a href="{{!empty($item->insta_link) ? $item->insta_link  : '#'}}"><img  loading="lazy" class="lazyload"
                                src="@if($item->user) {{$item->user->media ? $item->user->media->url : ''}} @endif @if($item->doctor) {{$item->doctor->media ? $item->doctor->media->url : ''}} @endif"
                                alt="{{$item->user ? $item->user->name.' '.$item->user->degree : ( $item->doctor ? $item->doctor->full_name : 'ادمین') }}">
                            <span>{{$item->user ? $item->user->name.' '.$item->user->degree : ( $item->doctor ? $item->doctor->full_name : 'ادمین')}}</span></a>
                    </div>
                </li>
                <li><i class="far fa-clock"></i>{{$item->fa_date}}</li>
                <li><i class="far fa-comments"></i>{{$item->comments()->count()}} نظر</li>
                <li><i class="fa fa-tags"></i>{{$item->category ? $item->category->title : ''}} </li>
            </ul>
        </div>
    </div>
    <div class="blog-content">
        <p>{{\App\Helper\Core::subStrStripTagCustomLenth($item->description,200)}}</p>
        <a href="{{route('blog',['id'=>$item->id,'title'=>$item->title])}}" class="read-more">بیشتر بخوانید</a>
    </div>
</div>
