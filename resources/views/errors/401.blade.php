@extends('users.master')

@section('seo')
    <title>401 Unauthorized | Fernweh Premium Accessories</title>
    <meta name="description" content="Unauthorized access - Fernweh Premium Accessories">
    <meta name="author" content="Fernweh Premium Accessories">
@endsection

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1">401</h1>
    <h2 class="mb-4">Unauthorized</h2>
    <p class="lead">You are not authorized to access this page.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Home</a>
</div>
@endsection
