<article class="modal-item" data-grid-id="{{ $item['id'] }}">
    
    <div class="card">
    {{--
        <pre>{{ print_r($item) }}</pre>
    --}}
        <div class="card-img-top">
            <img src="{{ $item['profile']['cover'] }}" class="img-1 of-1" alt="cover" onerror='this.onerror = null; this.src="/{{ config('platform.fallback.user.detail.missing') }}"' />
        </div>

        <div class="card-body d-flex flex-row">
            <div class="card-stats d-flex flex-column justify-content-start align-items-center">    
                
                <button class="pb-2 btn btn-link action" data-modal="modal-griditem" data-url="c/{{ $item['id'] }}">
                    <img class="avatar justify-content-start align-self-center" src="{{ $item['profile']['avatar'] }}" alt="{{ $item['first_name'] }}" onerror='this.onerror = null; this.src="{{ asset(config('platform.fallback.user.grid.missing')) }}"' />
                </button>

                <button class="pb-2 btn btn-link btn-icon p-0 d-flex justfify-content-center align-items-center {{ $item['reactions']['totals']['reacted'] ? 'on' : ''}}" data-url="a/r" data-action="love" data-type="user" data-id="{{ $item['id'] }}" data-toggle="tooltip" data-placement="right" title="{{ __('Love') }}" >
                    <span class="mr-1">@svg('buttons/heart-btn', 'icon-sm brand-m')</span>
                    <span class="h5 mb-0 text-nowrap text-dark" data-acted="love">{{ $item['reactions']['totals']['count'] }}</span>
                </button>

                <button class="py-2 btn btn-link btn-icon p-0 d-flex justfify-content-center align-items-center {{ $item['follows']['totals']['reacted'] ? 'on' : ''}}" data-url="a/f" data-action="follow" data-type="user" data-id="{{ $item['id'] }}" >
                    <span class="mr-1">@svg('buttons/user-btn', 'icon-sm brand-m')</span>
                    <span class="h5 mb-0 text-nowrap text-dark" data-acted="follow">{{ $item['follows']['totals']['followers_count'] }}</span>
                </button> 

                <div class="py-2 d-flex justfify-content-center align-items-center" data-url="a/f" data-action="following" >
                    <span class="mr-1">@svg('buttons/users-btn', 'icon-sm brand-m')</span>
                    <span class="h5 mb-0 text-nowrap text-dark" data-acted="following">{{ $item['follows']['totals']['following_count'] }}</span>
                </div>
                                                                
                <div class="py-2 d-flex justfify-content-center align-items-center" >
                    <span class="mr-1">@svg('icons/board', 'icon-sm brand-m')</span>
                    <span class="h5 mb-0 text-nowrap text-dark">{{ $item['boards_count'] }}</span>
                </div>

                <div class="py-2 d-flex justfify-content-center align-items-center" >
                    <span class="mr-1">@svg('icons/post', 'icon-sm brand-m')</span>
                    <span class="h5 mb-0 text-nowrap text-dark" >{{ $item['posts_count'] }}</span>
                </div>

                <div class="py-2 d-flex justfify-content-center align-items-center" >
                    <span class="mr-1">@svg('icons/bell', 'icon-sm brand-m')</span>
                    <span class="h5 mb-0 text-nowrap text-dark" >{{ $item['subscriptions']['totals']['count'] }}</span>
                </div>

            </div>

            <div class="d-flex flex-column justify-content-start align-items-start">
                <div class="source w-100 pr-2 d-flex justify-content-end align-items-start invert">
                        <span class="pr-2">{{ $item['country']['name'] }}</span>
                        <span>{{ $item['country']['flag'] }}</span>
                </div>

                <div class="d-flex flex-row justify-content-between align-items-start">
                    <div class="card-copy flex-grow-1">
                        <h5 >{{ $item['profile']['intro'] }} </h5>
                        <p class="card-text">{{ $item['profile']['bio'] }}</p>
                        <div class="card-overlay">
                    
                        <div class="overlay right p-4">
                            <div>
                                {{--  
                                @if($item['tags']['data'])
                                    
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><label>Tags:</label></li>
                                        @foreach($item['tags']['data'] as $key => $element)
                                            <li class="list-inline-item badge badge-info" contenteditable="true">{{ $element['name'] }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                --}}
                            </div>
                            <div>
                                {{--
                                @if($item['urls'])
                                    
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><label>Urls</label></li>
                                        @foreach($item['urls'] as $key => $element)
                                        <li class="list-inline-item btn btn-link" contenteditable="true">
                                            <a href="{{ $element['url'] }}" target="_blank">
                                                {{ $element['short_url'] }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                @endif
                                --}}
                            </div>
                            <div>
                                @if($item['reactions'])     
                                    <ul class="list-inline">
                                    @foreach ($item['reactions']['items'] as $reaction)
                                        <li class="list-inline-item" data-weight="{{ $reaction['weight'] }}" data-toggle="tooltip" data-placement="top" title="{{ $reaction['name'] }}">
                                            <span class="btn-icon {{ $reaction['reacted'] ? 'on' :'' }}" >@svg("reactions/".$reaction["name"], 'icon-sm '.$reaction["name"]) {{ $reaction["count"] }}</span>
                                        </li>
                                    @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
               

                    <div class="card-actions py-3 d-flex flex-column justify-content-start align-items-end">
                        
                        <div class="stat">
                            <button class="btn btn-link btn-icon {{ $item['reactions']['totals']['reacted'] ? 'on' : ''}}" data-url="a/r" data-action="love" data-type="user" data-id="{{ $item['id'] }}" >
                                @svg('buttons/heart-btn', 'icon-sm brand-m')
                            </button>
                        </div>
                        
                        
                        <div class="stat">
                            <button class="btn btn-link btn-icon" data-toggle="modal" data-target="#modal-griditem" data-url="p/{{ $item['id'] }}">@svg('buttons/expand-wide-btn', 'icon-sm brand-m')</button>
                        </div>

                        <div class="stat">
                            <button class="btn btn-link btn-icon" data-overlay="post-overlay" data-from="right" d-ata-url="p/{{ $item['id'] }}">@svg('buttons/bug-btn', 'icon-sm brand-m')</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
</article>