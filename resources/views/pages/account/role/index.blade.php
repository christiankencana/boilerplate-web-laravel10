@extends('layouts/template', ['title' => 'Roles - ' . config('app.name')])

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
          <h6 class="card-title">Roles</h6>
          <p class="card-description">List of all role</p>
          @if(auth()->user()->hasAnyPermission(['roles.create']))
          <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">
            <i class="small-icon" data-feather="plus"></i>
          </a>
          @endif
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

        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr class="text-center">
                <th>Roles Name</th>
                <th>Permission</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($roles as $role)
              <tr>
                <td>{{ $role->name }}</td>
                <td class="text-center">
                  <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#permissionsModal-{{ $role->id }}">
                    <i class="small-icon" data-feather="info"></i>
                  </button>
                </td>
                <td class="text-center">
                  @if(auth()->user()->hasAnyPermission(['roles.edit']))
                  <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">
                    <i class="small-icon" data-feather="edit"></i>
                  </a>
                  @endif
                  @if(!auth()->user()->hasRole($role->name) && auth()->user()->hasAnyPermission(['roles.delete']))
                  <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">
                      <i class="small-icon" data-feather="delete"></i>
                    </button>
                  </form>
                  @endif
                </td>
              </tr>

              <div class="modal fade" id="permissionsModal-{{ $role->id }}" tabindex="-1" aria-labelledby="permissionsModalLabel-{{ $role->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="permissionsModalLabel-{{ $role->id }}">Permissions for {{ $role->name }}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <ul class="list-group">
                        @foreach ($role->permissions as $permission)
                        <li class="list-group-item">{{ $permission->name }}</li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
