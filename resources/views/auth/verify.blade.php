@extends('layouts.app-guest')

@section('content')

<div id="login" class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-12 col-md-8 col-lg-6 overlay d-flex flex-column flex-md-row justify-content-between align-items-center">
       
        <div class="col-12 col-md-4 d-flex justify-content-center justify-content-lg-end align-items-center">
            <span class="my-5" style="white-space: nowrap ">@svg('brands/curio-logo','brand invert icon-hxl')</span>
        </div>
        
        <div class="col-12 col-md-12 d-flex justify-content-sm-center justify-content-end align-items-center align-items-md-start">
            <b-card> 
                <b-card-text class="text-center text-light">  
                    @if (session('resent'))
                        <div class="alert" role="alert">
                            <h4 class="text-light">{{ __('Sent...')}}</h4>
                            <p>{{ __('A fresh verification link has been sent to your email address.') }}</p>
                            <p>{{ __('If you still haven`t received it, please check your junk folder.') }}</p>
                        </div>
                    @else
                    <h4 class="text-light">{{ __('One last thing...')}}</h4>
                        {{ __( 'Please check your email and click the verification link.') }}<br/>
                        {{ __("If you have not received our email") }}.&hellip;
                    @endif
                        <b-form method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                        
                            
                            <b-button type="submit" variant="btn btn-link" >
                                <span>{{ __('click here to request another') }}</span>
                                <span class="ml-2">{{ svg_icon('icons/envelope', 'icon-xs inverse')->inline() }}</span>
                            </b-button>
                        
                        </b-form>
                       
                </b-card-text>
            </b-card>
        </div>

    </div>
</div>
@endsection
