@extends('layouts/template', ['title' => 'Permission - ' . config('app.name')])

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Web Management</li>
            <li class="breadcrumb-item">Account</li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('permissions.index') }}">Permission</a>
            </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-end mb-3 border-bottom">
                        <h6 class="card-title">Permission</h6>
                        <p class="card-description">List of all permission</p>
                    </div>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Permission Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
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
