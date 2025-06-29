@extends('layouts/template', ['title' => 'Create Company - ' . config('app.name')])

@section('content')

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Web Management</li>
            <li class="breadcrumb-item">Operation</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('companies.index') }}">Company</a></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create Company</h6>

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

                    <form action="{{ route('companies.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="client_id">Client</label>
                            <select name="client_id" class="form-control select2-single" id="client_id" required>
                                <option value="">Select Client</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="company_code">Company Code</label>
                            <input type="text" name="company_code" class="form-control" id="company_code"
                                value="{{ old('company_code', $recommended_code) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="company_main_name">Company Name</label>
                            <input type="text" name="company_main_name" class="form-control" id="company_main_name"
                                placeholder="Enter company name" required>
                        </div>
                        <div class="form-group">
                            <label for="company_alternative_name">Company Alternative Name</label>
                            <input type="text" name="company_alternative_name" class="form-control"
                                id="company_alternative_name"
                                placeholder="Optional - Enter alternative name (max 4 letters)" maxlength="4">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
