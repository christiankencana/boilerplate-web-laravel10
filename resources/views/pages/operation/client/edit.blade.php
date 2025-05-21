@extends('layouts/template', ['title' => 'Edit Client - ' . config('app.name')])

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
        <h6 class="card-title">Edit Client</h6>

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

        <form action="{{ route('clients.update', $client->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="client_code">Client Code</label>
            <input type="text" name="client_code" class="form-control" id="client_code" value="{{ $client->client_code }}" required>
          </div>
          <div class="form-group">
            <label for="client_name">Client Name</label>
            <input type="text" name="client_name" class="form-control" id="client_name" value="{{ $client->client_name }}" required>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back</a>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
