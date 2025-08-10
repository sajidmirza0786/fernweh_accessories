@extends('admin.master')

@section('seo')
    <title>Enquiry List</title>
    <meta name="description" content="Manage all categories here.">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active fw-semibold">Enquiry</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="bx bx-filter me-1"></i>Filters
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Messages</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalContacts ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bx bx-envelope bx-lg text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Unread</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $unreadCount ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bx bx-envelope-open bx-lg text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Replied</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $repliedCount ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bx bx-reply bx-lg text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">This Month</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $thisMonthCount ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bx bx-calendar bx-lg text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bx bx-error-circle me-2"></i>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Search and Filter Bar -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Contact Messages</h6>
            <div class="d-flex gap-2">
                <form method="GET" action="{{ route('admin.contacts.index') }}" class="d-flex">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" 
                               placeholder="Search messages..." 
                               value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="bx bx-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <!-- Status Filter Tabs -->
            <ul class="nav nav-tabs mb-3" id="statusTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ !request('status') ? 'active' : '' }}" 
                       href="{{ route('admin.contacts.index') }}">
                        All <span class="badge bg-secondary ms-1">{{ $contacts->total() }}</span>
                    </a>
                </li>
                @foreach(\App\Models\Contact::getStatuses() as $statusKey => $statusName)
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ request('status') == $statusKey ? 'active' : '' }}" 
                       href="{{ route('admin.contacts.index', ['status' => $statusKey]) }}">
                        {{ $statusName }}
                        <span class="badge bg-secondary ms-1">
                            {{ $contacts->where('status', $statusKey)->count() }}
                        </span>
                    </a>
                </li>
                @endforeach
            </ul>

            <!-- Bulk Actions -->
            <div class="mb-3">
                <!-- Removed bulk actions as requested -->
            </div>

            <!-- Contacts Table -->
            @if($contacts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th width="120">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                            <tr class="{{ $contact->isUnread() ? 'table-warning' : '' }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($contact->isUnread())
                                            <i class="bx bx-circle text-warning me-2" style="font-size: 8px;"></i>
                                        @endif
                                        <div>
                                            <strong>{{ $contact->name }}</strong>
                                            @if($contact->phone)
                                                <br><small class="text-muted">{{ $contact->phone }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="mailto:{{ $contact->email }}" class="text-decoration-none">
                                        {{ $contact->email }}
                                    </a>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ Str::limit($contact->subject, 50) }}</strong>
                                        <br><small class="text-muted">{{ $contact->short_message }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $contact->status_badge_class }}">
                                        {{ $contact->status_name }}
                                    </span>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $contact->created_at->format('M j, Y') }}</strong>
                                        <br><small class="text-muted">{{ $contact->time_ago }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.contacts.show', $contact->id) }}" 
                                           class="btn btn-sm btn-outline-primary" title="View Details">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
                                           class="btn btn-sm btn-outline-success" title="Reply">
                                            <i class="bx bx-reply"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteContact({{ $contact->id }})" title="Delete">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        Showing {{ $contacts->firstItem() }} to {{ $contacts->lastItem() }} of {{ $contacts->total() }} results
                    </div>
                    {{ $contacts->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bx bx-inbox bx-lg text-muted mb-3" style="font-size: 3rem;"></i>
                    <h5 class="text-muted">No contact messages found</h5>
                    <p class="text-muted">
                        @if(request('search'))
                            No messages match your search criteria. <a href="{{ route('admin.contacts.index') }}">Clear search</a>
                        @else
                            Contact messages will appear here when users submit the contact form.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this contact message? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" id="deleteForm" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filter Messages</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="GET" action="{{ route('admin.contacts.index') }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="filterStatus" class="form-label">Status</label>
                        <select name="status" id="filterStatus" class="form-select">
                            <option value="">All Statuses</option>
                            @foreach(\App\Models\Contact::getStatuses() as $statusKey => $statusName)
                                <option value="{{ $statusKey }}" {{ request('status') == $statusKey ? 'selected' : '' }}>
                                    {{ $statusName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="filterDateFrom" class="form-label">Date From</label>
                        <input type="date" name="date_from" id="filterDateFrom" class="form-control" 
                               value="{{ request('date_from') }}">
                    </div>
                    <div class="mb-3">
                        <label for="filterDateTo" class="form-label">Date To</label>
                        <input type="date" name="date_to" id="filterDateTo" class="form-control" 
                               value="{{ request('date_to') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary">Clear</a>
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.badge-warning { background-color: #f6c23e !important; }
.badge-info { background-color: #36b9cc !important; }
.badge-primary { background-color: #4e73df !important; }
.badge-success { background-color: #1cc88a !important; }
.badge-secondary { background-color: #858796 !important; }
.badge-danger { background-color: #e74a3b !important; }

.table-warning {
    background-color: rgba(246, 194, 62, 0.1) !important;
}

.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Removed bulk actions functionality as requested
});

function deleteContact(contactId) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `/admin/contacts/${contactId}`;
    
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}
</script>
@endsection