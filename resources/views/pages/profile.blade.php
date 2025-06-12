@extends('layouts/template', ['title' => 'Profile - ' . config('app.name')])

@section('content')

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-end mb-3 border-bottom">
                        <h6 class="card-title">Profile</h6>
                        <p class="card-description">Update your profile details</p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('profiles.update', $user->id) }}" method="POST" enctype="multipart/form-data">
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
                                @if (auth()->user()->hasRole('Administrator') &&
                                        auth()->user()->hasAnyPermission(['profiles.role']))
                                    <div class="form-group">
                                        <label for="roles">Roles</label>
                                        <select class="select2-multiple" id="roles" name="roles[]" multiple>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    @if ($user->roles->pluck('name')->contains($role->name)) selected @endif>{{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @elseif(
                                    !auth()->user()->hasRole('Administrator') &&
                                        auth()->user()->hasAnyPermission(['profiles.role']))
                                    <div class="form-group">
                                        <label for="roles">Roles</label>
                                        <select class="select2-single" id="roles" name="roles[]">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    @if ($user->roles->pluck('name')->contains($role->name)) selected @endif>{{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if (auth()->user()->hasRole('Administrator') &&
                                        auth()->user()->hasAnyPermission(['profiles.company']))
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
                                @elseif(
                                    !auth()->user()->hasRole('Administrator') &&
                                        auth()->user()->hasAnyPermission(['profiles.company']))
                                    <div class="form-group">
                                        <label for="companies">Companies</label>
                                        <select class="form-control select2-single" id="companies" name="companies[]">
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    @if ($user->companies->pluck('id')->contains($company->id)) selected @endif>
                                                    {{ $company->company_main_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                @foreach ($user->roles as $role)
                                    <input type="hidden" name="roles[]" value="{{ $role->name }}">
                                @endforeach
                                @foreach ($user->companies as $company)
                                    <input type="hidden" name="companies[]" value="{{ $company->id }}">
                                @endforeach
                                <button type="submit" class="btn btn-primary mt-1">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
