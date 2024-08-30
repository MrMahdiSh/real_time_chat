<a href="{{ route('service.detail', ['id' => $item->id, 'title' => $item->title]) }}" target="_blank">

    <div class="swiper-slide col-md-12 col-lg-3 col-xl-3   rounded">
        <div class="profile-widget product-custom" style="border-radius: 20px; border: 1px solid whitesmoke">
            <div class="doc-img" style="border-radius: 20px; border: 1px solid whitesmoke; position: relative;">
                <a href="{{ route('service.detail', ['id' => $item->id, 'title' => $item->title]) }}" tabindex="-1">
                    <img loading="lazy"   class="img-fluid rounded lazyload" style="border-radius: 20px; border: 1px solid whitesmoke"
                         alt="Product image"
                         src="{{ isset($item->media) ? $item->media->url : asset('assets_blog/img/no_image.png') }}">
                    <div class="image-address"
                         style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(255, 255, 255, 0.8); padding: 10px;">
                        <i class="fas fa-map-marker-alt"></i> {{ $item->doctor ? $item->doctor->contact->address_1 : '' }}
                    </div>
                </a>
            </div>
            <div class="pro-content">
                <p class="font-weight-bold mb-0" style="font-weight: bold">
                    <a href="{{ route('service.detail', ['id' => $item->id, 'title' => $item->title]) }}"
                       tabindex="-1">{{ \App\Helper\Core::subStrStripTagCustomLenth($item->title,25) }}</a>
                </p>

                <div class="my-4 font-weight-light">{{ $item->doctor ? $item->doctor->full_name : '' }}</div>
                <div class="row align-items-center">
                    <div class="col-lg-6">


                        <div class="my-4 font-weight-light">{{ number_format($item->offer_price, null).'تومان' }}</div>


                        <hr>
                        <span class="price-strike"> @if((int)$item->offer > 0) {{ number_format($item->price, null) }}
                            تومان @endif </span>
                    </div>

                    @if((int)$item->offer > 0)
                        <div class="col-lg-6 text-end">
                            <a href="{{ route('service.detail', ['id' => $item->id, 'title' => $item->title]) }}"
                               class="badge badge-danger rounded p-3">{{ (int)$item->offer > 0 ? (int)$item->offer.'%' : '' }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</a>
