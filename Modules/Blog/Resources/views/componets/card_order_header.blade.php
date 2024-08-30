@isset($data)
    @if($data->count()>0)
        <li class="nav-item view-cart-header me-3">

            <a href="{{route('card.checkout')}}" class="" id="cart"><i class="fas fa-shopping-cart"></i>
                <small
                    class="unread-msg1">{{$data->count()}}</small></a>
            <div class="shopping-cart">
                <ul class="shopping-cart-items list-unstyled">
                    @isset($data)
                        @foreach($data as $item)
                            @if($item->product)
                                <li class="clearfix">
                                    {{--                                <div class="close-icon"><a--}}
                                    {{--                                        href="`{{route('card.remove',['product_id'=>$item->product_id,'count'=>$item->count])}}`"><i--}}
                                    {{--                                            class="far fa-times-circle"></i> </a></div>--}}
                                    <img class="avatar-img rounded"
                                         src="{{$item->product->media ? $item->product->media->url : asset('assets_blog/img/no_image.png')}}"
                                         alt="{{$item->product->title}}">
                                    <span class="item-name">{{$item->product->title}} </span>
                                    <span
                                        class="item-price">{{number_format($item->product->offer_price,null)}}تومان</span>
                                    <span
                                        class="item-price text-warning">{{$item->count}}عدد</span>

                                </li>
                            @endif
                        @endforeach
                    @endisset


                </ul>
                <div class="booking-summary pt-3">
                    <div class="booking-item-wrap">
                        <ul class="booking-date">
                            <li> مبلغ <span>{{number_format($product_price,null).' تومان '}}</span></li>

                            @isset($product_setting)
                                <li>هزینه حمل و
                                    نقل<span>{{(int)$product_setting->transfer_price>0 ? number_format($product_setting->transfer_price,null).'تومان' : 'رایگان'}}</span>
                                </li>

                                <li>
                                    مالیات<span>{{(int)$product_setting->tax_price>0 ? "{$product_setting->tax_price}%" : 'بدون مالیات'}}</span>
                                </li>
                            @endisset
                            <li>مبلغ نهایی
                                <span>{{isset($total_price) ? number_format($total_price,null).' تومان ' : ''}}</span>
                            </li>
                        </ul>
                        <div class="booking-total">
                            <ul class="booking-total-list text-align">
                                <li>
                                    <div class="clinic-booking pt-4">
                                        <a class="apt-btn" href="{{route('card.checkout')}}">پرداخت</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </li>



    @endif

@endisset
