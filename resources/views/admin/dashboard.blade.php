<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">
            <i class='bx bxs-dashboard text-primary me-2'></i>
            Admin Dashboard
        </h3>
        <p class="text-muted mb-0">Welcome back, {{ auth()->user()->name }}! 👋</p>
    </div>

    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small fw-bold text-primary text-uppercase mb-1">Total Products</div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalProducts }}</div>
                        </div>
                        <div class="col-auto">
                            <i class='bx bx-package fa-2x text-gray-300'></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 pt-0">
                    <a href="{{ route('admin.products.index') }}" class="small text-primary text-decoration-none">
                        View All Products <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small fw-bold text-success text-uppercase mb-1">Total Categories</div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalCategories }}</div>
                        </div>
                        <div class="col-auto">
                            <i class='bx bx-category fa-2x text-gray-300'></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 pt-0">
                    <a href="{{ route('admin.categories.index') }}" class="small text-success text-decoration-none">
                        View All Categories <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small fw-bold text-info text-uppercase mb-1">Total Blog Posts</div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalBlogs }}</div>
                        </div>
                        <div class="col-auto">
                            <i class='bx bx-book-content fa-2x text-gray-300'></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 pt-0">
                    <a href="{{ route('admin.blogs.index') }}" class="small text-info text-decoration-none">
                        View All Blogs <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small fw-bold text-warning text-uppercase mb-1">Total Enquiries</div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalEnquiries }}</div>
                        </div>
                        <div class="col-auto">
                            <i class='bx bx-chat fa-2x text-gray-300'></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 pt-0">
                    <a href="{{ route('admin.enquiries.index') }}" class="small text-warning text-decoration-none">
                        View All Enquiries <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="m-0 fw-bold text-primary">Recent Blog Posts</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="small text-muted">Title</th>
                                    <th class="small text-muted">Status</th>
                                    <th class="small text-muted">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBlogs as $blog)
                                    <tr>
                                        <td class="small">{{ Str::limit($blog->name, 40) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $blog->status === 'Active' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($blog->status) }}
                                            </span>
                                        </td>
                                        <td class="small">{{ $blog->created_at->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-3 text-muted small">No recent blogs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 text-center">
                    <a href="{{ route('admin.blogs.index') }}" class="small text-muted text-decoration-none">
                        View All Blogs <i class='bx bx-chevron-right'></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="m-0 fw-bold text-primary">Recent Enquiries</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="small text-muted">Name</th>
                                    <th class="small text-muted">Mobile</th>
                                    <th class="small text-muted">Subject</th>
                                    <th class="small text-muted">Received</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentEnquiries as $enquiry)
                                    <tr>
                                        <td class="small">{{ $enquiry->name }}</td>
                                        <td class="small">{{ $enquiry->phone ?? 'NA' }}</td>
                                        <td class="small">{{ str($enquiry->subject)->limit(25) ?? 'NA' }}</td>
                                        <td class="small">{{ $enquiry->created_at->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-3 text-muted small">No recent enquiries found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0 text-center">
                    <a href="{{ route('admin.enquiries.index') }}" class="small text-muted text-decoration-none">
                        View All Enquiries <i class='bx bx-chevron-right'></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>