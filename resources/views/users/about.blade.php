@extends('users.master')

@section('seo')
<title>About | Fernweh Premium Accessories</title>
<meta name="description" content="About | Fernweh Premium Accessories">
<meta name="author" content="Fernweh Premium Accessories">
@endsection

@section('content')
<!-- Breadcrumb Navigation -->
<nav aria-label="breadcrumb" class="bg-white border-bottom">
    <div class="container py-3">
        <ol class="breadcrumb mb-0 bg-white px-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}" class="text-muted">Home</a>
            </li>
            <li class="breadcrumb-item active text-dark" aria-current="page">
                About Us
            </li>
        </ol>
    </div>
</nav>

<!-- Page Title -->
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">
            <h1 class="font-weight-bold mb-3" style="font-size: 2rem;">About Us</h1>
            <p class="text-muted mb-4">We have over 20 years of experience delivering premium leather accessories that combine craftsmanship and innovation.</p>
        </div>
    </div>
</div>

<!-- About Section -->
<div class="container pb-5 border-bottom">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <h2 class="h4 mb-3">Who We Are</h2>
            <p>Royal Enterprises, established in 2000, is a renowned manufacturer, exporter, and supplier of laptop bags, backpacks, duffle bags, and more. We are committed to quality and design excellence, ensuring every product meets industry standards.</p>
            <p>Our dedicated quality supervisors carefully inspect each stage of production to ensure perfection and customer satisfaction.</p>
        </div>
        <div class="col-md-6">
            <img src="{{ url('users/assets/images/about-1-570x350.jpg') }}" alt="About | Fernweh Premium Accessories" class="img-fluid rounded shadow-sm">
        </div>
    </div>
</div>

<!-- Infrastructure Section -->
<div class="container py-5 border-bottom">
    <h3 class="h5 font-weight-bold mb-3">Our Infrastructure</h3>
    <p class="mb-4">Our well-equipped infrastructure includes dedicated units for quality testing, production, and packaging — ensuring every product meets our premium standards.</p>
    <p class="mb-2 font-weight-bold">Our facilities include:</p>
    <ul class="list-unstyled pl-3">
        <li>• Production department</li>
        <li>• Quality testing unit</li>
        <li>• Research & Development</li>
        <li>• Packaging unit</li>
        <li>• Transportation unit</li>
    </ul>
    <p>Trust us with your needs — order today and experience true craftsmanship.</p>
</div>

<!-- Stats Section -->
<div class="container py-5">
    <div class="row text-center">
        <div class="col-6 col-md-3 mb-4">
            <h2 class="font-weight-bold mb-0">45</h2>
            <small class="text-muted">Products</small>
        </div>
        <div class="col-6 col-md-3 mb-4">
            <h2 class="font-weight-bold mb-0">1280</h2>
            <small class="text-muted">Happy Clients</small>
        </div>
        <div class="col-6 col-md-3 mb-4">
            <h2 class="font-weight-bold mb-0">3</h2>
            <small class="text-muted">Cities</small>
        </div>
        <div class="col-6 col-md-3 mb-4">
            <h2 class="font-weight-bold mb-0">70+</h2>
            <small class="text-muted">Employees</small>
        </div>
    </div>
</div>
@endsection
