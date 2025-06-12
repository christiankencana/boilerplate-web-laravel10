@extends('layouts/template', ['title' => 'Set Locations for ' . $company->company_main_name . ' - ' . config('app.name')])

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
                    <h6 class="card-title">Set Locations for : {{ $company->company_main_name }}</h6>
                    <a href="{{ route('companies.index') }}" class="btn btn-secondary mb-3">Back</a>
                    @if (auth()->user()->hasAnyPermission(['companies.create']))
                        <a href="{{ route('companies.locations.create', ['company' => $company->id]) }}"
                            class="btn btn-primary mb-3 float-right">
                            <i class="small-icon" data-feather="plus"></i>
                        </a>
                    @endif

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
                                    <th>Name</th>
                                    <th>Address</th>
                                    @if (auth()->user()->hasAnyPermission(['companies.edit']) ||
                                            auth()->user()->hasAnyPermission(['companies.delete']))
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations as $location)
                                    <tr>
                                        <td>{{ $location->location_name }}</td>
                                        <td>{{ $location->location_address }}</td>
                                        @if (auth()->user()->hasAnyPermission(['companies.edit']) ||
                                                auth()->user()->hasAnyPermission(['companies.delete']))
                                            <td class="text-center">
                                                @if (auth()->user()->hasAnyPermission(['companies.edit']))
                                                    <a href="{{ route('companies.locations.edit', ['company' => $company->id, 'location' => $location->id]) }}"
                                                        class="btn btn-warning">
                                                        <i class="small-icon" data-feather="edit"></i>
                                                    </a>
                                                @endif
                                                @if (auth()->user()->hasAnyPermission(['companies.delete']))
                                                    <form
                                                        action="{{ route('companies.locations.destroy', ['company' => $company->id, 'location' => $location->id]) }}"
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
