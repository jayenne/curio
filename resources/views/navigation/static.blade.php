<nav id="main-nav" class="navbar sticky-top navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <div class="w-100 d-flex justify-content-between">
            <a class="navbar-brand" href="{{ url('/') }}">
		        <span>@svg('brands/curio-logo','brand icon-hsm')</span>
		    </a>
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
	            <span class="navbar-toggler-icon"></span>
	        </button>
	    </div>
        <div class="d-flex justify-between">
	        <div class="collapse navbar-collapse" id="navbarSupportedContent">
	            <!-- Left Side Of Navbar -->
				
	            <!-- Right Side Of Navbar -->
	            <ul class="navbar-nav ml-auto d-flex flex-row align-items-center">

					<li class="navbar-icon nav-link">
				    	<b-link href="/home">
							@svg('icons/home','icon-sm')
						</b-link>
					</li>
					
	            </ul>
	        </div>
	    </div>
    </div>  
</nav>