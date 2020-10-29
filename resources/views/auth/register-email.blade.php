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
                    <b-form method="POST" action="{{ route('email-reset') }}">
                        @csrf
                      
                        <div class="form-group my-4 mt-5">
                            <b-input-group size="md">
                                <b-input-group-prepend>
                                    <span class="input-group-text">@svg('icons/envelope','icon-xs light')</span>
                                </b-input-group-prepend>
                                <b-form-input id="email" type="icons/email" class="input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{__('email address')}}" aria-label="email" aria-describedby="inputEmail"></b-form-input>
                                <b-input-group-append >
                                    <span class="input-group-text" title="{{ __('Submit email') }}" v-b-tooltip.hover>
                                        <b-button type="submit" variant="input-group-text p-0" >
                                        
                                        @svg('icons/paper-plane','icon-xs inverse')
                                        </b-button>
                                    </span>
                                </b-input-group-append>

                            </b-input-group>
                            <div class="text-light invert">{{ __("where can we send your password?") }}</div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @enderror
                        </div>

                      <!--   <div class="d-flex justify-content-end align-items-center">
                 
                            <b-button variant="outline-light" href="login/twitter" >
                                <span class="p6">{{ __('Submit') }}</span>
                                <span class="ml-3">{{ svg_icon('icons/paper-plane', 'icon-sm')->inline() }}</span>
                            </b-button>
                        </div> -->
                    </b-form>
                </b-card-text>
            </b-card>
        </div>

    </div>
</div>
@endsection
