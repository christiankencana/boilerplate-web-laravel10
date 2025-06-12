@extends('layouts/template', ['title' => 'Company - ' . config('app.name')])

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
                    <div class="d-flex justify-content-between align-items-end mb-3 border-bottom">
                        <h6 class="card-title">Company</h6>
                        <p class="card-description">List of all companies</p>
                        @if (auth()->user()->hasAnyPermission(['companies.create']))
                            <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">
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
                                    <th>Client</th>
                                    <th>Company Code</th>
                                    <th>Company Name</th>
                                    @if (auth()->user()->hasAnyPermission(['companies.edit']))
                                        <th>Location</th>
                                    @endif
                                    @if (auth()->user()->hasAnyPermission(['companies.edit']) ||
                                            auth()->user()->hasAnyPermission(['companies.delete']))
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $company->client->client_code }} - {{ $company->client->client_name }}</td>
                                        <td>{{ $company->company_code }}</td>
                                        <td>{{ $company->company_main_name }}</td>
                                        @if (auth()->user()->hasAnyPermission(['companies.edit']))
                                            <td class="text-center">
                                                <a href="{{ route('companies.locations.index', $company->id) }}"
                                                    class="btn btn-info">Set Location</a>
                                            </td>
                                        @endif
                                        @if (auth()->user()->hasAnyPermission(['companies.edit']) ||
                                                auth()->user()->hasAnyPermission(['companies.delete']))
                                            <td class="text-center">
                                                <!-- <a href="{{ route('companies.show', $company->id) }}" class="btn btn-info">View</a> -->
                                                @if (
                                                    !auth()->user()->companies->contains($company) &&
                                                        auth()->user()->hasAnyPermission(['companies.edit']))
                                                    <a href="{{ route('companies.edit', $company->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="small-icon" data-feather="edit"></i>
                                                    </a>
                                                @endif
                                                @if (
                                                    !auth()->user()->companies->contains($company) &&
                                                        auth()->user()->hasAnyPermission(['companies.delete']))
                                                    <form action="{{ route('companies.destroy', $company->id) }}"
                                                        method="POST" style="display: inline-block;">
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
