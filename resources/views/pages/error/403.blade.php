@extends('layouts/error', ['title' => '403 - ' . config('app.name')])

@section('content')

<img src="{{ asset('assets/images/404.svg') }}" class="img-fluid mb-2" alt="403">
<h1 class="font-weight-bold mb-22 mt-2 tx-80 text-muted">403</h1>
<h4 class="mb-2">Access Forbidden</h4>
<h6 class="text-muted mb-3 text-center">Oopps!! Your account is inactive. Please contact support for more information.</h6>
<a href="{{ route('/') }}" class="btn btn-primary">Back to home</a>

@endsection