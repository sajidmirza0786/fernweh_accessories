@extends('users.master')

@section('seo')
    <title>404 Not Found | Fernweh Premium Accessories</title>
    <meta name="description" content="Page not found - Fernweh Premium Accessories">
    <meta name="author" content="Fernweh Premium Accessories">
@endsection

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1">404</h1>
    <h2 class="mb-4">Page Not Found</h2>
    <p class="lead">Sorry, the page you are looking for could not be found.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Home</a>
</div>
@endsection
