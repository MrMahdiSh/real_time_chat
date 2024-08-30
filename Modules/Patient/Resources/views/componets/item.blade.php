<tr>
    <td>{{$key+1}}</td>
    <td class="product-img sorting_1  "><img class="rounded" width="50" height="50"
                                             src="{{isset($item->media) ? $item->media->url : asset('assets_blog/img/no_image.png')}}"
                                             alt="Img placeholder">
    </td>
    <td class="product-name">{{$item->full_name}}</td>
    <td class="product-name">{{$item->mobile}}</td>
    <td class="product-name">{{$item->fa_created_at}}</td>
    <td class="product-action">
        @if(auth()->user()->can('Patient.edit'))
            <a href="{{route('Patient.edit',['Patient'=>$item->id])}}"><span
                    class="action-edit"><i class="feather icon-edit"></i></span></a>
        @endif
        @if(auth()->user()->can('Patient.destroy'))
            <a href="#"
               onclick="delete_item('{{route('Patient.destroy',['Patient'=>$item->id])}}')">
                                                    <span class=""><i
                                                            class="feather icon-trash"></i></span>
            </a>
        @endif
    </td>
</tr>
