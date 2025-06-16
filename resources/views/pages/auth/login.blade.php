@extends('layouts/auth', ['title' => 'Login - ' . config('app.name')])

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

        <h4 class="font-weight-bold text-center">Login</h4>
        <hr>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="font-weight-bold text-uppercase">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address">
                @error('email')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="font-weight-bold text-uppercase">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password">
                @error('password')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block align-center">Login</button>
            <hr>

            <a href="{{ route('password.request') }}">Forgot Password ?</a>
        </form>
    </div>
</div>
<div class="register mt-3 text-center">
    <p>Don't have an account? Register <a href="{{ route('register') }}">here</a></p>
</div>

@endsection
