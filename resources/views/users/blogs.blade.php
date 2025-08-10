@extends('users.master')

@section('seo')
<title>Blogs | Fernweh Premium Accessories</title>
<meta name="description" content="Blogs | Fernweh Premium Accessories">
<meta name="author" content="Blogs | Fernweh Premium Accessories">
@endsection

@section('content')
<div class="container py-4">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4 border-bottom pb-2">
        <ol class="breadcrumb bg-transparent p-0 mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blogs</li>
        </ol>
    </nav>

    <!-- Heading -->
    <div class="mb-5 text-center">
        <h1 class="h3 font-weight-bold mb-2">Our Blogs</h1>
        <p class="text-muted mb-0">
            Insights, updates, and ideas from our team — written to keep you inspired and informed.
        </p>
    </div>

    <!-- Blog Grid -->
    <div class="row">
        @foreach($blogs ?? '' as $uBlog)
        <div class="col-12 col-sm-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100 blog-card">
                <a href="{{ route('blogsDetails', $uBlog) }}">
                    <img class="card-img-top" src="{{ \Storage::url($uBlog->image ?? '') }}" alt="{{ $uBlog->title ?? '' }}">
                </a>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">
                        <a href="{{ route('blogsDetails', $uBlog) }}" class="text-dark">{{ str($uBlog->name)->limit(35) ?? '' }}</a>
                    </h5>
                    <p class="card-text text-muted small mb-3">
                        {{ str($uBlog->short_description)->limit(80) }}
                    </p>
                </div>
                <div class="card-footer bg-white border-0 pt-0 d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        {{ $uBlog->published_at->format('d M Y') }}
                    </small>
                    <a href="{{ route('blogsDetails', $uBlog) }}" class="text-danger font-weight-bold d-flex align-items-center">
                        <span class="mr-1">Read More</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

<style>
    /* Blog Card Hover */
    .blog-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .blog-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
    .blog-card img {
        transition: transform 0.3s ease;
    }
    .blog-card:hover img {
        transform: scale(1.03);
    }
</style>
@endsection
