@extends('admin.master')

@section('seo')
    <title>{{ $product->name }} - Product Details</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
    <li class="breadcrumb-item active fw-semibold">{{ $product->name }}</li>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1">
                        <i class='bx bx-package text-primary me-2'></i>
                        Product Details
                    </h4>
                    <p class="text-muted mb-0 small">View complete product information</p>
                </div>
                <div>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm me-2">
                        <i class='bx bx-edit me-1'></i>
                        Edit Product
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class='bx bx-arrow-back me-1'></i>
                        Back to List
                    </a>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 fw-semibold">
                                <i class='bx bx-image me-2'></i>
                                Product Image
                            </h6>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between text-center">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                        class="img-fluid rounded border shadow-sm" 
                                        alt="{{ $product->name }}"
                                        style="max-height: 250px; object-fit: cover;">
                            @else
                                <div class="text-muted py-5">
                                    <i class='bx bx-image' style="font-size: 64px; opacity: 0.5;"></i>
                                    <div class="mt-3">
                                        <h6>No Image Available</h6>
                                        <small>Product image not uploaded</small>
                                    </div>
                                </div>
                            @endif

                            <div class="mt-4 pt-3 border-top">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong class="text-muted small">MRP Price:</strong>
                                    <span class="fs-5 fw-bold text-decoration-line-through text-muted">{{ $product->mrp ? '₹' . number_format($product->mrp, 2) : 'N/A' }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong class="text-muted small">Selling Price:</strong>
                                    <span class="fs-4 fw-bold text-success">{{ $product->selling ? '₹' . number_format($product->selling, 2) : 'N/A' }}</span>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Fixed Upload Form -->
                            <div class="upload-section">
                                <h6 class="text-dark mb-3 fw-semibold">
                                    <i class="bi bi-cloud-arrow-up me-2"></i>Upload More Images
                                </h6>
                                <form action="{{ route('admin.products.images.store', $product) }}" method="POST" enctype="multipart/form-data" class="text-start">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="additional_images" class="form-label fw-semibold">
                                            Select Images to Upload 
                                            <span class="text-danger">(Recommended: 800×800px)</span>
                                        </label>
                                        <input type="file" name="image" id="additional_images" class="form-control" accept="image/*" required>
                                        <small class="text-muted">Supported formats: JPG, PNG, WEBP</small>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-upload me-1"></i> Upload Image
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 fw-semibold">
                                <i class='bx bx-info-circle me-2'></i>
                                Product Information
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong class="text-muted small">Product Name:</strong>
                                    <p class="fw-semibold fs-5 mb-0">{{ $product->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong class="text-muted small">Product Code:</strong>
                                    <p class="fw-semibold fs-5 mb-0">{{ $product->code ?: 'N/A' }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong class="text-muted small">Category:</strong>
                                    <p>
                                        @if($product->category)
                                            <span class="btn btn-default btn-sm text-dark border fs-6">
                                                <i class='bx bx-category me-1'></i>
                                                {{ $product->category->name }}
                                            </span>
                                        @else
                                            <span class="text-muted">No Category Assigned</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <strong class="text-muted small">Status:</strong>
                                    <p>
                                        <span class="btn btn-sm btn-{{ $product->status === 'Active' ? 'success' : 'secondary' }}">
                                            <i class='bx bx-{{ $product->status === 'Active' ? 'check' : 'x' }} me-1'></i>
                                            {{ ucfirst($product->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            
                            {{-- New section for Colors and Sizes --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong class="text-muted small">Colors:</strong>
                                    <p>
                                        @if($product->colors)
                                            @foreach(explode(',', $product->colors) as $color)
                                                <span class="badge rounded-pill bg-secondary me-1">{{ trim($color) }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <strong class="text-muted small">Sizes:</strong>
                                    <p>
                                        @if($product->sizes)
                                            @foreach(explode(',', $product->sizes) as $size)
                                                <span class="badge rounded-pill bg-light text-dark border me-1">{{ trim($size) }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <strong class="text-muted small">Short Description:</strong>
                                <p class="text-muted">{{ $product->description ?: 'No short description provided.' }}</p>
                            </div>

                            <div class="mb-3">
                                <strong class="text-muted small">Keywords:</strong>
                                <p class="text-muted">{{ $product->keyword ?: 'No keywords provided.' }}</p>
                            </div>
                            
                            <hr class="my-3">

                            <div class="row">
                                <div class="col-md-6">
                                    <strong class="text-muted small">Created On:</strong>
                                    <p class="small mb-0">{{ $product->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong class="text-muted small">Last Updated:</strong>
                                    <p class="small mb-0">{{ $product->updated_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            @if($product->images->count() > 0)
                                <h6 class="text-muted border-bottom pb-2 mb-3">Additional Images</h6>
                                <div class="row g-2 justify-content-center additional-images-gallery">
                                    @foreach($product->images as $image)
                                        <div class="col-4 col-md-3 col-lg-2">
                                            <div class="position-relative">
                                                <img src="{{ asset('storage/' . $image->image_path) }}" class="img-thumbnail thumbnail-img w-100" alt="Product thumbnail" data-full-size="{{ asset('storage/' . $image->image_path) }}">
                                                {{-- Add delete button for each additional image --}}
                                                <form action="{{ route('admin.products.images.destroy', [$product, $image]) }}" method="POST" class="image-delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm w-100 rounded-0 delete-image-btn" title="Delete Image">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted fst-italic mt-3">No additional images uploaded.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0 fw-semibold">
                        <i class='bx bx-detail me-2'></i>
                        Long Description
                    </h6>
                </div>
                <div class="card-body">
                    @if($product->long_description)
                        <div class="ck-content">
                            {!! $product->long_description !!}
                        </div>
                    @else
                        <div class="text-muted text-center py-4">No detailed description provided.</div>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" 
                        class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class='bx bx-trash me-1'></i>
                        Delete Product
                    </button>
                </form>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
                    <i class='bx bx-edit me-1'></i>
                    Edit Product
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 12px;
    border: 1px solid #e3e6f0;
}

.card-header {
    border-bottom: 1px solid #e3e6f0;
    background-color: #f8f9fa !important;
}

.badge {
    font-size: 0.8em;
    padding: 0.5em 0.75em;
}

.ck-content {
    line-height: 1.6;
    color: #495057;
}

/* Style for embedded images in CKEditor content */
.ck-content img {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 1rem 0;
}

.btn {
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

@media (max-width: 768px) {
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 15px;
    }
    
    .d-flex.justify-content-end {
        justify-content: center;
    }
}
</style>
@endsection