@extends('back.layout.auth-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Login')

@section('content')

<div class="login-box bg-white box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-primary">Login</h2>
    </div>

    @if (Session::has('notification'))
        <div class="alert alert-success">
            {{ Session::get('notification') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="post">
        @csrf

        <div class="input-group custom mb-3">
            <input type="email" class="form-control form-control-lg" placeholder="Email" name="email" required>
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
            </div>
        </div>

        <div class="input-group custom mb-3">
            <input type="password" class="form-control form-control-lg" placeholder="********" name="password" required>
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
            </div>
        </div>

        <div class="row pb-30">
            <div class="col-6">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Remember</label>
                </div>
            </div>

            <div class="col-6 text-right">
                <a href="{{ route('register.form') }}" class="text-primary">Register</a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-0">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
