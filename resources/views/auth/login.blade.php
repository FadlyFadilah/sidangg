@extends('layouts.app')
@section('styles')
<style>
    body{
        background-image: url({{ asset('img/back.png') }});
    }
</style>
@endsection
@section('content')
<div class="login-box">
    <div class="login-logo">
        <img width="128px" src="{{ asset('img/logo_unisba.png') }}" alt=""></br>
        <a href="{{ route('admin.home') }}">
            Sistem Sidang Sarjana
        </a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">
            Login
        </p>

        @if(session('message'))
            <p class="alert alert-info">
                {{ session('message') }}
            </p>
        @endif

        <form method="POST" action="{{ route('login') }}" autocomplete="OFF">
            @csrf

            <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                <input id="nik" type="text" name="nik" class="form-control" required  autofocus placeholder="NIK / NPM" value="{{ old('nik', null) }}">

                @if($errors->has('nik'))
                    <p class="help-block">
                        {{ $errors->first('nik') }}
                    </p>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" name="password" class="form-control" required placeholder="Password">

                @if($errors->has('password'))
                    <p class="help-block">
                        {{ $errors->first('password') }}
                    </p>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label><input type="checkbox" name="remember"> Remember Me!</label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        Login
                    </button>
                </div>
            </div>
        </form>

        @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                Forgot Password
            </a><br>
        @endif


    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
@endsection