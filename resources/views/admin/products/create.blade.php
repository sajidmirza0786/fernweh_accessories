@extends('admin.master')

@section('seo')
    <title>{{ $product->exists ? 'Edit' : 'Create' }} Product</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
    <li class="breadcrumb-item active fw-semibold">{{ $product->exists ? 'Edit' : 'Create' }}</li>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary">
                    <h4 class="mb-0 fw-bold text-white">
                        <i class='bx bx-{{ $product->exists ? "edit" : "plus" }} me-2'></i>
                        {{ $product->exists ? 'Edit' : 'Create' }} Product
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if($product->exists)
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-category text-muted me-1'></i>
                                    Category <span class="text-danger">*</span>
                                </label>
                                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-toggle-left text-muted me-1'></i>
                                    Status
                                </label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="Active" @selected(old('status', $product->status ?? 'Active') == 'Active')>
                                        Active
                                    </option>
                                    <option value="Inactive" @selected(old('status', $product->status) == 'Inactive')>
                                        Inactive
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-package text-muted me-1'></i>
                                    Product Name <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $product->name) }}"
                                       placeholder="Enter product name"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-barcode-reader text-muted me-1'></i>
                                    Product Code (optional)
                                </label>
                                <input type="text"
                                       name="code"
                                       class="form-control @error('code') is-invalid @enderror"
                                       value="{{ old('code', $product->code) }}"
                                       placeholder="e.g., P-12345">
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-dollar-circle text-muted me-1'></i>
                                    MRP Price <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="mrp"
                                       class="form-control @error('mrp') is-invalid @enderror"
                                       value="{{ old('mrp', $product->mrp) }}"
                                       placeholder="e.g., 500.00">
                                @error('mrp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-money text-muted me-1'></i>
                                    Selling Price <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       name="selling"
                                       class="form-control @error('selling') is-invalid @enderror"
                                       value="{{ old('selling', $product->selling) }}"
                                       placeholder="e.g., 450.00">
                                @error('selling')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-palette text-muted me-1'></i>
                                    Color (optional)
                                </label>
                                <input type="text"
                                       name="color"
                                       id="color"
                                       class="form-control @error('color') is-invalid @enderror"
                                       value="{{ old('color', $product->color ?? '') }}"
                                       placeholder="e.g., Red, Blue, Black">
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-ruler text-muted me-1'></i>
                                    Size (optional)
                                </label>
                                <input type="text"
                                       name="size"
                                       id="size"
                                       class="form-control @error('size') is-invalid @enderror"
                                       value="{{ old('size', $product->size ?? '') }}"
                                       placeholder="e.g., S, M, L, XL">
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class='bx bx-text text-muted me-1'></i>
                                Short Description
                            </label>
                            <textarea name="description"
                                      class="form-control @error('description') is-invalid @enderror"
                                      rows="3"
                                      placeholder="Brief description for product listing">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Brief description for product listing (SEO)</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class='bx bx-file-text text-muted me-1'></i>
                                Long Description
                            </label>
                            <textarea name="long_description"
                                        id="long_description"
                                        class="form-control @error('long_description') is-invalid @enderror"
                                        rows="6"
                                        placeholder="Detailed product description, specifications, features etc.">{{ old('long_description', $product->long_description) }}</textarea>
                            @error('long_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Detailed description for the product page</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class='bx bx-purchase-tag-alt text-muted me-1'></i>
                                Keywords <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="keyword"
                                   class="form-control @error('keyword') is-invalid @enderror"
                                   value="{{ old('keyword', $product->keyword) }}"
                                   placeholder="Comma-separated keywords for SEO (e.g., phone, samsung, galaxy)">
                            @error('keyword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Keywords for search engine optimization</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class='bx bx-image text-muted me-1'></i>
                                Product Image
                            </label>
                            <input type="file"
                                   name="image"
                                   class="form-control @error('image') is-invalid @enderror"
                                   accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            @if($product->image)
                                <div class="mt-3">
                                    <label class="form-label text-muted small">Current Image:</label>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             width="80"
                                             height="80"
                                             class="rounded border shadow-sm me-3"
                                             style="object-fit: cover;"
                                             alt="Product Image">
                                        <div>
                                            <small class="text-muted d-block">{{ basename($product->image) }}</small>
                                            <small class="text-info">Select a new image to replace</small>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <small class="form-text text-muted">
                                    <i class='bx bx-info-circle me-1'></i>
                                    Recommended size: 800x800px, Max size: 2MB
                                </small>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                                <i class='bx bx-arrow-back me-1'></i>
                                Back to Products
                            </a>
                            <div>
                                <button type="reset" class="btn btn-outline-warning me-2">
                                    <i class='bx bx-reset me-1'></i>
                                    Reset
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class='bx bx-{{ $product->exists ? "save" : "plus" }} me-1'></i>
                                    {{ $product->exists ? 'Update Product' : 'Create Product' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 12px;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.form-label {
    margin-bottom: 8px;
    color: #495057;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #e0e6ed;
    padding: 12px 16px;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    transform: translateY(-1px);
}

.btn {
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.text-danger {
    color: #dc3545 !important;
}

.border-top {
    border-color: #e9ecef !important;
}

@media (max-width: 768px) {
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 15px;
    }
    
    .d-flex.justify-content-between > div {
        display: flex;
        justify-content: center;
        gap: 10px;
    }
}
</style>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Initialize Select2 on the category dropdown
        $('#category_id').select2({
            placeholder: "Select Category",
            allowClear: true
        });

        // Initialize CKEditor 5 on the "long_description" textarea
        ClassicEditor
            .create( document.querySelector( '#long_description' ) )
            .catch( error => {
                console.error( error );
            } );
    });
</script>
@endsection