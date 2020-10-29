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
	                
	                <li class="search-bar nav-link">
						<user-search />
					</li> 
					<li class="navbar-icon nav-link">
				    	<b-link href="/updates" title="{{ __('Updates') }}" v-b-tooltip.hover>
							@svg('icons/bell','icon-sm')
						</b-link>
					</li>
					<li class="navbar-icon nav-link">
				    	<b-link href="/boards/me" title="{{ __('Your Boards') }}" v-b-tooltip.hover>
				    		@svg('buttons/boards-btn','icon-sm')
				    	</b-link>
				    </li>
				    <li class="navbar-icon nav-link">
				    	<b-link href="/following" title="{{ __('Following') }}" v-b-tooltip.hover>
							@svg('|/users-btn','icon-sm')
						</b-link>
					</li>

				    <li class="navbar-icon nav-link">
				    	<b-link href="/boards/me" title="{{ __('Me') }}" v-b-tooltip.hover>
						 	<b-img src="{{ $authuser['profile']['avatar'] }}"  class="avatar icon-md" ></b-img>
						</b-link>
					</li>

					<li class="navbar-icon nav-link" >
						<b-dropdown id="profile-dropdown" right offset="-6px" no-caret data-hoverable="true" variant="outline-transparent">
						    <template v-slot:button-content>
						    		<span class="bg-l rounded">@svg('icons/angle-down','icon-sm')</span>
						    </template>
						 	
						 	<b-dropdown-item class="dropdown-item" data-toggle="modal" data-target="#modal-settings" data-url="m/me/r" data-target-title="{{ __('Edit profile') }}">
						        <div class="d-flex justify-content-between align-items-center">
						        	<div class="flex-shrink mr-3">
						        		@svg('icons/cog','icon-xs')
						        	</div>
						        	<div class="d-flex flex-column flex-grow-1">
										<div>{{ @$authuser['first_name'] }}</div>
										<small>{{ @$authuser['email'] }}</small>
									</div>
								</div>
							</b-dropdown-item>
							
							<b-dropdown-divider></b-dropdown-divider>

							 	<b-dropdown-item class="dropdown-item" data-toggle="modal" data-target="#modal-settings" data-url="b/f/c" data-target-title="{{ __('Create a new board') }}">
							        <div class="d-flex justify-content-between align-items-center">
							        	<div class="flex-shrink mr-3">
							        		@svg('icons/board','icon-xs')
							        	</div>
							        	<div class="d-flex flex-column flex-grow-1">
											<div>{{ __("Create Board") }}</div>
										</div>
									</div>
								</b-dropdown-item>

						    <b-dropdown-divider></b-dropdown-divider>
						    
						    <b-dropdown-item class="dropdown-item" to="logout"
						    	onclick="event.preventDefault();
						        document.getElementById('logout-form').submit();">
						        <div class="d-flex justify-content-between align-items-center">
						        	<div class="flex-shrink mr-3">
						        		@svg('icons/sign-out','icon-xs')
						        	</div>
						        	<div class="d-flex flex-column flex-grow-1">
										<div>{{ __('Logout') }}</div>
									</div>
								</div>
							</b-dropdown-item>
						   
						</b-dropdown>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                	@csrf
		                </form>
					</li>
	            </ul>
	        </div>
	    </div>
    </div>  
</nav>