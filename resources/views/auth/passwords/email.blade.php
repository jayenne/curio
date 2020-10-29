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
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                      
                        <div class="form-group my-4">
                            <b-input-group size="md">
                                <b-input-group-prepend>
                                    <span class="input-group-text">@svg('icons/envelope','icon-xs light')</span>
                                </b-input-group-prepend>
                                <b-form-input id="email" type="icons/email" class="input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{__('email address')}}" aria-label="email" aria-describedby="inputEmail"></b-form-input>

                            </b-input-group>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <b-button variant="outline-light" type="submit" >
                                <span class="p6">{{ __('Reset Password') }}</span>
                            </b-button>
                            <span class="text-light mx-3">Or</span>
                            <b-button variant="link" class="text-sm pl-1 text-nowrap" href="{{ route('login') }}">
                                @svg('icons/undo','icon-xs inverse') {{ __('Back to Login') }}
                            </b-button>
                        </div>
                    </form>
                </b-card-text>
            </b-card>
        </div>

    </div>
</div>

@endsection