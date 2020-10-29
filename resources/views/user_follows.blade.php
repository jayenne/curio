@extends('layouts.app')

@section('content')
<div class="container-fluid">
    
    <div class="row">
      	
        <div id="posts" class="col" >
        	
        	<div class="grid" id="post-data" >
        
        		@include("user_item")
        
        	</div>
        	
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