@extends('layouts.auth')

@section('content')
<div class="login-register">
    <div class="row margin-unset">
        <div class="col-md-4"></div>
        <div class="col-md-4 ">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" action="{{ route('register') }}" method="POST">
                        @csrf
                        
                            <h3 class="box-title m-b-20 text-gold">Sign Up</h3>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input id="name" type="text" class="padding-10 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input id="email" type="email" class="padding-10 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input id="password" type="password" class="padding-10 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                </div>
                            </div>
                        
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input id="contact" type="text" class="padding-10 form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required placeholder="Contact No.">

                                    @error('contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <select class="form-control province-change select-change" required name="province" data-url="{{route('reg.city')}}" data-target=".city-change">
                                        <option value="">Select Province</option>
                                        @foreach($_province as $province)
                                        <option value="{{$province->provCode}}" {{ old('province') == $province->provCode ? 'selected="selected"' : '' }}>{{$province->provDesc}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <select class="form-control city-change select-change" data-url="{{route('reg.brgy')}}" data-target=".barangay-change" required name="city">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <select class="form-control barangay-change" required name="barangay">
                                        <option value="">Select Barangay</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <textarea class="form-control" name="street" required placeholder="Street"></textarea>
                                    
                                </div>
                            </div>

                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-gold btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">{{ __('Register') }}</button>
                                </div>
                            </div>

                            <div class="form-group m-b-0">
                                <div class="col-sm-12 text-center">
                                    <div>Already have an account? <a href="{{route('login')}}" class="text-info m-l-5"><b class="text-gold">Sign In</b></a></div>
                                </div>
                            </div>
                    </form>
                    <form class="form-horizontal" id="recoverform" action="index.html">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Email"> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    
</div>
@endsection

@section('js')
<script type="text/javascript" src="/js/register.js?{{time()}}"></script>
@endsection