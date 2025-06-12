@extends('layouts/email')

@section('content')
    <h1 class="text-primary">{{ $data['title'] }}</h1>
    <p>{{ $data['message'] }}</p>
    <a href="{{ $data['button_url'] }}" class="btn btn-primary">{{ $data['button_text'] }}</a>
    <p><small>Please do not reply to this email. If you need assistance, please contact our support team.</small></p>
@endsection
