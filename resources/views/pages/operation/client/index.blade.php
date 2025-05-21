@extends('layouts/template', ['title' => 'Client - ' . config('app.name')])

@section('content')

<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Web Management</li>
    <li class="breadcrumb-item">Operation</li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('clients.index') }}">Client</a></li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-end mb-3 border-bottom">
          <h6 class="card-title">Client</h6>
          <p class="card-description">List of all clients</p>
          @if(auth()->user()->hasAnyPermission(['clients.create']))
          <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">
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
                <th>Client Code</th>
                <th>Client Name</th>
                @if(auth()->user()->hasAnyPermission(['clients.edit']) || auth()->user()->hasAnyPermission(['clients.delete']))
                <th>Actions</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($clients as $client)
              <tr>
                <td>{{ $client->client_code }}</td>
                <td>{{ $client->client_name }}</td>
                @if(auth()->user()->hasAnyPermission(['clients.edit']) || auth()->user()->hasAnyPermission(['clients.delete']))
                <td class="text-center">
                  <!-- <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info">View</a> -->
                  @if (auth()->user()->hasAnyPermission(['clients.edit']))
                  <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">
                    <i class="small-icon" data-feather="edit"></i>
                  </a>
                  @endif
                  @if(auth()->user()->hasAnyPermission(['clients.delete']))
                  <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                      <i class="small-icon" data-feather="trash-2"></i>
                    </button>
                  </form>
                  @endif
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
