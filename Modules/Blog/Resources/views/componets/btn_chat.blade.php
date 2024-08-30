@if(\Illuminate\Support\Facades\Auth::guard('patient')->check())


    @if(Auth::guard('patient')->user()->reserves()->where('status',\App\Status::Success)->get()->count()>0)
        <a href="{{route('patient.chat.store',['id'=>$id])}}" class="btn btn-white msg-btn">
            <i class="far fa-comment-alt"></i>
        </a>
    @endif
@endif


