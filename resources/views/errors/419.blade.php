@extends('users.master')

@section('seo')
    <title>419 Page Expired | Fernweh Premium Accessories</title>
    <meta name="description" content="Page expired - Fernweh Premium Accessories">
    <meta name="author" content="Fernweh Premium Accessories">
@endsection

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1">419</h1>
    <h2 class="mb-4">Page Expired</h2>
    <p class="lead">Sorry, your session has expired. Please refresh and try again.</p>
    <a href="{{ url()->previous() ?: url('/') }}" class="btn btn-primary mt-3">Go Back</a>
</div>
@endsection
