<div class="card">
    
    @include("models.posts.lists.partials.audio")

    <div class="card-body d-flex flex-row">

        @if( $item['user']['id'] == auth::id())
            <button class="mb-n5 pb-3 btn btn-link action" data-toggle="modal" data-target="#modal-griditem" data-url="c/{{ $item['user']['id'] }}">
                <img class="avatar justify-content-start align-self-center" src="{{ asset($item['user']['profile']['avatar']) }}" title="{{ $item['user']['name'] }}" data-toggle="tooltip" onerror='this.onerror = null; this.src="{{ asset(config('platform.media.users.small.avatar')) }}"' />
            </button>
            @endif
            
            <div class="mt-4 pt-3 d-flex flex-column flex-justify-content-start">
                <button class="py-2 btn btn-link btn-icon p-0 d-flex flex-column justfify-content-center align-items-center {{ $item['reactions']['totals']['reacted'] ? 'on' : ''}}" data-url="a/r" data-action="love" data-type="post" data-id="{{ $item['id'] }}" data-toggle="tooltip" data-placement="right" title="{{ __('Love') }}" >
                    <div class="h5 mb-0 text-nowrap text-dark" data-acted="love">{{ $item['reactions']['totals']['count'] }}</div>
                 	<div><span class="mr-1">@svg('buttons/heart-btn', 'icon-xxs brand-m')<small class="ml-1">{{ __("Loves") }}</small></span></div>
                 </button> 
            </div>
            @include('models.posts.lists._debug')
        </div> 

        <div class="d-flex flex-column justify-content-start align-items-start w-100">
            
            <a target="_blank" href="{{ $item['source']['url'] }}" class="source pr-2 d-flex justify-content-end align-items-start @if( $item['media']['data'] ) invert @endif  w-100">
                <span class="pr-2">{{ $item['source']['name'] }}</span>
                <span>@svg($item["source"]["icon"],'icon-xs brand-xd')</span>
            </a>
            
            <div class="d-flex flex-row justify-content-between align-items-start w-100">
                <div class="card-copy mr-3 flex-grow-1" >
                    <h5>{!! $item['title'] !!} </h5>
                    <p class="card-text">{!! $item['body'] !!}</p>
                </div>
                
                <div class="card-actions py-3 d-flex flex-column justify-content-start align-items-end">    
                    
                    <div class="stat" data-toggle="tooltip" data-placement="left" title="{{ __('Show post') }}" >
                        <button class="btn btn-link btn-icon" data-toggle="modal" data-target="#modal-griditem" data-url="p/{{ $item['id'] }}" >
                        @svg('buttons/expand-wide-btn', 'icon-xs brand-m')
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

