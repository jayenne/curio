<article id="last" class="grid-item col-12 d-flex justify-content-center" >
    <div class="card no-shadow">
        <div class="card-img-top p-4">
            <div class="d-flex justify-content-center align-items-center">
                @svg('images/no-boards','image')
            </div>
        </div>
        <div class="card-body d-flex flex-row my-2">
            <div class="card-copy d-flex flex-column justify-content-center">
                <h5>{{ __("204: You haven’t any boards") }}</h5>
                <button
                class="btn btn-lg btn-outline-dark my-4 "
                data-toggle="modal"
                data-target="#modal-settings"
                data-url="b/f/c"
                data-target-title="{{ __('Creating a new board') }}"
                role="menuitem"
                target="_self"
                class="dropdown-item">
                {{ __("Create your first board") }}</button>
            </div>
        </div>
    </div>
</article>