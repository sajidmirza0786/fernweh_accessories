@extends('users.master')

@section('seo')
    <title>503 Service Unavailable | Fernweh Premium Accessories</title>
    <meta name="description" content="Service temporarily unavailable - Fernweh Premium Accessories">
    <meta name="author" content="Fernweh Premium Accessories">
@endsection

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1">503</h1>
    <h2 class="mb-4">Service Unavailable</h2>
    <p class="lead">Sorry, the service is temporarily unavailable. Please try again later.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Home</a>
</div>
@endsection
