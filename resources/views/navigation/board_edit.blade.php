<nav id="grid-nav" class="navbar sticky-top navbar-expand-md">
    <div class="container-fluid bg-white p-0">
        <div class="d-flex justify-content-between">
	        <div class="d-flex flex-nowrap justify-content-start align-items-center">
		        <ul class="navbar-nav ml-auto d-flex flex-row align-items-center">
					<li class="nav-link">
					<button class="btn btn-link toggle-drag-button text-uppercase" data-toggletext="save">EDIT</button>
					</li>
					<li>
						<div class="d-flex flex-nowrap justify-content-start align-items-center nav-divider-l"><span>{{ __("Show as") }} &nbsp; </span>

					</li>
				</ul>
			</div>
		</div>

	        
	  
        <div class="d-flex justify-content-between nav-divider-l">

		        <div class="d-flex flex-nowrap justify-content-start align-items-center"><span>{{ __("Sorted by") }} &nbsp; </span>
			        <ul class="navbar-nav ml-auto d-flex flex-row align-items-center">
						<li class="nav-link">
							<b-dropdown id="sort-dropdown" right offset="-6px" no-caret class="" variant="outline-transparent">
							    <template v-slot:button-content>
							      {{ __('LIKES') }} @svg('icons/angle-down','icon-sm')
							    </template>
							 	<b-dropdown-item class="dropdown-item" to="/home">
							            {{ __('Newest') }}
								</b-dropdown-item>

							 	<b-dropdown-item class="dropdown-item" to="/home">
							            {{ __('popular') }}
								</b-dropdown-item>
								

								<b-dropdown-item class="dropdown-item" to="{{ route('locale_hero.switch', ['locale_code' => 'nl-BE']) }}">
							            {{ __('loved') }}
								</b-dropdown-item>

							</b-dropdown>
						</li>
					</ul>
				</div>
		    
		    
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
	            <span class="navbar-toggler-icon"></span>
	        </button>
	    </div>

    </div>  
</nav>
