@extends('admin.master')

@section('seo')
    <title>Enquiry List</title>
    <meta name="description" content="Manage all categories here.">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Contact Messages</a></li>
    <li class="breadcrumb-item active">Enquiry #{{ $contact->id }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        
        <div class="d-flex gap-2">
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i>Back to List
            </a>
            <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
               class="btn btn-success">
                <i class="bx bx-reply me-1"></i>Reply
            </a>
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" 
                        data-bs-toggle="dropdown">
                    <i class="bx bx-cog me-1"></i>Actions
                </button>
                <ul class="dropdown-menu">
                    {{-- <li><button class="dropdown-item" onclick="updateStatus('read')">
                        <i class="bx bx-show me-2"></i>Mark as Read
                    </button></li>
                    <li><button class="dropdown-item" onclick="updateStatus('replied')">
                        <i class="bx bx-reply me-2"></i>Mark as Replied
                    </button></li>
                    <li><button class="dropdown-item" onclick="updateStatus('archived')">
                        <i class="bx bx-archive me-2"></i>Archive
                    </button></li> --}}
                    <li><hr class="dropdown-divider"></li>
                    <li><button class="dropdown-item text-danger" onclick="deleteContact()">
                        <i class="bx bx-trash me-2"></i>Delete Message
                    </button></li>
                </ul>
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

    <div class="row">
        <!-- Main Message Content -->
        <div class="col-lg-8">
            <!-- Message Details Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="bx bx-envelope me-2"></i>Message Details
                    </h6>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge {{ $contact->status_badge_class }} fs-6">
                            {{ $contact->status_name }}
                        </span>
                        @if($contact->isUnread())
                            <i class="bx bx-circle text-warning" style="font-size: 8px;" title="Unread"></i>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <!-- Subject -->
                    <div class="mb-4">
                        <h4 class="text-dark">{{ $contact->subject }}</h4>
                        <div class="text-muted small">
                            <i class="bx bx-time me-1"></i>
                            Received on {{ $contact->created_at->format('F j, Y \a\t g:i A') }}
                            ({{ $contact->time_ago }})
                        </div>
                    </div>

                    <!-- Message Content -->
                    <div class="message-content bg-light p-4 rounded-3 mb-4">
                        <h6 class="text-dark mb-3">Message:</h6>
                        <div class="message-text">
                            {!! nl2br(e($contact->message)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Information -->
        <div class="col-lg-4">
            <!-- Contact Information -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="bx bx-user me-2"></i>Contact Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="contact-info">
                        <div class="info-item mb-3">
                            <label class="fw-bold text-dark">Name:</label>
                            <div class="mt-1">{{ $contact->name }}</div>
                        </div>

                        <div class="info-item mb-3">
                            <label class="fw-bold text-dark">Email:</label>
                            <div class="mt-1">
                                <a href="mailto:{{ $contact->email }}" class="text-decoration-none">
                                    {{ $contact->email }}
                                </a>
                                <button class="btn btn-sm btn-outline-secondary ms-2" 
                                        onclick="copyToClipboard('{{ $contact->email }}')" title="Copy Email">
                                    <i class="bx bx-copy"></i>
                                </button>
                            </div>
                        </div>

                        @if($contact->phone)
                        <div class="info-item mb-3">
                            <label class="fw-bold text-dark">Phone:</label>
                            <div class="mt-1">
                                <a href="tel:{{ $contact->phone }}" class="text-decoration-none">
                                    {{ $contact->phone }}
                                </a>
                                <button class="btn btn-sm btn-outline-secondary ms-2" 
                                        onclick="copyToClipboard('{{ $contact->phone }}')" title="Copy Phone">
                                    <i class="bx bx-copy"></i>
                                </button>
                            </div>
                        </div>
                        @endif

                        <div class="info-item mb-3">
                            <label class="fw-bold text-dark">Status:</label>
                            <div class="mt-1">
                                <span class="badge {{ $contact->status_badge_class }}">
                                    {{ $contact->status_name }}
                                </span>
                            </div>
                        </div>

                        @if($contact->replied_at)
                        <div class="info-item mb-3">
                            <label class="fw-bold text-dark">Replied At:</label>
                            <div class="mt-1 text-muted small">
                                {{ $contact->replied_at->format('F j, Y \a\t g:i A') }}
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Quick Actions -->
                    {{-- <div class="mt-4 pt-3 border-top">
                        <h6 class="fw-bold text-dark mb-3">Quick Actions</h6>
                        <div class="d-grid gap-2">
                            <a href="mailto:{{ $contact->email }}" class="btn btn-outline-primary btn-sm">
                                <i class="bx bx-envelope me-1"></i>Send Email
                            </a>
                            @if($contact->phone)
                            <a href="tel:{{ $contact->phone }}" class="btn btn-outline-success btn-sm">
                                <i class="bx bx-phone me-1"></i>Call Phone
                            </a>
                            @endif
                            <button class="btn btn-outline-info btn-sm" onclick="exportContact()">
                                <i class="bx bx-download me-1"></i>Export Contact
                            </button>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-12">

            <!-- Technical Information -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="bx bx-info-circle me-2"></i>Technical Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="tech-info">
                        <div class="info-item mb-3">
                            <label class="fw-bold text-dark">Message ID:</label>
                            <div class="mt-1 font-monospace">#{{ $contact->id }}</div>
                        </div>

                        <div class="info-item mb-3">
                            <label class="fw-bold text-dark">IP Address:</label>
                            <div class="mt-1 font-monospace">{{ $contact->ip_address ?? 'Not recorded' }}</div>
                        </div>

                        <div class="info-item mb-3">
                            <label class="fw-bold text-dark">User Agent:</label>
                            <div class="mt-1 small text-muted" style="word-break: break-all;">
                                {{ Str::limit($contact->user_agent ?? 'Not recorded', 100) }}
                            </div>
                        </div>

                        <div class="info-item mb-3">
                            <label class="fw-bold text-dark">Submitted:</label>
                            <div class="mt-1">{{ $contact->created_at->format('F j, Y \a\t g:i:s A') }}</div>
                        </div>

                        <div class="info-item mb-3">
                            <label class="fw-bold text-dark">Last Updated:</label>
                            <div class="mt-1">{{ $contact->updated_at->format('F j, Y \a\t g:i:s A') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status History (if you want to track status changes) -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="bx bx-history me-2"></i>Status History
                    </h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item d-flex align-items-center mb-3">
                            <div class="timeline-marker bg-primary rounded-circle me-3" style="width: 12px; height: 12px;"></div>
                            <div>
                                <strong>Message Received</strong>
                                <div class="text-muted small">{{ $contact->created_at->format('M j, Y \a\t g:i A') }}</div>
                            </div>
                        </div>
                        
                        @if($contact->status !== 'pending')
                        <div class="timeline-item d-flex align-items-center mb-3">
                            <div class="timeline-marker bg-info rounded-circle me-3" style="width: 12px; height: 12px;"></div>
                            <div>
                                <strong>Status Updated to {{ $contact->status_name }}</strong>
                                <div class="text-muted small">{{ $contact->updated_at->format('M j, Y \a\t g:i A') }}</div>
                            </div>
                        </div>
                        @endif

                        @if($contact->replied_at)
                        <div class="timeline-item d-flex align-items-center">
                            <div class="timeline-marker bg-success rounded-circle me-3" style="width: 12px; height: 12px;"></div>
                            <div>
                                <strong>Reply Sent</strong>
                                <div class="text-muted small">{{ $contact->replied_at->format('M j, Y \a\t g:i A') }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bx bx-trash me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="bx bx-error me-2"></i>
                    <strong>Warning!</strong> This action cannot be undone.
                </div>
                <p>Are you sure you want to delete this contact message from <strong>{{ $contact->name }}</strong>?</p>
                <div class="bg-light p-3 rounded">
                    <strong>Subject:</strong> {{ $contact->subject }}<br>
                    <strong>Date:</strong> {{ $contact->created_at->format('F j, Y') }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x me-1"></i>Cancel
                </button>
                <form method="POST" action="{{ route('admin.contacts.destroy', $contact->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-trash me-1"></i>Delete Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="statusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bx bx-edit me-2"></i>Update Status
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="newStatus" class="form-label">New Status</label>
                        <select name="status" id="newStatus" class="form-select">
                            @foreach(\App\Models\Contact::getStatuses() as $statusKey => $statusName)
                                <option value="{{ $statusKey }}" {{ $contact->status == $statusKey ? 'selected' : '' }}>
                                    {{ $statusName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="statusNote" class="form-label">Note (Optional)</label>
                        <textarea name="note" id="statusNote" class="form-control" rows="3" 
                                  placeholder="Add a note about this status change..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.message-content {
    max-height: 400px;
    overflow-y: auto;
}

.message-text {
    line-height: 1.6;
    white-space: pre-wrap;
}

.info-item label {
    font-size: 0.875rem;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.timeline {
    position: relative;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 5px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-marker {
    position: relative;
    z-index: 1;
    border: 2px solid #fff;
    box-shadow: 0 0 0 3px #dee2e6;
}

@media (max-width: 768px) {
    .d-flex.gap-2 {
        flex-direction: column;
        gap: 0.5rem !important;
    }
    
    .btn-group {
        flex-direction: column;
    }
    
    .timeline::before {
        display: none;
    }
}
</style>

<script>
function deleteContact() {
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

function updateStatus(status) {
    document.getElementById('newStatus').value = status;
    const statusModal = new bootstrap.Modal(document.getElementById('statusModal'));
    statusModal.show();
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success feedback
        const toast = document.createElement('div');
        toast.className = 'toast-notification';
        toast.innerHTML = `
            <div class="alert alert-success alert-dismissible fade show position-fixed" 
                 style="top: 20px; right: 20px; z-index: 9999;">
                <i class="bx bx-check me-2"></i>Copied to clipboard!
                <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
            </div>
        `;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 3000);
    }).catch(function(err) {
        console.error('Failed to copy: ', err);
        alert('Failed to copy to clipboard');
    });
}

function exportContact() {
    const contactData = {
        id: {{ $contact->id }},
        name: "{{ $contact->name }}",
        email: "{{ $contact->email }}",
        phone: "{{ $contact->phone ?? '' }}",
        subject: "{{ $contact->subject }}",
        message: `{{ str_replace(["\r", "\n", '"'], ['', '\\n', '\\"'], $contact->message) }}`,
        status: "{{ $contact->status }}",
        created_at: "{{ $contact->created_at->toISOString() }}"
    };
    
    const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(contactData, null, 2));
    const downloadLink = document.createElement("a");
    downloadLink.setAttribute("href", dataStr);
    downloadLink.setAttribute("download", `contact-${contactData.id}-${contactData.name.replace(/\s+/g, '-').toLowerCase()}.json`);
    document.body.appendChild(downloadLink);
    downloadLink.click();
    downloadLink.remove();
}

// Auto-resize textarea
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('replyMessage');
    if (textarea) {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    }
});
</script>
@endsection