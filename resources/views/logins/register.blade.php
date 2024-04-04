@extends('back.layout.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Register')
@section('content')

<div class="login-box bg-white box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-primary">Personal Information</h2>
    </div>
    
    <form action="{{ route('register') }}" method="post">
        @csrf <!-- Add CSRF token -->

        <div class="row mb-2">
            <div class="col-12">
                <div class="input-group custom">
                    <input type="text" class="form-control form-control-lg" placeholder="Username" name="username" required>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group custom">
                    <input type="text" class="form-control form-control-lg" placeholder="First Name" name="firstName" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group custom">
                    <input type="text" class="form-control form-control-lg" placeholder="Last Name" name="lastName" required>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group custom">
                    <input type="text" class="form-control form-control-lg" placeholder="Middle Name" name="middleName">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group custom">
                    <select class="form-control form-control-lg" id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group custom">
                    <input type="text" class="form-control form-control-lg" placeholder="Address" name="address" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group custom">
                    <input type="number" class="form-control form-control-lg" placeholder="Age" name="age" required>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="input-group custom">
                    <input type="email" class="form-control form-control-lg" placeholder="Email" name="email" required>
                </div>
            </div>
            <div class="col-md-6">
               
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-12">
                <div class="input-group custom">
                    <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" required>
                </div>
            </div>
        </div>

        <div class="text-center mt-2">
            <p>Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a></p>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-0">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection
