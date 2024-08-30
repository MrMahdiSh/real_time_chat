<div class="col-md-12 col-lg-4 col-xl-4 product-custom ">
    <div class="profile-widget">
        <div class="doc-img">
            <a href="{{route('product.detail',['id'=>$item->id,'title'=>$item->title])}}" tabindex="-1">
                <img loading="lazy"   class="img-fluid lazyload" alt="Product image"
                     src="{{isset($item->media) ? $item->media->url : asset('assets_blog/img/no_image.png')}}">
            </a>
            @if(Auth::guard('patient')->check()   )

                @if(Auth::guard('patient')->user()->hasFavProduct($item->id))

                    <a style="background-color: #09e5ab !important; "
                       href="{{route('product.favorite.remove',['id'=>$item->id])}}" class="fav-btn" tabindex="-1">
                        <i class="far fa-bookmark"></i>
                    </a>
                @else
                    <a
                        href="{{route('product.favorite',['id'=>$item->id])}}" class="fav-btn" tabindex="-1">
                        <i class="far fa-bookmark "></i>
                    </a>
                @endif


            @endif
        </div>

        <div class="pro-content">
            <h3 class="title pb-4">
                <a href="{{route('product.detail',['id'=>$item->id,'title'=>$item->title])}}"
                   tabindex="-1">{{$item->title}}</a>
                <hr>
                {{$item->category ? $item->category->title : 'بدون دسته بندی'}}
                / {{$item->brand ? $item->brand->title : 'بدون  برند'}}
            </h3>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <span class="price">{{number_format($item->offer_price,null)}}
                        تومان</span>
                    <hr>
                    <span class="price-strike"> @if((int)$item->offer>0)   {{number_format($item->price,null)}}
                        تومان   @endif </span>
                </div>

                @if($item->count>0 && Auth::guard('patient')->check())
                    <div class="col-lg-6 text-end">
                        <a href="{{route('card.add',['product_id'=>$item->id,'count'=>1])}}" class="cart-icon"><i
                                class="fas fa-shopping-cart"></i></a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
