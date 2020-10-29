<form data-ajax="true" class="d-flex flex-column justify-content-center align-items-start" method="POST" action="{{ route('api.users.profile-update') }}" enctype="multipart/form-data" data-success="close-modal">
    @csrf
    <div class="modal-header overlayed d-flex justify-content-center align-items-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">@svg('icons/arrow-right', 'icon-sm')</span>
        </button>
        <h3 data-role="title" class="">{{ $item['first_name'] }}</h3>
    </div>

    <div class="modal-body">
        <article id="profile" class="modal-item" data-grid-id="{{ $item['id'] }}" >

                    <div class="dropbox uploader">
                        @include('models.users.cover_upload')
                    </div>

                    <div class="dropbox uploader d-flex align-items-start justify-content-start">
                        @include('models.users.avatar_upload')
                    </div>

                <div class="card col-12">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Edit profile') }}</h5>
                        <div class="d-flex justify-conten-between">
                            <div class="col-6 pl-0 form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="control-label">{{ __('First name') }}<sup>*</sup></label>
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $item['first_name'] }}" required>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-6 pr-0 form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="control-label">{{ __('Last name') }}<sup>*</sup></label>
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $item['last_name'] }}" required>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">{{ __('Email') }}<sup>*</sup></label>
                            <input id="email" type="text" class="form-control" name="email" value="{{ $item['email'] }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
                            <label for="bio" class="control-label">{{ __('Bio') }}</label>
                            <textarea id="bio" type="text" rows="5" maxlength="1024" class="form-control" name="bio" >{{ $item['profile']['bio'] ?: ''}}</textarea>
                            <small class="form-text text-muted">{{ __("A short description for others to get to know you.") }}</small>
                            @if ($errors->has('bio'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bio') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        
                    </div>
                </div>
                {{--
                <div class="card col-12">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Language & Location') }}</h5>

                        <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
                            <label for="language" class="control-label">{{ __('Language') }}</label>
                            <input id="language" type="text" class="form-control" name="language" value="{{ $item['profile']['language'] }}">

                            @if ($errors->has('language'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="control-label">{{ __('Location') }}</label>
                            <input id="location" type="text" class="form-control" name="location" value="{{ $item['profile']['location'] }}">

                            @if ($errors->has('location'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('location') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                --}}
                <div class="card col-12">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Change password') }}</h5>
                        <div class="form-group">
                            <div class="d-flex justify-conten-between">
                                <div class="col-6 pl-0 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">{{ __('New Password') }}</label>
                                    <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-6 pr-0 form-group">
                                    <label for="password-confirm" class="control-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </article>
    </div>

    <div class="modal-footer fixed-bottom ">
        <div class="col-4 overlayed d-flex justify-content-between align-items-center float-right">

            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                <input id="current-password" type="password" class="form-control" name="current_password" placeholder="{{ __('Current Password') }}" required autocomplete="password">
                @if ($errors->has('current_password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('current_password') }}</strong>
                    </span>
                @endif
                <small class="form-text text-muted">{{ __("Enter your current password to save updates.") }}</small>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __("Update") }}
                </button>
            </div>
        </div>
    </div>
</form>