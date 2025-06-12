@extends('layouts/template', ['title' => 'Dashboard - ' . config('app.name')])

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Main</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Dashboard</h6>
                    <div id="content">
                        <p>Welcome, {{ auth()->user()->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
