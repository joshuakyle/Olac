@extends('layouts.app')
@section('bgcolor')
bgcolor
@endsection
@section('content')
<div id="wrapper">
    <div class="row">
        <div class="col s4 ">
            <div id="login_div">
                    <img class="circle logo" src="{{asset('img/olac-logo.jpg')}}">
                    <br/>
                    <br/>
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                        <div class="login input-field text-left">
                            <i class="material-icons prefix">person</i>
                            <input id="email" type="text" class=" form-control" data-error="{{ $errors->has('username') ? 'wrong' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                           
                             <label for="email" >{{ __('Username') }}</label>
                        </div>
                        <div class=" login input-field text-left">
                            <i class="material-icons prefix">lock_outline</i>
                                <input id="password" type="password" class=" form-control" data-error="{{ $errors->has('name') ? 'wrong' : '' }}" name="password" required>
                                <label for="password" >{{ __('Password') }}</label>
                        </div>
                   {{--      <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}
                         @if ($errors->has('username'))
                            <span style="color:red">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                         @if ($errors->has('password'))
                                <span class="red accent-4">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                        @endif
                        <div class="form-group">
                            <div style="color:red">
                                <button type="submit" class="btn waves-effect waves-light blue darken-3">
                                    {{ __('Login') }} <i class="material-icons right">send</i>
                                </button>

                                 <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                               <!--  <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a> -->
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
