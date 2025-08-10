@extends('admin.master')

@section('seo')
    <title>{{ $blog->exists ? 'Edit' : 'Create' }} Blog</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
    <li class="breadcrumb-item active fw-semibold">{{ $blog->exists ? 'Edit' : 'Create' }}</li>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary">
                    <h4 class="mb-0 fw-bold text-white">
                        <i class='bx bx-{{ $blog->exists ? "edit" : "plus" }} me-2'></i>
                        {{ $blog->exists ? 'Edit' : 'Create' }} Blog Post
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ $blog->exists ? route('admin.blogs.update', $blog->id) : route('admin.blogs.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if($blog->exists)
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-text text-muted me-1'></i>
                                    Blog Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $blog->name) }}" placeholder="Enter blog post name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-pencil text-muted me-1'></i>
                                    Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $blog->title) }}" placeholder="Enter blog post title" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-calendar text-muted me-1'></i>
                                    Published Date <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="published_at" class="form-control @error('published_at') is-invalid @enderror" value="{{ old('published_at', $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
                                @error('published_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-toggle-left text-muted me-1'></i>
                                    Status
                                </label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="Active" @selected(old('status', $blog->status ?? 'Active') == 'Active')>Active</option>
                                    <option value="Inactive" @selected(old('status', $blog->status) == 'Inactive')>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class='bx bx-text text-muted me-1'></i>
                                Short Description
                            </label>
                            <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="2" placeholder="Brief summary for blog listing">{{ old('short_description', $blog->short_description) }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class='bx bx-file-text text-muted me-1'></i>
                                Content <span class="text-danger">*</span>
                            </label>
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="6" placeholder="Detailed blog post content">{{ old('content', $blog->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class='bx bx-purchase-tag-alt text-muted me-1'></i>
                                Keywords
                            </label>
                            <input type="text" name="keywords" class="form-control @error('keywords') is-invalid @enderror" value="{{ old('keywords', $blog->keywords) }}" placeholder="Comma-separated keywords for SEO (e.g., laravel, web development, tutorial)">
                            @error('keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class='bx bx-tag text-muted me-1'></i>
                                Tags
                            </label>
                            <input type="text" name="tag" class="form-control @error('tag') is-invalid @enderror" value="{{ old('tag', $blog->tag) }}" placeholder="e.g., featured, news, tutorial">
                            @error('tag')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class='bx bx-video text-muted me-1'></i>
                                Video URL
                            </label>
                            <input type="url" name="video_url" class="form-control @error('video_url') is-invalid @enderror" value="{{ old('video_url', $blog->video_url) }}" placeholder="e.g., https://www.youtube.com/watch?v=xxxxxxxx">
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class='bx bx-image text-muted me-1'></i>
                                Blog Image
                            </label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            @if($blog->image)
                                <div class="mt-3">
                                    <label class="form-label text-muted small">Current Image:</label>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $blog->image) }}" width="80" height="80" class="rounded border shadow-sm me-3" style="object-fit: cover;" alt="Blog Image">
                                        <div>
                                            <small class="text-muted d-block">{{ basename($blog->image) }}</small>
                                            <small class="text-info">Select a new image to replace</small>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <small class="form-text text-muted">
                                    <i class='bx bx-info-circle me-1'></i>
                                    Recommended size: 1200x630px, Max size: 2MB
                                </small>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary">
                                <i class='bx bx-arrow-back me-1'></i>
                                Back to Blogs
                            </a>
                            <div>
                                <button type="reset" class="btn btn-outline-warning me-2">
                                    <i class='bx bx-reset me-1'></i>
                                    Reset
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class='bx bx-{{ $blog->exists ? "save" : "plus" }} me-1'></i>
                                    {{ $blog->exists ? 'Update Blog' : 'Create Blog' }}
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
/* Your CSS styles here */
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
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
    });
</script>
@endsection