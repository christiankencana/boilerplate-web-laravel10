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

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label class="font-weight-bold text-uppercase">Email Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address">
                @error('email')
                <div class="alert alert-danger mt-2">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block align-center">Send Password Link</button>
        </form>
    </div>
</div>
<div class="login mt-3 text-center">
    <p>Remembered your password? Login <a href="{{ route('login') }}">here</a></p>
</div>
<!-- <div class="register mt-3 text-center">
    <p>Don't have an account? Register <a href="{{ route('register') }}">here</a></p>
</div> -->
@endsection
