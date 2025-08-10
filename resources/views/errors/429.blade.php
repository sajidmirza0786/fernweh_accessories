@extends('users.master')

@section('seo')
    <title>429 Too Many Requests | Fernweh Premium Accessories</title>
    <meta name="description" content="Too many requests - Fernweh Premium Accessories">
    <meta name="author" content="Fernweh Premium Accessories">
@endsection

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1">429</h1>
    <h2 class="mb-4">Too Many Requests</h2>
    <p class="lead">You have sent too many requests in a short period. Please try again later.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Home</a>
</div>
@endsection
