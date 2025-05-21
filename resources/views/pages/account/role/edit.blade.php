@extends('layouts/template', ['title' => 'Edit Role - ' . config('app.name')])

@section('content')

<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Web Management</li>
    <li class="breadcrumb-item">Account</li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route(name: 'roles.index') }}">Roles</a></li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-end mb-3 border-bottom">
          <h6 class="card-title">Edit Role</h6>
          <p class="card-description">Edit role details</p>
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

        <form action="{{ route('roles.update', $role->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" placeholder="Enter name" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="permissions">Permissions</label>
                <select class="form-control select2-multiple w-100" id="permissions" name="permissions[]" multiple="multiple" required>
                  @foreach ($permissions as $permission)
                  <option value="{{ $permission->name }}" {{ in_array($permission->name, $role->permissions->pluck('name')->toArray()) ? 'selected' : '' }}>
                    <p class="text-dark">{{ $permission->name }}</p>
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
