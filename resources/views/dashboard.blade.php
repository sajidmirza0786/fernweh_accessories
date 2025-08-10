@extends('admin.master')

@section('seo')
    <title>Dashboard | Admin Panel</title>
    <meta name="description" content="E-commerce admin dashboard for On Jewel. Overview of sales, orders, and customer data.">
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item active fw-semibold" aria-current="page">
    Overview
</li>
@endsection

@section('content')
    @if(auth()->user()->user_type === "admin")
        @include('admin.dashboard')
    @else

        @include('users.profiles.dashboard')
    @endif
@endsection
