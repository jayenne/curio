@extends('layouts.app-guest')
@section('content')
    
<div id="login" class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-xl-8 overlay d-flex flex-column flex-lg-row justify-content-around align-items-center ">
       
        <div class="d-flex flex-nowrap">
            <span class="d-flex flex-nowrap">@svg('brands/curio-logo','brand invert icon-hxl')</span>
        </div>
        
        <div class=" d-flex justify-content-center align-items-center">
            <b-card class="d-flex flex-row "> 
                <b-card-text >  
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                      
                        <div class="form-group my-4">
                            <b-input-group size="md">
                                <b-input-group-prepend>
                                    <span class="input-group-text">@svg('icons/user','icon-xs light')</span>
                                </b-input-group-prepend>
                                <b-form-input id="username" type="text" class="input {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="{{__('username')}}" aria-label="username" aria-describedby="inputUsername"></b-form-input>
                                <b-input-group-append>
                                    <div class="input-group-text">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} v-b-tooltip.hover title="{{ __('Remember me') }}">
                                    </div>
                                </b-input-group-append>
                            </b-input-group>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group my-4">
                            <b-input-group size="md">
                                <b-input-group-prepend>
                                    <span class="input-group-text">@svg('icons/lock','icon-xs light')</span>
                                </b-input-group-prepend>
                                <b-form-input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{__('password')}}" aria-label="password" aria-describedby="inputPassword"></b-form-input>
                                 @if (Route::has('password.request'))
                                    <b-input-group-append >
                                        <span class="input-group-text" title="{{ __('Forgotten password') }}" v-b-tooltip.hover>
                                            <b-button variant="input-group-text p-0" class="" href="{{ route('password.request') }}">
                                            @svg('icons/question-circle','icon-xs inverse')
                                            </b-button>
                                        </span>
                                    </b-input-group-append>
                                @endif
                            </b-input-group>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @enderror
                        </div>
                   
                        <div class="d-flex justify-content-between align-items-center">
                      
                      
                            <b-button variant="outline-light" type="submit" >
                                <span class="p6">{{ __('Login') }}</span>
                            </b-button>
                            <span class="text-light mx-3">Or</span>
                            <b-button variant="outline-light" href="login/twitter" >
                                <span class="p6">{{ __('Login with Twitter') }}</span>
                                <span class="ml-3">{{ svg_icon('brands/twitter', 'icon-sm twitter')->inline() }}</span>
                            </b-button>
                        </div>
                    </form>
                </b-card-text>
            </b-card>
        </div>

    </div>
</div>

@endsection

