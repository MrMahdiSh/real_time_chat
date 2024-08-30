<div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">

    <div class="card search-widget">
        <div class="card-body">
            <form class="search-form" action="{{route('blog.search')}}" method="get">
                @csrf
                <div class="input-group">
                    <input type="text" name="text" id="text" required placeholder="جستجو..." class="form-control">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>


    <div class="card post-widget">
        <div class="card-header">
            <h4 class="card-title">آخرین پست‌ها</h4>
        </div>
        <div class="card-body">
            <ul class="latest-posts">


                @foreach($posts as $item)
                    @if(!empty($item->id))
                        <li>
                            <div class="post-thumb">
                                <a href="{{route('blog',['id'=>$item->id,'title'=>$item->title])}}">
                                    <img class="img-fluid" src="{{$item->media  ? $item->media->url : ''}}" alt="">
                                </a>
                            </div>
                            <div class="post-info">
                                <h4>
                                    <a href="{{route('blog',['id'=>$item->id,'title'=>$item->title])}}">{{$item->title}}</a>
                                </h4>
                                <p>{{$item->fa_date}}</p>
                            </div>
                        </li>
                    @endif
                @endforeach

            </ul>
        </div>
    </div>


    <div class="card category-widget">
        <div class="card-header">
            <h4 class="card-title"> دسته‌بندی بلاگ </h4>
        </div>
        <div class="card-body">
            <ul class="categories">
                <li>
                    <a href="{{route('blog.search')}}">تمامی دسته بندی ها
                    </a>
                </li>
                @foreach($category as $item)
                    <li>
                        <a href="{{route('blog.search',['category'=>$item->id,'title'=>$item->title])}}">{{$item->title}}
                            <span>({{$item->posts()->count()}})</span></a>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>


    <div class="card tags-widget">
        <div class="card-header">
            <h4 class="card-title">برچسب‌ها</h4>
        </div>
        <div class="card-body">
            <ul class="tags">
                @foreach($tags as $item)
                    <li><a class="tag"
                           href="{{route('blog.search',['title'=>$item->title,'tag'=>$item->id])}}">{{$item->title}}</a>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>

</div>
