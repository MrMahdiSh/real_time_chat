@isset($data)

    @foreach($data as $item)
        <li onclick="set_to_city_search('{{$item->title}}')" class="list-group-item">{{$item->title}}
            -{{$item->state ? $item->state->title : ''}} </li>
    @endforeach
@endisset
