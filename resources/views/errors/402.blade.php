@extends('users.master')

@section('seo')
    <title>402 Payment Required | Fernweh Premium Accessories</title>
    <meta name="description" content="Payment required - Fernweh Premium Accessories">
    <meta name="author" content="Fernweh Premium Accessories">
@endsection

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1">402</h1>
    <h2 class="mb-4">Payment Required</h2>
    <p class="lead">Payment is required to proceed.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Home</a>
</div>
@endsection
