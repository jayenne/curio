<div class="card-img-top">
	@php
		$media = array_merge($item['remoteMedia']['data'][0] ?? [],$item['media']['data'][0] ?? []);
	@endphp
	@if(!empty($media))
        <img src="{{ $media['url'] ?? $media['medium'] ?? null }}" class="freezeframe img-1 of-1" />
    @endif
</div>