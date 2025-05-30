@extends('layouts.auth', ['title' => 'Forgot Password - ' . config('app.name')])

@section('content')
<div class="card border-0 shadow rounded">
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <h4 class="font-weight-bold text-center">Forgot Password</h4>
        <hr>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-group">
                <label class="font-weight-bold text-uppercase">Email Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ $request->email ?? old('email') }}" required readonly autocomplete="email" autofocus placeholder="Enter Email Address">
                @error('email')
                <div class="alert alert-danger mt-2">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="font-weight-bold text-uppercase">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password" placeholder="Enter New Password">
                @error('password')
                <div class="alert alert-danger mt-2">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="font-weight-bold text-uppercase">Confirmation Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                    required autocomplete="new-password" placeholder="Enter Confirmation New Password">
            </div>

            <button type="submit" class="btn btn-primary btn-block align-center">Reset Password</button>
        </form>
    </div>
</div>
<div class="login mt-3 text-center">
    <p>Remembered your password? Login <a href="/login">here</a></p>
</div>
<!-- <div class="register mt-3 text-center">
    <p>Don't have an account? Register <a href="/register">here</a></p>
</div> -->
@endsection
