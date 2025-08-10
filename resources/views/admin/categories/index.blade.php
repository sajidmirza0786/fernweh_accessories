@extends('admin.master')

@section('seo')
    <title>Categories | Admin Panel</title>
    <meta name="description" content="Manage all categories for the e-commerce store. Create, edit, and delete categories.">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active fw-semibold" aria-current="page">
        Categories
    </li>
@endsection

@section('content')
<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-dark">
            <i class='bx bx-list-ul text-primary me-2'></i>
            Categories
        </h4>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
            <i class='bx bx-plus me-1'></i>
            Add Category
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class='bx bx-check-circle me-2'></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class='bx bx-error-circle me-2'></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card mb-3">
        <div class="card-body py-2">
            <form method="GET" action="{{ route('admin.categories.index') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label small mb-1">Search Name</label>
                        <input type="text" name="name" class="form-control form-control-sm"
                               placeholder="Category name..." value="{{ request('name') }}">
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
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class='bx bx-refresh me-1'></i>Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(request()->hasAny(['name', 'status']))
        <div class="mb-2">
            <small class="text-muted me-2">Active Filters:</small>
            @if(request('name'))
                <span class="badge bg-info me-1">Name: "{{ request('name') }}"</span>
            @endif
            @if(request('status'))
                <span class="badge bg-{{ request('status') === 'Active' ? 'success' : 'secondary' }} me-1">
                    {{ ucfirst(request('status')) }}
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
                        <th class="small">Category Name</th>
                        <th class="small">Slug</th>
                        <th class="small">Status</th>
                        <th class="small text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="small fw-semibold">#{{ $category->id }}</td>
                            <td class="small">
                                @if($category->image)
                                    <img src="{{ Storage::url($category->image) }}" width="40" height="40"
                                         class="rounded border" style="object-fit: cover;">
                                @else
                                    <div class="text-center text-muted">
                                        <i class='bx bx-image' style="font-size: 20px;"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="small">
                                <span class="fw-semibold">{{ str($category->name)->limit(35) }}</span>
                                @if($category->parent)
                                    <br><small class="text-muted">Parent: {{ $category->parent->name }}</small>
                                @endif
                            </td>
                            <td class="small text-muted">{{ str($category->slug)->limit(30) }}</td>
                            <td class="small">
                                <span class="badge bg-{{ $category->status === 'Active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($category->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="btn btn-outline-warning btn-sm" title="Edit">
                                        <i class='bx bx-edit'></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                          class="d-inline" onsubmit="return confirm('Delete this category?')">
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
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class='bx bx-list-ul' style="font-size: 48px; opacity: 0.5;"></i>
                                    <div class="mt-2">
                                        <h6>No categories found</h6>
                                        @if(request()->hasAny(['name', 'status']))
                                            <small>Try adjusting your filters</small>
                                        @else
                                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm mt-2">
                                                <i class='bx bx-plus me-1'></i>Create Category
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

    @if($categories->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                Showing {{ $categories->firstItem() }}-{{ $categories->lastItem() }} of {{ $categories->total() }} results
            </small>
            {{ $categories->appends(request()->query())->links() }}
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