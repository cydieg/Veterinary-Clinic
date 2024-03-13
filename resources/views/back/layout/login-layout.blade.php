
<div class="login-box bg-white box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-primary">Admin login</h2>
    </div>
    <form action="{{ route('admin.login_handler') }}" method="POST">
        @csrf

        @if (Session::get('fall'))
            <div class="alert alert-danger">
                {{ Session::get('fall') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="input-group custom mb-3">
            <input type="text" class="form-control form-control-lg" placeholder="Email/Username" name="login_id" value="{{ old('login_id') }}">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
            </div>
        </div>

        @error('login_id')
            <div class="text-danger small" style="margin-top: -10px; margin-bottom: 5px; text-align: left;">
                {{ $message }}
            </div>
        @enderror

        <div class="input-group custom mb-3">
            <input type="password" class="form-control form-control-lg" placeholder="********" name="password">
            <div class="input-group-append custom">
                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>    
            </div>
        </div>

        @error('password')
            <div class="text-danger small" style="margin-top: -10px; margin-bottom: 5px; text-align: left;">
                {{ $message }}
            </div>
        @enderror

        <div class="row pb-30">
            <div class="col-6">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Remember</label>
                </div>
            </div>
            <div class="col-6">
                <div class="forgot-password">
                    <a href="{{route('admin.forgot-password')}}">Forgot Password</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="input-group mb-0">
                    <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                </div>
            </div>
        </div>
    </form>
</div>
