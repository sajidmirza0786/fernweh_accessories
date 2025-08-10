@extends('admin.master')

@section('seo')
    <title>{{ $enquiry->name }} - Enquiry Details</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.enquiries.index') }}">Enquiries</a></li>
    <li class="breadcrumb-item active fw-semibold">{{ $enquiry->name }}</li>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold text-dark mb-1">
                        <i class='bx bx-message-square-detail text-primary me-2'></i>
                        Enquiry Details
                    </h4>
                    <p class="text-muted mb-0 small">View the complete information for this enquiry.</p>
                </div>
                <div>
                    <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                        <i class='bx bx-arrow-back me-1'></i>
                        Back to List
                    </a>
                    <form method="POST" action="{{ route('admin.enquiries.destroy', $enquiry->id) }}"
                          class="d-inline" onsubmit="return confirm('Are you sure you want to delete this enquiry? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class='bx bx-trash me-1'></i>
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0 fw-semibold">
                        <i class='bx bx-info-circle me-2'></i>
                        Enquiry Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong class="text-muted small">Name:</strong>
                            <p class="fw-semibold mb-0">{{ $enquiry->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong class="text-muted small">Email:</strong>
                            <p class="fw-semibold mb-0">
                                <a href="mailto:{{ $enquiry->email }}" class="text-dark">{{ $enquiry->email }}</a>
                            </p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong class="text-muted small">Phone:</strong>
                            <p class="fw-semibold mb-0">{{ $enquiry->phone }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong class="text-muted small">IP Address:</strong>
                            <p class="fw-semibold mb-0">{{ $enquiry->ip }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <strong class="text-muted small">Subject:</strong>
                            <p class="fw-semibold mb-0">{{ $enquiry->subject ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <strong class="text-muted small">Page URL:</strong>
                            <p class="fw-semibold mb-0">
                                @if($enquiry->page_url)
                                    <a href="{{ $enquiry->page_url }}" target="_blank" rel="noopener noreferrer" class="text-dark">{{ $enquiry->page_url }}</a>
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                    </div>

                    <hr class="my-3">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <strong class="text-muted small">Received On:</strong>
                            <p class="small mb-0">{{ $enquiry->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong class="text-muted small">Last Updated:</strong>
                            <p class="small mb-0">{{ $enquiry->updated_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0 fw-semibold">
                        <i class='bx bx-message-square-detail me-2'></i>
                        Message
                    </h6>
                </div>
                <div class="card-body">
                    @if($enquiry->message)
                        <div class="ck-content">
                            <p class="text-dark mb-0">{{ $enquiry->message }}</p>
                        </div>
                    @else
                        <div class="text-muted text-center py-4">No message provided.</div>
                    @endif
                </div>
            </div>
            
            <div class="d-flex justify-content-end gap-2 mt-4">
                <form method="POST" action="{{ route('admin.enquiries.destroy', $enquiry->id) }}"
                        class="d-inline" onsubmit="return confirm('Are you sure you want to delete this enquiry? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class='bx bx-trash me-1'></i>
                        Delete Enquiry
                    </button>
                </form>
                <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-secondary">
                    <i class='bx bx-arrow-back me-1'></i>
                    Back to Enquiries
                </a>
            </div>
        </div>
    </div>
</div>
@endsection