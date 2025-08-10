@extends('users.master')

@section('seo')
    <title>403 Forbidden | Fernweh Premium Accessories</title>
    <meta name="description" content="Forbidden access - Fernweh Premium Accessories">
    <meta name="author" content="Fernweh Premium Accessories">
@endsection

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1">403</h1>
    <h2 class="mb-4">Forbidden</h2>
    <p class="lead">You do not have permission to access this page.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Home</a>
</div>
@endsection
