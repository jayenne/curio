<article class="modal-item" data-grid-id="{{ $item['id'] }}">
    <div class="card">
        
        @if($item['post_media'])
            <div class="card-img-top">
            
            @foreach($item['post_media'] as $key => $element)
                @if($element['url'])
                    
                    @switch($element['type'])
                        @case('video')
                            <video controls muted type="{{ $element['content_type'] }}" src="{{ $element['url'] }}"  alt="{!! $item['title'] !!}" onerror='this.onerror = null; this.src="{{ asset(config('platform.fallback.post.grid.video')) }}"' ></video>
                        @break
                        @case('animated_gif')
                             <video autoplay loop muted type="{{ $element['content_type'] }}" src="{{ $element['url'] }}" alt="{!! $item['title'] !!}" onerror='this.onerror = null; this.src="{{ asseet(config('platform.fallback.post.grid.anim')) }}"'></video>
                        @break
                        @default
                        
                        <img src="{{ $element['url'] }}" class="img-{{ $key }} of-{{ count($item['post_media']) }}" alt="{!! $item['title'] !!}" onerror='this.onerror = null; this.src="{{ asset(config('platform.fallback.post.grid.image')) }}"' />
                    @endswitch
                    
                @endif
            @endforeach
            </div>

            <div class="card-byline d-flex justify-content-end px-3 mb-5">   
                <img class="avatar align-self-center" src="{{ $item['user']['profile']['avatar'] ?: config('platform.fallback.user.avatar') }}" alt="{{ $item['user']['name'] }}" />
            </div>      
        @else
            <div class="card-byline d-flex justify-content-end px-3">   
                <div class="source">{{ $item['source'] ?: 'web' }} @svg(['sources/'.$item["source_icon"],'icons/source-default'],'icon-sm')</div>
                        <img class="avatar align-self-center" src="{{ $item['user']['profile']['avatar'] ?: config('platform.fallback.user.avatar') }}" alt="{{ $item['user']['name'] }}" />

            </div>
        @endif 

        <div class="card-body d-flex flex-row-reverse">
            <div class="stats d-flex flex-column justify-content-start align-items-end">
                <div class="stat">
                    <button class="btn btn-link btn-icon {{ $item['reactions']['liked'] }}" data-action="like" data-url="a/r" >
                        <div class="text-nowrap text-dark"><span class="mx-1" data-action="counter">{{ $item['reactions']['likes']['count'] }}</span><span class="mx-1">@svg('buttons/heart-btn', 'icon-sm brand-m')</span></div>
                    </button>
                </div>
            </div>

            <div class="card-copy flex-grow-1 mt-5">
                <h5 class="">{!! $item['title'] !!} </h5>
                <p class="card-text">{!! $item['body'] !!}</p>
            </div>

            
        </div>
        
    </div>
</article>