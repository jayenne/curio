@foreach($data as $item)
<article id="grid-boards-{{ $item['id'] }}" class="grid-item col-sm-12 col-md-6 col-xl-4 layout-{{ $item['settings']['layout'] }} {{ $item['settings']['size'] }} " data-curator="{{ $item['curator']['id'] }}" data-id="{{ $item['id']}}" data-total-weight="{{-- $item['reactions']['totals']['weight'] --}}" data-total-count="{{-- $item['reactions']['totals']['count'] --}}">
    <div class="card">        
        <div class="card-img-top" data-toggle="modal" data-target="#modal-griditem" data-url="b/{{ $item['id'] }}">
            @if( !empty($item['media']['data'][0]['small']))
                @foreach( $item['media']['data'] as $media)
                <img src="{{ $media['small'] }}" class="img-{{ $loop->iteration }} of-{{ $loop->count }}" alt="" onerror='this.onerror = null; this.src="{{ asset(config('platform.media.boards.small.missing')) }}"' />
                @endforeach
            @elseif( !empty( $item['posts']['data'][0]['media']['data'][0]['medium']) )
                @foreach( $item['posts']['data'] as $post)
                    @if( !empty($post['media']['data'][0]['medium']) )
                        <img src="{{ $post['media']['data'][0]['medium'] }}" class="img-{{ $loop->iteration }} of-{{ $loop->count }}" alt="" onerror='this.onerror = null; this.src="{{ asset(config('platform.media.boards.small.missing')) }}"' />
                    @endif
                @endforeach
            @endif
        </div>

        <div class="card-body d-flex flex-row">

            <div class="card-stats d-flex flex-column justify-content-start align-items-center">   
                
                <button class="btn btn-link action" data-toggle="modal" data-target="#modal-griditem" data-url="c/{{ $item['user']['id'] }}">
                    <img class="avatar mb-2 justify-content-start align-self-start" src="{{ $item['user']['profile']['avatar'] }}" alt="" onerror='this.onerror = null; this.src="{{ asset(config('platform.fallback.user.grid.avatar')) }}"' data-toggle="tooltip" data-placement="right" title="{{ $item['user']['name'] }}"/>
                </button>
                
                <div class="d-flex flex-column flex-justify-content-start">
                    <a href="#" class="btn btn-link btn-icon p-0 d-flex justfify-content-start align-items-center" data-toggle="tooltip" data-placement="right" title="{{ __('Posts') }}" >
                        <span class="mr-1">@svg('icons/posts', 'icon-xs brand-m')</span>
                        <span class="h5 mb-0 text-nowrap text-dark" data-acted="love">{{ $item['post_count'] }}</span>
                    </a>
                    
                    <button class="py-2 btn btn-link btn-icon p-0 d-flex justfify-content-center align-items-center {{ $item['is_subscribed'] == true ? 'on' : '' }}" data-url="a/s" data-action="bookmark" data-type="post" data-id="{{ $item['id'] }}" data-toggle="tooltip" data-placement="right" title="{{ __('Bookmark') }}" >
                        <span class="mr-1">@svg('buttons/bookmark-btn', 'icon-xs brand-m')</span>
                        <span class="h5 mb-0 text-nowrap text-dark" data-acted="bookmark">{{ $item['subscribers_count'] }}</span>
                    </button>
                 </div>

            </div> 

            <div class="d-flex flex-column flex-grow-1 justify-content-start align-items-start">
               
                <div class="source"></div>
                
                <div class="w-100 d-flex flex-row justify-content-between align-items-start">
                    <div class="card-copy mr-3 flex-grow-1" target="_self" data-to="/b/{{ $item['id'] }}">
                        
                        <h5 class="heading">{!! $item['title'] !!} </h5>
                        
                        <p class="card-text">{!! $item['body'] !!}</p>
                        
                        <div class="card-extra">
                            <div data-toggle="tooltip" data-placement="top" title="{{ $item['dates']['created'] }}">{{ $item['dates']['created_string'] }}</div>
                            <div isotope class="category">Categories: {{ $item['categories'] }}</div>
                            <div isotope class="hashtag">Hashtags: {{ $item['hashtags'] }}</div>
                            <div isotope class="curator">Board ID: {{ $item['id'] }}</div>
                            <div isotope class="date">Created: {{ $item['dates']['created'] }}</div>
                            <div isotope class="owner">Owner ID: {{  $item['curator']['id'] }}</div>
                            <div isotope class="status text-danger">Status: {{  $item['status']['name'] }}</div>
                            <div isotope class="subscribed">Subscribed: {{ $item['is_subscribed'] == true ? 'true' : 'false' }}</div>

                        </div>
                   </div>
                </div>
                
            </div>
        </div>
    </div>
</article>

@endforeach