@if(\Illuminate\Support\Facades\Auth::guard('patient')->check())

    <a style="  @if(!empty(Auth::guard('patient')->user()->favorite()->where('doc_id',$id)->first())) background-color: #09e5ab !important;  @endif " href="{{route('favorite.store',['id'=>$id])}}"
       class="btn     fav-btn">
        <i id="bookmark" class="far fa-bookmark"></i>
    </a>

@endif
