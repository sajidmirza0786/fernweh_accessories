@extends('admin.master')

@section('seo')
    <title>Manage Enquiries</title>
    <meta name="description" content="View and manage all contact form enquiries.">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active fw-semibold">Enquiries</li>
@endsection

@section('content')
<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-dark">
            <i class='bx bx-message-square-dots text-primary me-2'></i>
            All Enquiries
        </h4>
        <a href="{{ route('admin.enquiries.index') }}" class="btn btn-primary btn-sm">
            <i class='bx bx-refresh me-1'></i>
            Refresh
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
            <form method="GET" action="{{ route('admin.enquiries.index') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-md-8">
                        <label class="form-label small mb-1">Search Enquiries</label>
                        <input type="text" name="q" class="form-control form-control-sm"
                               placeholder="Name, email, or subject..." value="{{ request('q') }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-sm me-1">
                            <i class='bx bx-search me-1'></i>Filter
                        </button>
                        <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class='bx bx-refresh me-1'></i>Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(request('q'))
        <div class="mb-2">
            <small class="text-muted me-2">Active Filter:</small>
            <span class="badge bg-info me-1">Search: "{{ request('q') }}"</span>
        </div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-sm table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="small">#</th>
                        <th class="small">Name</th>
                        <th class="small">Email</th>
                        <th class="small">Phone</th>
                        <th class="small">Subject</th>
                        <th class="small">Received On</th>
                        <th class="small text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enquiries as $enquiry)
                        <tr>
                            <td class="small fw-semibold">{{ $enquiry->id }}</td>
                            <td class="small fw-semibold">{{ $enquiry->name }}</td>
                            <td class="small">
                                <a href="mailto:{{ $enquiry->email }}" class="text-decoration-none text-dark">{{ $enquiry->email }}</a>
                            </td>
                            <td class="small">{{ $enquiry->phone }}</td>
                            <td class="small text-muted">{{ Str::limit($enquiry->subject, 50) ?? 'N/A' }}</td>
                            <td class="small text-muted">{{ $enquiry->created_at->format('M d, Y') }}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="btn btn-info btn-sm" title="View">
                                        <i class='bx bx-show'></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.enquiries.destroy', $enquiry) }}"
                                          class="d-inline" onsubmit="return confirm('Delete this enquiry?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
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
                                    <i class='bx bx-message-square-error' style="font-size: 48px; opacity: 0.5;"></i>
                                    <div class="mt-2">
                                        <h6>No enquiries found</h6>
                                        @if(request('q'))
                                            <small>Try adjusting your search filters</small>
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

    @if($enquiries->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                Showing {{ $enquiries->firstItem() }}-{{ $enquiries->lastItem() }} of {{ $enquiries->total() }} results
            </small>
            {{ $enquiries->appends(request()->query())->links() }}
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