@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{ route('admin.home') }}">
            System Sidang Sarjana
        </a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">
            Register
        </p>
        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input type="text" name="name" class="form-control" required autofocus placeholder="Name" value="{{ old('name', null) }}">
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                    <input type="text" name="nik" class="form-control" required placeholder="nik" value="{{ old('nik', null) }}">
                    @if($errors->has('nik'))
                        <p class="help-block">
                            {{ $errors->first('nik') }}
                        </p>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password" class="form-control" required placeholder="Password">
                    @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="Password Confirm">
                </div>
                <div class="row">
                    <div class="col-xs-8">

                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Register
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection