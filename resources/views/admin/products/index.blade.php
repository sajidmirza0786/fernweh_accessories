@extends('admin.master')

@section('seo')
    <title>Product List</title>
    <meta name="description" content="Manage all products here.">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active fw-semibold">Products</li>
@endsection

@section('content')
<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-dark">
            <i class='bx bx-package text-primary me-2'></i>
            Products
        </h4>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
            <i class='bx bx-plus me-1'></i>
            Add Product
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class='bx bx-check-circle me-2'></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card mb-3">
        <div class="card-body py-2">
            <form method="GET" action="{{ route('admin.products.index') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small mb-1">Search Name</label>
                        <input type="text" name="search" class="form-control form-control-sm" 
                               placeholder="Product name, url, code..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small mb-1">Category</label>
                        <select name="category_id" class="form-select form-select-sm">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
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
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class='bx bx-refresh me-1'></i>Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(request()->hasAny(['name', 'category_id', 'status']))
        <div class="mb-2">
            <small class="text-muted me-2">Active Filters:</small>
            @if(request('name'))
                <span class="badge bg-info me-1">Name: "{{ request('name') }}"</span>
            @endif
            @if(request('category_id'))
                <span class="badge bg-warning me-1">
                    Category: {{ $categories->firstWhere('id', request('category_id'))->name ?? 'Unknown' }}
                </span>
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
                        <th class="small">Product Name</th>
                        <th class="small">Code</th>
                        <th class="small">Category</th>
                        <th class="small">Colors</th> {{-- New column header --}}
                        <th class="small">Sizes</th>  {{-- New column header --}}
                        <th class="small">Price (MRP)</th>
                        <th class="small">Price (Selling)</th>
                        <th class="small">Status</th>
                        <th class="small text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td class="small fw-semibold">#{{ $product->id }}</td>
                            <td class="small">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" width="40" height="40" 
                                         class="rounded border" style="object-fit: cover;">
                                @else
                                    <div class="text-center text-muted">
                                        <i class='bx bx-image' style="font-size: 20px;"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="small">
                                <span class="fw-semibold">{{ str($product->name)->limit(30) }}</span>
                                @if($product->description)
                                    <br><small class="text-muted">{{ Str::limit($product->description, 40) }}</small>
                                @endif
                            </td>
                            <td class="small text-muted">{{ $product->code ?? 'N/A' }}</td>
                            <td class="small">
                                @if($product->category)
                                    <span class="badge text-dark">
                                        <i class='bx bx-category me-1'></i>
                                        {{ str($product->category->name)->limit(25) }}
                                    </span>
                                @else
                                    <span class="text-muted">No Category</span>
                                @endif
                            </td>
                            {{-- New columns for Colors and Sizes --}}
                            <td class="small">
                                @if($product->color)
                                    <span class="badge rounded-pill bg-secondary me-1">{{ $product->color }}</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td class="small">
                                @if($product->size)
                                    <span class="badge rounded-pill bg-light text-dark border me-1">
                                        {{ $product->size }}
                                    </span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td class="small">
                                @if($product->mrp)
                                    <del class="text-muted">₹{{ number_format($product->mrp, 2) }}</del>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="small fw-bold">
                                @if($product->selling)
                                    ₹{{ number_format($product->selling, 2) }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="small">
                                <span class="badge bg-{{ $product->status === 'Active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.products.show', $product) }}" 
                                       class="btn btn-outline-info btn-sm" title="View">
                                        <i class='bx bx-show'></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="btn btn-outline-warning btn-sm" title="Edit">
                                        <i class='bx bx-edit'></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" 
                                          class="d-inline" onsubmit="return confirm('Delete this product?')">
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
                            <td colspan="11" class="text-center py-4">
                                <div class="text-muted">
                                    <i class='bx bx-package' style="font-size: 48px; opacity: 0.5;"></i>
                                    <div class="mt-2">
                                        <h6>No products found</h6>
                                        @if(request()->hasAny(['name', 'category_id', 'status']))
                                            <small>Try adjusting your filters</small>
                                        @else
                                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm mt-2">
                                                <i class='bx bx-plus me-1'></i>Create Product
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

    @if($products->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} results
            </small>
            {{ $products->appends(request()->query())->links() }}
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