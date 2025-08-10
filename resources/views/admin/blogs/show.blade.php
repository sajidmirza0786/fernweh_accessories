@extends('admin.master')

@section('seo')
    <title>{{ $blog->name }} - Blog Details</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
    <li class="breadcrumb-item active fw-semibold">{{ $blog->name }}</li>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1">
                        <i class='bx bx-book-content text-primary me-2'></i>
                        Blog Post Details
                    </h4>
                    <p class="text-muted mb-0 small">View complete blog post information</p>
                </div>
                <div>
                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm me-2">
                        <i class='bx bx-edit me-1'></i>
                        Edit Blog
                    </a>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary btn-sm">
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
                                Featured Image
                            </h6>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between text-center">
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}"
                                     class="img-fluid rounded border shadow-sm"
                                     alt="{{ $blog->name }}"
                                     style="max-height: 250px; object-fit: cover;">
                            @else
                                <div class="text-muted py-5">
                                    <i class='bx bx-image' style="font-size: 64px; opacity: 0.5;"></i>
                                    <div class="mt-3">
                                        <h6>No Image Available</h6>
                                        <small>Featured image not uploaded</small>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="mt-4 pt-3 border-top">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong class="text-muted small">Status:</strong>
                                    <span class="badge bg-{{ $blog->status === 'Active' ? 'success' : 'secondary' }}">
                                        <i class='bx bx-{{ $blog->status === 'Active' ? 'check' : 'x' }} me-1'></i>
                                        {{ ucfirst($blog->status) }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong class="text-muted small">Published On:</strong>
                                    <span class="fw-bold">{{ \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 fw-semibold">
                                <i class='bx bx-info-circle me-2'></i>
                                Blog Information
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong class="text-muted small">Post Name:</strong>
                                    <p class="fw-semibold fs-5 mb-0">{{ $blog->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong class="text-muted small">Post Title:</strong>
                                    <p class="fw-semibold fs-5 mb-0">{{ $blog->title }}</p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <strong class="text-muted small">Author:</strong>
                                <p class="fw-semibold">{{ $blog->created_by }}</p>
                            </div>

                            <div class="mb-3">
                                <strong class="text-muted small">Short Description:</strong>
                                <p class="text-muted">{{ $blog->short_description ?: 'No short description provided.' }}</p>
                            </div>
                            
                            <div class="mb-3">
                                <strong class="text-muted small">Keywords:</strong>
                                <p class="text-muted">{{ $blog->keywords ?: 'No keywords provided.' }}</p>
                            </div>

                            <div class="mb-3">
                                <strong class="text-muted small">Tags:</strong>
                                <p class="text-muted">{{ $blog->tag ?: 'No tags provided.' }}</p>
                            </div>

                            <div class="mb-3">
                                <strong class="text-muted small">Video URL:</strong>
                                <p class="text-muted">
                                    @if($blog->video_url)
                                        <a href="{{ $blog->video_url }}" target="_blank" rel="noopener noreferrer">{{ $blog->video_url }}</a>
                                    @else
                                        No video URL provided.
                                    @endif
                                </p>
                            </div>
                            
                            <hr class="my-3">

                            <div class="row">
                                <div class="col-md-6">
                                    <strong class="text-muted small">Created On:</strong>
                                    <p class="small mb-0">{{ $blog->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong class="text-muted small">Last Updated:</strong>
                                    <p class="small mb-0">{{ $blog->updated_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0 fw-semibold">
                        <i class='bx bx-detail me-2'></i>
                        Content
                    </h6>
                </div>
                <div class="card-body">
                    @if($blog->content)
                        <div class="ck-content">
                            {!! $blog->content !!}
                        </div>
                    @else
                        <div class="text-muted text-center py-4">No detailed content provided.</div>
                    @endif
                </div>
            </div>
            
            <div class="d-flex justify-content-end gap-2 mt-4">
                <form method="POST" action="{{ route('admin.blogs.destroy', $blog->id) }}"
                        class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog post? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class='bx bx-trash me-1'></i>
                        Delete Blog
                    </button>
                </form>
                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-warning">
                    <i class='bx bx-edit me-1'></i>
                    Edit Blog
                </a>
            </div>
        </div>
    </div>
</div>
@endsection