@extends('layouts/template', ['title' => 'Users - ' . config('app.name')])

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
          <h6 class="card-title">Users</h6>
          <p class="card-description">List of all user</p>
          @if(auth()->user()->hasAnyPermission(['users.create']))
          <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
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
                <th>Photo</th>
                <th>User</th>
                <th>Status Account</th>
                <th>Roles</th>
                <th>Companies</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                <td class="text-center">
                  <img src="{{ $user->profile_photo ? Storage::url($user->profile_photo) : asset('profile-pic.png') }}" alt="Profile Photo" width="50" height="50" class="rounded-circle">
                </td>
                <td>{{ $user->name }}</td>
                <td class="text-center">
                  @if(auth()->user()->hasAnyPermission(['users.edit']))
                  <form action="{{ route('users.updateStatus', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <input type="checkbox" name="status_account" value="active" onchange="this.form.submit()" {{ $user->status_account == 'active' ? 'checked' : '' }}>
                  </form>
                  @endif
                </td>
                <td class="text-center">
                  <!-- {{ $user->roles->implode('name', ', ') }} -->
                  <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#rolesModal-{{ $user->id }}">Set Roles</button>
                </td>
                <td class="text-center">
                  <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#companiesModal-{{ $user->id }}">Set Companies</button>
                </td>
                <td class="text-center">
                  @if(auth()->user()->hasAnyPermission(['users.edit']))
                  <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                    <i class="small-icon" data-feather="edit"></i>
                  </a>
                  @endif
                  @if(auth()->user()->hasAnyPermission(['users.delete']))
                  <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">
                      <i class="small-icon" data-feather="trash-2"></i>
                    </button>
                  </form>
                  @endif
                </td>
              </tr>

              <!-- Roles Modal -->
              <div class="modal fade" id="rolesModal-{{ $user->id }}" tabindex="-1" aria-labelledby="rolesModalLabel-{{ $user->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="rolesModalLabel-{{ $user->id }}">Set Roles for : {{ $user->name }}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('users.updateRoles', $user->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                          <small for="roles" class="form-text text-muted text-italic">Select multiple roles using ctrl + left click</small>
                        </div>
                        <div class="form-group">
                          <select class="select2-multiple" id="roles" name="roles[]" style="width: 100%" multiple>
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @if($user->roles->pluck('name')->contains($role->name)) selected @endif>{{ $role->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Update Roles</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Companies Modal -->
              <div class="modal fade" id="companiesModal-{{ $user->id }}" tabindex="-1" aria-labelledby="companiesModalLabel-{{ $user->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="companiesModalLabel-{{ $user->id }}">Set Companies for : {{ $user->name }}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('users.updateCompanies', $user->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                          <small for="companies" class="form-text text-muted text-italic">Select multiple companies using ctrl + left click</small>
                        </div>
                        <div class="form-group">
                          <select class="select2-multiple" id="companies" name="companies[]" style="width: 100%" multiple>
                            @foreach ($companies as $company)
                            <option value="{{ $company->id }}" @if($user->companies->pluck('id')->contains($company->id)) selected @endif>{{ $company->company_main_name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Update Companies</button>
                        </div>
                      </form>
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

<!-- Custom Script (Single Component) -->
@push('scripts')
<script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>
<script>
  $(document).ready(function() {
    $('.modal').on('shown.bs.modal', function() {
      $(this).find('.select2-multiple').each(function() {
        if ($(this).data('select2')) {
          $(this).select2('destroy');
        }
        $(this).select2({
          dropdownParent: $(this).closest('.modal-content'),
          theme: "classic",
          placeholder: 'Select Data',
          allowClear: true
        });
      });
    });
  });
</script>
@endpush

@endsection
