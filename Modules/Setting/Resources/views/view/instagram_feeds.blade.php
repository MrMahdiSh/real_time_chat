{{--    Instagram Feeds--}}
@if (isset($insta_media) && count($insta_media))
    @foreach($insta_media as $key=>$item)
        @component('insta::componets.instagram_feed',['id'=>$key,'data'=>$item])
        @endcomponent
    @endforeach
@endif

<script async src="//www.instagram.com/embed.js"></script>

