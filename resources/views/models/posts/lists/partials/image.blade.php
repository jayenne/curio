<div class="card-img-top" >
        @foreach($media as $key => $element)
            <img
            	src="{{ $element['url'] ?? $element['fallback'] }}"
            	class="img-{{ $loop->iteration }} of-{{ $loop->count }}"
            	alt="{{ $element['title'] }}"
            	data-fallbacks="{{ $element['fallback'] }},{{ asset(config('platform.media.posts.small.missing.image')) }}"
				style="background-color: {{ $element['color'] }}"
				onerror='
					this.onerror = null; this.src="{{ $element['fallback'] }}"; this.style="image-rendering: pixelated; image-rendering: crisp-edges;background-color: {{ $element['color'] }}"
				'
            />
        @endforeach
</div>