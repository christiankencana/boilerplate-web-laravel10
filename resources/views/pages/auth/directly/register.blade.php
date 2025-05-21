@extends('layouts/auth', ['title' => 'Register - ' . config('app.name')])

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

        <h4 class="font-weight-bold text-center">Register</h4>
        <hr>
        <!-- Gunakan ini jika menggunakan Fortify -->
        <!-- <form action="{{ route('register') }}" method="POST"> -->

        <form action="{{ route('register.account') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="font-weight-bold text-uppercase">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Full Name">
                @error('name')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>

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

            <div class="form-group">
                <label class="font-weight-bold text-uppercase">Confirmation Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Confirmation Password">
            </div>

            <button type="submit" class="btn btn-primary btn-block align-center">Register</button>
        </form>
    </div>
</div>
<div class="login mt-3 text-center">
    <p>Already have an account? Login <a href="/login">here</a></p>
</div>

@endsection