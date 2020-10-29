BOARD ME
@foreach($data as $item)

<article id="grid-boards-{{ $item['id'] }}" class="grid-item col-sm-12 col-md-6 col-xl-4" data-id="{{ $item['id']}}" data-total-weight="{{ $item['reactions']['totals']['weight'] }}" data-total-count="{{ $item['reactions']['totals']['count'] }}">
    <div class="card" >

        
        <pre>{{-- print_r($item,true) --}}</pre>
        
      
        <div class="card-img-top" data-toggle="modal" data-target="#modal-griditem" data-url="p/b/{{ $item['id'] }}">
            @foreach( array_slice($item['posts']['data'],0,5) as $key => $element)
                <img src="{{ $element['post_media']['data'][0]['url'] }}" class="img-{{ $loop->iteration }} of-{{ $loop->count }}" alt="{!! $item['title'] !!}" onerror='this.onerror = null; this.src="{{ asset(config('platform.fallback.board.grid.missing')) }}"' />
            @endforeach
        </div>
        <div class="card-body d-flex flex-row">

            <div class="card-stats d-flex flex-column justify-content-start align-items-center">   
                
                <button class="btn btn-link action" data-toggle="modal" data-target="#modal-griditem" data-url="b/c/{{ $item['id'] }}">
                    @svg('buttons/edit-btn','icon-xxl')
                </button>
                
                <div class="d-flex flex-column flex-justify-content-start">
                    
                    <button class="btn btn-link btn-icon p-0 d-flex justfify-content-start align-items-center {{ $item['reactions']['totals']['reacted'] ? 'on' : ''}}" data-url="a/r" data-action="love" data-type="board" data-id="{{ $item['id'] }}" data-toggle="tooltip" data-placement="right" title="{{ __('Love') }}" >
                        <span class="mr-1">@svg('buttons/heart-btn', 'icon-xs brand-m')</span>
                        <span class="h5 mb-0 text-nowrap text-dark" data-acted="love">{{ $item['reactions']['totals']['count'] }}</span>
                    </button> 
                    
                    <button class="py-2 btn btn-link btn-icon p-0 d-flex justfify-content-center align-items-center {{ $item['is_subscribed'] == true ? 'on' : '' }}" data-url="a/s" data-action="bookmark" data-type="post" data-id="{{ $item['id'] }}" data-toggle="tooltip" data-placement="right" title="{{ __('Bookmark') }}" >
                        <span class="mr-1">@svg('buttons/bookmark-btn', 'icon-xs brand-m')</span>
                        <span class="h5 mb-0 text-nowrap text-dark" data-acted="bookmark">{{ $item['subscribers_count'] }}</span>
                    </button>
                 </div>

            </div> 

            <div class="d-flex flex-column flex-grow-1 justify-content-start align-items-start">
               
                <div class="source"></div>
                
                <div class="w-100 d-flex flex-row justify-content-between align-items-start">
                    <div class="card-copy mr-3 flex-grow-1" data-toggle="modal" data-target="#modal-griditem" data-url="p/b/{{ $item['id'] }}">
                        <h5>{!! $item['title'] !!} </h5>
                        <p class="card-text">{!! $item['body'] !!}</p>
                    </div>
                    {{-- 
                    <div class="card-actions py-3 d-flex flex-column justify-content-start align-items-end">    
                        <div class="stat" data-toggle="tooltip" data-placement="left" title="{{ __('Show post') }}" >
                            <button class="btn btn-link btn-icon" data-toggle="modal" data-target="#modal-griditem" data-url="p/b/{{ $item['id'] }}" >
                            @svg('buttons/expand-wide-btn', 'icon-xs brand-m')
                            </button>
                        </div>

                        <div class="stat" data-toggle="tooltip" data-placement="left" title="{{ __('Info') }}">
                            <button class="btn btn-link btn-icon" data-overlay="post-overlay" data-from="right" data-url="p/{{ $item['id'] }}">@svg('buttons/bug-btn', 'icon-xs brand-m')</button>
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