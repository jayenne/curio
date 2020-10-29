<nav class="navbar navbar-expand-md">
    <div class="container-fluid">
        <div class="w-100 d-flex justify-content-between">
            <a class="navbar-nav trans-bg m-3" href="{{ url('/') }}">
		        <div class="d-flex flex-nowrap justify-content-start align-items-center"><span>{{ __("Sort by") }} &nbsp; </span>
			        <ul class="navbar-nav ml-auto d-flex flex-row align-items-center">
						<li class="nav-link">
							<b-dropdown id="profile-dropdown" right offset="-6px" no-caret class="" variant="outline-transparent">
							    <template v-slot:button-content>
							      {{ __('Likes') }} @svg('icons/angle-down','icon-sm')
							    </template>
							 	<b-dropdown-item class="dropdown-item" to="/home">
							            {{ __('New') }}
								</b-dropdown-item>

							 	<b-dropdown-item class="dropdown-item" to="/home">
							            {{ __('Views') }}
								</b-dropdown-item>
								

								<b-dropdown-item class="dropdown-item" to="{{ route('locale_hero.switch', ['locale_code' => 'nl-BE']) }}">
							            {{ __('Follows') }}
								</b-dropdown-item>

								<b-dropdown-item class="dropdown-item" data-modal="modal" data-url="/b/c"  >
							            {{ __('Booksmarked') }}
								</b-dropdown-item>

								<b-dropdown-divider></b-dropdown-divider>
							</b-dropdown>
						</li>
					</ul>
				</div>
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
	                
	                <li class="nav-link">
						<span>Category</span>
					</li>
					<li class="nav-link">
						<span>Category</span>
					</li> 
					<li class="nav-link">
						<span>Category</span>
					</li> 
					<li class="nav-link">
						<span>Category</span>
					</li> 
					<li class="nav-link">
						<span>Category</span>
					</li> 
					<li class="nav-link">
						<span>Category</span>
					</li> 
					<li class="navbar-icon nav-link">
						@svg('icons/bell','icon-sm')
					</li>
					<li class="navbar-icon nav-link">
						<b-dropdown id="layout-dropdown" right offset="-6px" no-caret class="dropdown-row layout-group" variant="outline-transparent">
							<template v-slot:button-content >
						    	@svg('icons/board','icon-sm')
						    </template>
							<b-dropdown-item data-layout="packery" >
						    	@svg('icons/packery','icon-sm')
						    </b-dropdown-item>
						    <b-dropdown-item data-layout="fitRows">
						    	@svg('icons/grid','icon-sm')
						    </b-dropdown-item>
						    <b-dropdown-item data-layout="vertical">
						    	@svg('icons/rows','icon-sm')
						    </b-dropdown-item>
						    <b-dropdown-item >
						    	@svg('icons/play','icon-sm')
						    </b-dropdown-item>
						</b-dropdown>
					</li>
					<li class="navbar-icon nav-link">
						@svg('icons/users','icon-sm')
					</li>
					
	            </ul>
	        </div>
	    </div>
    </div>  
</nav>