<div class="card-img-top position-relative">
  @php
    $cover = $item['media']['data'][0]['medium'] ?? config('platform.media.posts.medium.cover');
    $file = $item['remoteMedia']['data'][0]['url'] ?? null;
  @endphp
  @if( $cover != null )
    <img src="{{ $cover }}" class="img-1 of-1" alt="" />
  @endif
  <div class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center">
    <div class="position-relative">
      <audio
        id="audio_{{ $item['id'] }}"
        class="plyr"
        controls crossorigin playsinline
        type="audio/mpeg"
        src="{{ $file }}"
        data-plyr-config='{"controls": ["play","progress","current-time"]}'
        >
        {{ __("Your browser does not support the audio element.") }}
      </audio>
    </div>
  </div>
</div>