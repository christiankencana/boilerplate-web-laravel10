@extends('layouts/template', ['title' => 'Create Client - ' . config('app.name')])

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
                    <h6 class="card-title">Create Client</h6>

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

                    <form action="{{ route('clients.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="client_code">Client Code</label>
                            <input type="text" name="client_code" class="form-control" id="client_code"
                                placeholder="Enter client code" required>
                        </div>
                        <div class="form-group">
                            <label for="client_name">Client Name</label>
                            <input type="text" name="client_name" class="form-control" id="client_name"
                                placeholder="Enter company name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
