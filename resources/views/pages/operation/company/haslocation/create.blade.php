@extends('layouts/template', ['title' => 'Add Location - ' . config('app.name')])

@section('content')

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Web Management</li>
            <li class="breadcrumb-item">Operation</li>
            <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Company</a></li>
            <li class="breadcrumb-item"><a href="{{ route('companies.locations.index', $company->id) }}">Set Locations</a>
            </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Add Location for : {{ $company->company_main_name }}</h6>

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

                    <form action="{{ route('companies.locations.store', $company->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="company_id" value="{{ $company->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location_name">Name</label>
                                    <input type="text" name="location_name" class="form-control" id="location_name"
                                        placeholder="Enter Location Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location_address">Address</label>
                                    <input type="text" name="location_address" class="form-control" id="location_address"
                                        placeholder="Enter Location Address" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Location</button>
                        <a href="{{ route('companies.locations.index', $company->id) }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
