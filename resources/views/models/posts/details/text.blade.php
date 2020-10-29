@foreach($data as $item)

<article class="grid-item col-sm-12 col-md-4 col-xl-3" data-id="{{ $item['id']}}" data-total-weight="{{ $item['reactions']['totals']['weight'] }}" data-total-count="{{ $item['reactions']['totals']['count'] }}" data-type="{{ $item['type'] }}" data-theme="{{ $item['theme'] }}">
    <div class="card" data-toggle="modal" data-toggle="modal" data-target="#modal-griditem" data-url="p/{{ $item['id'] }}">
        {{-- 
        <pre>
            {{  print_r($item['media_count'], true) }}
            {{  print_r($item['boards_count'], true) }}
            {{  print_r($item['subscribers_count'], true) }}
        </pre>
        --}}

        <div class="card-img-top">
            @if($item['media_count'] > 0)
                @foreach($item['post_media']['data'] as $key => $element)
                    @if($element['url'])
                        @switch($element['type'])
                            @case('video')
                                <video controls muted type="{{ $element['content_type'] }}" src="{{ $element['url'] }}"  alt="{!! $item['title'] !!}" onerror='this.onerror = null; this.src="{{ asset(config('platform.fallback.post.grid.missing')) }}"' ></video>
                            @break
                            @case('animated_gif')
                                 <video autoplay loop muted type="{{ $element['content_type'] }}" src="{{ $element['url'] }}" alt="{!! $item['title'] !!}" onerror='this.onerror = null; this.src="{{ asseet(config('platform.fallback.post.grid.missing')) }}"'></video>
                            @break
                            @default
                            <img src="{{ $element['url'] }}" class="img-{{ $loop->iteration }} of-{{ $loop->count }}" alt="{!! $item['title'] !!}" onerror='this.onerror = null; this.src="{{ asset(config('platform.fallback.post.grid.missing')) }}"' />
                        @endswitch
                    @endif
                @endforeach
            @endif
        </div>
        
        <div class="card-body d-flex flex-row">

            <div class="card-stats d-flex flex-column justify-content-start align-items-center">   
                
                <button class="btn btn-link action" data-toggle="modal" data-target="#modal-griditem" data-url="c/{{ $item['user']['id'] }}">
                    <img class="avatar mb-2 justify-content-start align-self-center" src="{{ $item['user']['profile']['avatar'] }}" alt="{{ $item['user']['name'] }}" onerror='this.onerror = null; this.src="{{ asset(config('platform.fallback.user.grid.avatar')) }}"' />
                </button>
             
                <div class="d-flex flex-column flex-justify-content-start">
   
                    <button class="py-2 btn btn-link btn-icon p-0 d-flex justfify-content-center align-items-center {{ $item['reactions']['totals']['reacted'] ? 'on' : ''}}" data-url="a/r" data-action="love" data-type="post" data-id="{{ $item['id'] }}" data-toggle="tooltip" data-placement="right" title="{{ __('Love') }}" >
                        <span class="mr-1">@svg('buttons/heart-btn', 'icon-xs brand-m')</span>
                        <span class="h5 mb-0 text-nowrap text-dark" data-acted="love">{{ $item['reactions']['totals']['count'] }}</span>
                    </button> 

                    <button class="py-2 btn btn-link btn-icon p-0 d-flex justfify-content-center align-items-center {{ $item['is_subscribed'] == true ? 'on' : '' }}" data-url="a/s" data-action="bookmark" data-type="post" data-id="{{ $item['id'] }}" data-toggle="tooltip" data-placement="right" title="{{ __('Bookmark') }}" >
                        <span class="mr-1">@svg('buttons/bookmark-btn', 'icon-xs brand-m')</span>
                        <span class="h5 mb-0 text-nowrap text-dark" data-acted="bookmark">{{ $item['subscribers_count'] }}</span>
                    </button>

                </div>
            </div> 

            <div class="d-flex flex-column justify-content-start align-items-start">
                
                <a target="_blank" href="{{ $item['source']['url'] }}" class="source w-100 pr-2 d-flex justify-content-end align-items-start @if( $item['post_media']['data'] ) invert @endif ">
                        <span class="pr-2">{{ $item['source']['name'] ?: 'web' }}</span>
                        <span>@svg($item["source"]["icon"],'icon-xs brand-xd')</span>
                </a>

                <div class="d-flex flex-row justify-content-between align-items-start">
                    <div class="card-copy mr-3 flex-grow-1" >
                        <h5>{!! $item['title'] !!} </h5>
                        <p class="card-text">{!! $item['body'] !!}</p>
                    </div>
                    {{-- 
                    <div class="card-actions py-3 d-flex flex-column justify-content-start align-items-end">    
                        <div class="stat" data-toggle="tooltip" data-placement="left" title="{{ __('Show post') }}" >
                            <button class="btn btn-link btn-icon" data-toggle="modal" data-target="#modal-griditem" data-url="p/{{ $item['id'] }}" >
                            @svg('buttons/expand-wide-btn', 'icon-xs brand-m')
                            </button>
                        </div>

                        <div class="stat" data-toggle="tooltip" data-placement="left" title="{{ __('Info') }}">
                            <button class="btn btn-link btn-icon" data-overlay="post-overlay" data-from="right" d-ata-url="p/{{ $item['id'] }}">@svg('buttons/bug-btn', 'icon-xs brand-m')</button>
                        </div>
                    </div>
                    --}}
                </div>
                
            </div>
        </div>
            
        </div>

    </div>
</article>

@endforeach