@php
$uBlogs = App\Models\Blog::where('status','Active')
    ->where('blogs.published_at', '<=', now())
    ->orderByDesc('id')
    ->take(3)
    ->get();
@endphp

<div class="google-blog-section py-5 bg-light">
    <div class="container">
        <!-- Section Heading -->
        <div class="text-center mb-5">
            <h2 class="font-weight-bold">Read our <span class="text-primary">Blog</span></h2>
            <p class="text-muted max-w-600 mx-auto">
                Our company is backed by well-equipped infrastructure. This facilitates quality testing 
                units of the manufactured products to make sure they meet the quality standards.
            </p>
        </div>

        <!-- Blog Grid -->
        <div class="row">
            @foreach($uBlogs ?? '' as $uBlog)
            <div class="col-12 col-sm-6 col-lg-4 mb-4">
               <div class="card border-0 shadow-sm h-100 blog-card">
                   <a href="{{ route('blogsDetails', $uBlog) }}">
                       <img class="card-img-top" src="{{ \Storage::url($uBlog->image ?? '') }}" alt="{{ $uBlog->title ?? '' }}">
                   </a>
                   <div class="card-body">
                       <h5 class="card-title font-weight-bold">
                           <a href="{{ route('blogsDetails', $uBlog) }}" class="text-dark">{{ $uBlog->name ?? '' }}</a>
                       </h5>
                       <p class="card-text text-muted small mb-3">
                           {{ str($uBlog->short_description)->limit(80) }}
                       </p>
                   </div>
                   <div class="card-footer bg-white border-0 pt-0 d-flex justify-content-between align-items-center">
                       <small class="text-muted">
                           {{ $uBlog->published_at->format('d M Y') }}
                       </small>
                       <a href="{{ route('blogsDetails', $uBlog) }}" class="text-danger font-weight-bold d-flex align-items-center">
                           <span class="mr-1">Read More</span>
                           <i class="fas fa-arrow-right"></i>
                       </a>
                   </div>
               </div>
           </div>
            @endforeach
        </div>
    </div>
</div>

<style>
/* ===== Google Material Style Blog Cards ===== */

.google-blog-section h2 {
    font-size: 2rem;
}


/* Card container */
.google-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    transition: box-shadow 0.3s ease, transform 0.3s ease;
    display: flex;
    flex-direction: column;
}

.google-card:hover {
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    transform: translateY(-4px);
}


/* Card Body */
.google-card-body {
    padding: 16px;
    flex-grow: 1;
}

.google-card-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 8px;
    color: #202124;
}

.google-card-text {
    font-size: 0.9rem;
    color: #5f6368;
    margin-bottom: 12px;
}

.google-link {
    font-size: 0.85rem;
    color: #1a73e8;
    font-weight: 500;
    text-decoration: none;
}

.google-link:hover {
    text-decoration: underline;
}

/* Footer */
.google-card-footer {
    padding: 12px 16px;
    border-top: 1px solid #f1f3f4;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* Button */
.google-card-footer .btn-danger {
    background-color: #d93025;
    border-color: #d93025;
    padding: 4px 10px;
    font-size: 0.8rem;
    border-radius: 6px;
}

.google-card-footer .btn-danger:hover {
    background-color: #b1271b;
    border-color: #b1271b;
}
</style>
