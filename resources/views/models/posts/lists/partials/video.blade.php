<div class="card-img-top">

    @php
        $cover = $item['media']['data'][0]['medium'] ?? null;
        $remote_cover = $item['remoteMedia']['data'][0]['cover'] ?? config('platform.media.posts.medium.missing.image');
        $remote_file = $item['remoteMedia']['data'][0]['url'] ?? config('platform.media.posts.medium.missing.video');

    @endphp

    <pre>{{-- dd( $item['remoteMedia'] ) --}}</pre>
    <figure>

       <video
        id="video_{{ $item['id'] }}"
        class="plyr"
        controls crossorigin playsinline
        data-poster="{{ $remote_cover }}"
        src="{{ $remote_file }}"
        height="auto"
        width="100%" 
        data-plyr-config='{"controls": ["play-large"]}'
        >
       </video>
       
     </figure>

</div>
