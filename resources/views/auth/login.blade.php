@extends('layouts.auth')

@section('content')
<div class="login-register">
    <div class="row margin-unset">
        <div class="col-md-8 padding-2-5">
            <div class="col-xs-12 text-center">
                <img src="/images/logo-hd.png" class="img-logo-center">
            </div>
            <h1 class="text-gold login-header">YOUR CONTENT HEADER HERE</h1>
            <h3 class="text-gold">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua.</h3>
            <!-- <ul class="circle-list">
              <li>1</li>
              <li>2</li>
              <li>3</li>
            </ul>   -->
        </div>
        <div class="col-md-4 ">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" action="{{ route('login') }}" method="POST">
                        @csrf
                        <h3 class="box-title m-b-20 text-gold">Sign In</h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input id="email" type="email" class="padding-10 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="password" type="password" class="padding-10 form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 font-14">
                                <div class="checkbox checkbox-primary pull-left p-t-0">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-gold" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div> <a href="javascript:void(0)" id="to-recover" class="text-gold pull-right"><i class="fa fa-lock m-r-5"></i> Forgot password?</a> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-gold btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>
                        
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                <div>Don't have an account? <a href="{{route('register')}}" class="text-info m-l-5"><b class="text-gold">Sign Up</b></a></div>
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
    </div>
    
</div>
@endsection