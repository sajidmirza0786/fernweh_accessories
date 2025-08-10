@extends('users.master')

@section('seo')
<title>{{ $category->name ?? '' }}</title>
<meta name="description" content="{{ $category->description ?? '' }}">
<meta name="keywords" content="{{ $category->keywords ?? '' }}">
@endsection

@section('content')

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">

<div class="container-fluid mt-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent p-0 mb-3" style="font-size: 0.9rem; font-family: 'Roboto', sans-serif;">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-primary">Home</a></li>
            <li class="breadcrumb-item active font-weight-bold" aria-current="page">{{ $category->name ?? '' }}</li>
        </ol>
    </nav>
</div>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-lg-3 col-md-4 mb-4">
            <!-- Mobile Toggle -->
            <button class="btn btn-outline-primary d-block d-md-none mb-3" type="button" data-toggle="collapse" data-target="#categoryFilter" aria-expanded="false" aria-controls="categoryFilter">
                Filter Categories
            </button>
            
            <div class="collapse d-md-block" id="categoryFilter">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white font-weight-bold border-0" style="font-family: 'Roboto', sans-serif;">
                        Categories
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($categories ?? [] as $cat)
                            <li class="list-group-item border-0 py-2 {{ $cat->id == $category->id ? 'active-category' : '' }}">
                                <a href="{{ route('products', $cat) }}" 
                                   class="d-block {{ $cat->id == $category->id ? 'text-primary font-weight-bold' : 'text-dark' }}">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Product Listing -->
        <div class="col-lg-9 col-md-8">
            <div class="row">
                @if($products->count() > 0)
                    @foreach($products as $product)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-6 mb-4 p-2">
                            <div class="card product-card border-0 shadow-sm h-100">
                                <a href="{{ route('products', $product) }}" class="d-block">
                                    <img src="{{ \Storage::url($product->image ?? '') }}" 
                                         class="card-img-top" 
                                         alt="{{ $product->name ?? '' }}">
                                </a>
                                <div class="card-body p-2" style="font-family: 'Roboto', sans-serif;">
                                    <h6 class="card-title mb-1 text-truncate" title="{{ $product->name ?? '' }}">
                                        <a href="{{ route('products', $product) }}" class="text-dark">
                                            {{ $product->name ?? '' }}
                                        </a>
                                    </h6>

                                    <!-- Color and Size -->
                                    @if(!empty($product->color) || !empty($product->size))
                                        <p class="mb-1 text-muted" style="font-size: 0.85rem;">
                                            @if(!empty($product->color))
                                                <strong>Color:</strong> {{ $product->color }}
                                            @endif
                                            @if(!empty($product->size))
                                                <span class="ml-2"><strong>Size:</strong> {{ $product->size }}</span>
                                            @endif
                                        </p>
                                    @endif

                                    <!-- Prices -->
                                    @if(!empty($product->selling))
                                        <p class="text-success font-weight-bold mb-1">
                                            ₹{{ number_format($product->selling) }}
                                            @if(!empty($product->mrp) && $product->mrp > $product->selling)
                                                <small class="text-muted ml-1"><del>₹{{ number_format($product->mrp) }}</del></small>
                                            @endif
                                        </p>
                                    @elseif(!empty($product->mrp))
                                        <p class="text-danger font-weight-bold mb-1">
                                            ₹{{ number_format($product->mrp) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <h5 class="text-center text-muted py-5" style="font-family: 'Roboto', sans-serif;">Products Not Found</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
body {
    font-family: 'Roboto', sans-serif;
}
/* Product Card */
.product-card {
    border-radius: 8px;
    transition: box-shadow 0.2s ease-in-out, transform 0.2s ease-in-out;
}
.product-card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}
.product-card img {
    object-fit: cover;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

/* Active Category */
.active-category {
    background-color: rgba(0, 123, 255, 0.08);
    border-radius: 4px;
}
.active-category a {
    color: #007bff !important;
}

/* Breadcrumb Styling */
.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: #6c757d;
}
</style>
@endsection
