@extends('admin.master')

@section('seo')
    <title>
        {{ $action === 'update' ? "Edit Category: $category->name" : 'Create Category' }} | Admin Panel
    </title>
    <meta name="description"
        content="{{ $action === 'update' ? 'Edit an existing category. Update category details, status, or image.' : 'Create a new category. Fill in the category details and save.' }}">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active fw-semibold" aria-current="page">
        {{ $action === 'update' ? 'Edit' : 'Create' }}
    </li>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary">
                    <h4 class="mb-0 fw-bold text-white">
                        <i class='bx bx-{{ $action === 'update' ? 'edit' : 'plus' }} me-2'></i>
                        {{ $action === 'update' ? 'Edit' : 'Create' }} Category
                    </h4>
                </div>
                <div class="card-body p-4">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ $action === 'update' ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if ($action === 'update')
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-list-ul text-muted me-1'></i>
                                    Category Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $category->name ?? '') }}" required
                                    placeholder="Enter category name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-toggle-left text-muted me-1'></i>
                                    Status <span class="text-danger">*</span>
                                </label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="Active" {{ old('status', $category->status ?? 'Active') == 'Active' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="Inactive" {{ old('status', $category->status ?? '') == 'Inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class='bx bx-purchase-tag-alt text-muted me-1'></i>
                                Keywords
                            </label>
                            <input type="text" name="keyword" class="form-control @error('keyword') is-invalid @enderror"
                                value="{{ old('keyword', $category->keyword ?? '') }}"
                                placeholder="Comma-separated keywords for SEO (e.g., electronics, gadgets, tech)">
                            @error('keyword')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Keywords for search engine optimization</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class='bx bx-text text-muted me-1'></i>
                                Description
                            </label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4"
                                placeholder="Provide a detailed description for the category">{{ old('description', $category->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Detailed description for the category page</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class='bx bx-image text-muted me-1'></i>
                                Category Image
                            </label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if(isset($category->image) && $category->image)
                                <div class="mt-3">
                                    <label class="form-label text-muted small">Current Image:</label>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ Storage::url($category->image) }}" width="80" height="80" class="rounded border shadow-sm me-3" style="object-fit: cover;" alt="Category Image">
                                        <div>
                                            <small class="text-muted d-block">{{ basename($category->image) }}</small>
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
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                                <i class='bx bx-arrow-back me-1'></i>
                                Back to Categories
                            </a>
                            <div>
                                <button type="reset" class="btn btn-outline-warning me-2">
                                    <i class='bx bx-reset me-1'></i>
                                    Reset
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class='bx bx-{{ $action === 'update' ? 'save' : 'plus' }} me-1'></i>
                                    {{ $action === 'update' ? 'Update Category' : 'Create Category' }}
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
        // Initialize Select2 on the parent category dropdown if you want to add it back
        // $('#parent_id').select2({
        //     placeholder: "Select Parent Category",
        //     allowClear: true
        // });
    });
</script>
@endsection