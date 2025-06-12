@extends('layouts/template', ['title' => 'Edit User - ' . config('app.name')])

@section('content')

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Web Management</li>
            <li class="breadcrumb-item">Account</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route(name: 'users.index') }}">Users</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-end mb-3 border-bottom">
                        <h6 class="card-title">Edit User</h6>
                        <p class="card-description">Edit user details</p>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $user->name }}" placeholder="Enter your name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $user->email }}" placeholder="Enter your email" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter new password">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Confirm new password">
                                </div>
                                <div class="form-group">
                                    <label for="status_account">Status Account</label>
                                    <div>
                                        <label class="mr-2">
                                            <input type="radio" name="status_account" value="active"
                                                {{ $user->status_account == 'active' ? 'checked' : '' }} required> Active
                                        </label>
                                        <label>
                                            <input type="radio" name="status_account" value="inactive"
                                                {{ $user->status_account == 'inactive' ? 'checked' : '' }} required>
                                            Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profile_photo">Profile Photo</label>
                                    <input type="file" class="form-control" id="profile_photo" name="profile_photo"
                                        accept="image/*">
                                    <figure class="my-3 text-center">
                                        <img id="profile_photo_preview"
                                            src="{{ $user->profile_photo ? Storage::url($user->profile_photo) : asset('profile-pic.png') }}"
                                            class="img-fluid rounded-circle border" alt="Profile Photo" width="125">
                                    </figure>
                                </div>
                                <div class="form-group">
                                    <label for="roles">Roles</label>
                                    <select class="form-control select2-multiple" id="roles" name="roles[]" multiple>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                @if ($user->roles->pluck('name')->contains($role->name)) selected @endif>{{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="companies">Companies</label>
                                    <select class="form-control select2-multiple" id="companies" name="companies[]"
                                        multiple>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}"
                                                @if ($user->companies->pluck('id')->contains($company->id)) selected @endif>
                                                {{ $company->company_main_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary mt-1">Back</a>
                                <button type="submit" class="btn btn-primary mt-1">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
