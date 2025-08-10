@extends('admin.master')

@section('seo')
    <title>Blog Posts</title>
    <meta name="description" content="Manage all blog posts here.">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active fw-semibold">Blogs</li>
@endsection

@section('content')
<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-dark">
            <i class='bx bx-book-content text-primary me-2'></i>
            All Blog Posts
        </h4>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">
            <i class='bx bx-plus me-1'></i>
            Create New Blog
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class='bx bx-check-circle me-2'></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class='bx bx-error-circle me-2'></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card mb-3">
        <div class="card-body py-2">
            <form method="GET" action="{{ route('admin.blogs.index') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label small mb-1">Search Blog</label>
                        <input type="text" name="search" class="form-control form-control-sm"
                               placeholder="Blog name or title..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small mb-1">Status</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="">All Status</option>
                            <option value="Active" @selected(request('status') === 'Active')>Active</option>
                            <option value="Inactive" @selected(request('status') === 'Inactive')>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-sm me-1">
                            <i class='bx bx-search me-1'></i>Filter
                        </button>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class='bx bx-refresh me-1'></i>Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(request()->hasAny(['search', 'status']))
        <div class="mb-2">
            <small class="text-muted me-2">Active Filters:</small>
            @if(request('search'))
                <span class="badge bg-info me-1">Search: "{{ request('search') }}"</span>
            @endif
            @if(request('status'))
                <span class="badge bg-{{ request('status') === 'Active' ? 'success' : 'secondary' }} me-1">
                    Status: {{ ucfirst(request('status')) }}
                </span>
            @endif
        </div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-sm table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="small">ID</th>
                        <th class="small">Image</th>
                        <th class="small">Blog Name & Title</th>
                        <th class="small">Published At</th>
                        <th class="small">Created By</th>
                        <th class="small">Status</th>
                        <th class="small text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $blog)
                        <tr>
                            <td class="small fw-semibold">#{{ $blog->id }}</td>
                            <td class="small">
                                @if($blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}" width="40" height="40"
                                         class="rounded border" style="object-fit: cover;">
                                @else
                                    <div class="text-center text-muted border rounded" style="width: 40px; height: 40px; line-height: 40px;">
                                        <i class='bx bx-image' style="font-size: 20px;"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="small">
                                <span class="fw-semibold">{{ Str::limit($blog->name, 40) }}</span>
                                @if($blog->title)
                                    <br><small class="text-muted">{{ Str::limit($blog->title, 50) }}</small>
                                @endif
                            </td>
                            <td class="small text-muted">{{ \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') }}</td>
                            <td class="small text-muted">{{ $blog->created_by ?? 'N/A' }}</td>
                            <td class="small">
                                <span class="badge bg-{{ $blog->status === 'Active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($blog->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.blogs.show', $blog->id) }}"
                                       class="btn btn-outline-info btn-sm" title="View">
                                        <i class='bx bx-show'></i>
                                    </a>
                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                       class="btn btn-outline-warning btn-sm" title="Edit">
                                        <i class='bx bx-edit'></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.blogs.destroy', $blog->id) }}"
                                          class="d-inline" onsubmit="return confirm('Delete this blog?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class='bx bx-book-content' style="font-size: 48px; opacity: 0.5;"></i>
                                    <div class="mt-2">
                                        <h6>No blogs found</h6>
                                        @if(request()->hasAny(['search', 'status']))
                                            <small>Try adjusting your filters</small>
                                        @else
                                            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm mt-2">
                                                <i class='bx bx-plus me-1'></i>Create Blog
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($blogs->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                Showing {{ $blogs->firstItem() }}-{{ $blogs->lastItem() }} of {{ $blogs->total() }} results
            </small>
            {{ $blogs->appends(request()->query())->links() }}
        </div>
    @endif
</div>

<style>
.table-sm th, .table-sm td {
    padding: 0.5rem 0.75rem;
    vertical-align: middle;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.775rem;
}

.card {
    border: 1px solid #e3e6f0;
    border-radius: 0.35rem;
}

.badge {
    font-size: 0.7em;
}

.btn-group-sm > .btn {
    padding: 0.125rem 0.25rem;
    font-size: 0.7rem;
}

.form-control-sm, .form-select-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.8rem;
}

@media (max-width: 768px) {
    .btn-group {
        flex-direction: column;
    }
    .btn-group .btn {
        border-radius: 0.25rem !important;
        margin-bottom: 1px;
    }
}
</style>
@endsection