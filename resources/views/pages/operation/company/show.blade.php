@extends('layouts/template', ['title' => 'Show Company - ' . config('app.name')])

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
                    <h6 class="card-title">Show Company</h6>
                    <div class="form-group">
                        <label for="company_main_name">Company Name:</label>
                        <p>{{ $company->company_main_name }}</p>
                    </div>
                    <a href="{{ route('companies.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
