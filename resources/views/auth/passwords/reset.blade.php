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
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}" >
                        <input type="hidden" name="email" value="{{ request('email') }}" required ></input>

                       <!--  <div class="form-group my-4">
                            <b-input-group size="md">
                                <b-input-group-prepend>
                                    <span class="input-group-text">@svg('icons/user','icon-xs light')</span>
                                </b-input-group-prepend>
                                <b-form-input id="email" type="icons/email" class="input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{__('email address')}}" aria-label="email" aria-describedby="inputEmail"></b-form-input>
                            
                            </b-input-group>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @enderror
                        </div>
 -->
                        <div class="form-group my-4">
                            <b-input-group size="md">
                                <b-input-group-prepend>
                                    <span class="input-group-text">@svg('icons/lock','icon-xs light')</span>
                                </b-input-group-prepend>
                                <b-form-input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{__('new password')}}" aria-label="password" aria-describedby="inputPassword"></b-form-input>

                            </b-input-group>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group my-4">
                            <b-input-group size="md">
                                <b-input-group-prepend>
                                    <span class="input-group-text">@svg('icons/lock-confirm','icon-xs light')</span>
                                </b-input-group-prepend>
                                <b-form-input id="password-confirm" type="password" class="" name="password_confirmation" required autocomplete="new-password" placeholder="{{__('Confirm password')}}" aria-label="confirm-password" aria-describedby="password-confirm"></b-form-input>

                            </b-input-group>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <div class="d-flex justify-content-end align-items-center">
                      
                            <b-button variant="outline-light" type="submit" >
                                <span class="p6">{{ __('Save') }}</span>
                            </b-button>
                           
                        </div>
                    </form>
                </b-card-text>
            </b-card>
        </div>

    </div>
</div>

@endsection