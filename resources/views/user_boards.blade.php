@extends('layouts.app')

@section('content')
<div class="container-fluid">
    
    <div class="row">
        
        <div class="sidebar-boards-left col-3 d-flex justify-content-center text-white">
        	<div class="position-fixed align-self-center">

    	        <h2 class="my-4">{{ config('platform.app.name') }}</h2>
                <h3 class="text-cursive">{{ config('platform.app.strapline') }}</h3>
                
                <div class="filters-button-group d-flex flex-column my-4">

                    @if (Auth::check() && $board_id == Auth::user()->id )
                        <button class="btn btn-white my-1" data-filter=".private">Private</button>
                    @endif
                    
                    @if (Auth::check())
                        <button class="btn btn-white my-1" data-filter=".premium">Premuim</button>
                        <button class="btn btn-white my-1" data-filter=".restricted">Followers</button>
                        <button class="btn btn-white my-1" data-filter=".public">Public</button>
                        <button class="btn btn-link text-white my-1" data-filter="*"><small>Show all</small></button>
                     @endif
                </div>

            </div>
    	</div>
      	
        <div id="boards" class="col-9" >
        	
        	<div class="grid" id="post-data" >
        
        		@include("board_item")
        
        	</div>
    	
            {{ $models->links() }}
    	</div>
    	
    </div>
    
</div>


<div class="loader text-center" style="display:none">

	<p><img src="/storage/svg/loader.svg" width="20">Loading More boards</p>

</div>
@endsection

@push('footer-scripts')
    <script src="//unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script src="{{asset('/js/grids.js')}}"></script>
@endpush