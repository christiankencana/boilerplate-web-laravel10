@extends('layouts/auth', ['title' => 'Register - ' . config('app.name')])

@section('content')

    <div class="card border-0 shadow rounded">
        <div class="card-body p-3">
            @if (session('status'))
                <div class="alert alert-success py-2 mb-2" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger py-2 mb-2">
                    @foreach ($errors->all() as $error)
                        <p class="mb-1">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <h4 class="font-weight-bold text-center">Register</h4>
            <hr>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-uppercase small">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control form-control-sm @error('name') is-invalid @enderror"
                                placeholder="Enter Full Name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-uppercase small">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control form-control-sm @error('email') is-invalid @enderror"
                                placeholder="Enter Email Address">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-uppercase small">Role</label>
                            <select name="roles"
                                class="form-control form-control-sm @error('roles') is-invalid @enderror">
                                <option value="" disabled selected>Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('roles') == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('roles')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-uppercase small">Companies</label>
                            <select name="companies"
                                class="form-control form-control-sm @error('companies') is-invalid @enderror">
                                <option value="" disabled selected>Select Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"
                                        {{ old('companies') == $company->id ? 'selected' : '' }}>
                                        {{ $company->company_main_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('companies')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-uppercase small">Password</label>
                            <input type="password" name="password"
                                class="form-control form-control-sm @error('password') is-invalid @enderror"
                                placeholder="Enter Password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-uppercase small">Confirmation Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-sm"
                                placeholder="Enter Confirmation Password">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-2">Register</button>
            </form>
        </div>
    </div>
    <div class="login mt-2 text-center">
        <p class="mb-0">Already have an account? Login <a href="/login">here</a></p>
    </div>

@endsection
