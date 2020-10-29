@extends("layouts.app")
@section('jumbotron')
    @include("layouts.jumbotron")
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
@endsection
@section('footer')
<script src="https://cdn.plyr.io/3.6.2/plyr.js"></script>
<!--script src="https://unpkg.com/freezeframe/dist/freezeframe.min.js"></script-->

@endsection
@section("content")
@include("navigation.board_edit")

	<div class="container-fluid position-relative d-flex flex-column">
        <div id="grid" data-filters="" data-url="{{ $path ?? config('platform.fallback.grid.path') }}{{ @request()->route()->parameters['id'] ?? null }}" data-index="{{ @request()->route()->parameters['id'] ?? null }}" data-empty="{{ @request()->route()->parameters['name'] ?? null }}" class="grid">
	        
	  	</div>

        <div class="loader">
            <div class="inner">
                <div class="infinite-scroll-request" style="display:none">
                    <div class="icon p-3">
                        @svg('anims/loader', 'icon-lg')
                    </div>
                </div>
                {{--
                <div class="infinite-scroll-last" style="display:none">
                    <div id="eoc" class="">{{ __('Looks like you`ve reached the end') }}</div>
                   
                </div>
                <div class="infinite-scroll-error" style="display:none">
                    {{ __('404 Nothing more to see') }}
                </div>
                --}}
            </div>
        </div>

	</div>

	

    @include("partials.modal.griditem")

@endsection
