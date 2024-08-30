
@if ($paginator->hasPages())
    <ul class="pagination justify-content-center">

        <li class="page-item  {{$paginator->hasMorePages() ? '' : 'disabled'}}">
            <a class="page-link" href="{{$paginator->nextPageUrl()}}" tabindex="-1"><i
                    class="fas fa-angle-double-right"></i></a>
        </li>




        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>

                <li class="page-item  active">
                    <a class="page-link" href="#">1 </a>
                </li>

            @endif



            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="page-item  {{$page == $paginator->currentPage() ? 'active' : ''}}">
                        <a class="page-link" href="{{$url}}">{{ $page }} <span class="visually-hidden">({{$page == $paginator->currentPage() ? 'فعلی' : ''}})</span></a>
                    </li>
                @endforeach
            @endif
        @endforeach



        <li class="page-item {{$paginator->onFirstPage() ? 'disabled' : ''}}">
            <a class="page-link" href="{{$paginator->previousPageUrl()}}"><i
                    class="fas fa-angle-double-left"></i></a>
        </li>
    </ul>
@endif
