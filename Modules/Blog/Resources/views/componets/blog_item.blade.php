<div class="col-md-6 col-lg-3 col-sm-12">

    <div class="blog grid-blog">
        <div class="blog-image">
            <a href="{{route('blog',['id'=>$item->id,'title'=>$item->title])}}"><img loading="lazy"    class="img-fluid lazyload"
                                                                                     src="{{$item->media  ? $item->media->url : ''}}"
                                                                                     alt="{{$item->title}}"></a>
        </div>
        <div class="blog-content">
            <ul class="entry-meta meta-item">
                <li>
                    <div class="post-author">
                        <a href="{{!empty($item->insta_link) ? $item->insta_link  : '#'}}"><img
                                src="@if($item->user) {{$item->user->media ? $item->user->media->url : ''}} @endif @if($item->doctor) {{$item->doctor->media ? $item->doctor->media->url : ''}} @endif"
                                alt="{{$item->user ? $item->user->name.' '.$item->user->degree : ( $item->doctor ? $item->doctor->full_name : 'ادمین')}}">
                            <span>{{$item->user ? $item->user->name.' '.$item->user->degree : ( $item->doctor ? $item->doctor->full_name : 'ادمین')}}</span></a>
                    </div>
                </li>
                <li><i class="far fa-clock"></i> {{$item->fa_date}}</li>
            </ul>
            <h3 class="blog-title"><a
                    href="{{route('blog',['id'=>$item->id,'title'=>$item->title])}}">{{$item->title}}</a>
            </h3>
            <p class="mb-0">{{\App\Helper\Core::subStrStripTagCustomLenth($item->description,200)}}</p>
        </div>
    </div>

</div>

