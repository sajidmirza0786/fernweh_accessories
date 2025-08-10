@extends('users.master')

@section('seo')
    <title>500 Internal Server Error | Fernweh Premium Accessories</title>
    <meta name="description" content="Internal server error - Fernweh Premium Accessories">
    <meta name="author" content="Fernweh Premium Accessories">
@endsection

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1">500</h1>
    <h2 class="mb-4">Internal Server Error</h2>
    <p class="lead">Oops! Something went wrong on our end.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Home</a>
</div>
@endsection
