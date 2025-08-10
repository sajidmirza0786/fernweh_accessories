@extends('users.master')

@section('seo')
<title>{{ $blog->title ?? 'Blog' }} | Fernweh Premium Accessories</title>
<meta name="description" content="{{ $blog->description ?? 'Blog | Fernweh Preminum Accessories' }}">
<meta name="author" content="{{ $blog->keywords ?? 'Blog | Fernweh Preminum Accessories' }}">
@endsection

@section('content')
<div class="container py-4">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4 border-bottom pb-2">
        <ol class="breadcrumb bg-transparent p-0 mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ourBlogs') }}">Blogs</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $blog->name ?? '' }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Main Blog Content -->
        <div class="col-lg-8 mb-4">
            <article class="card border-0 shadow-sm">

                {{-- Featured Image --}}
                @if($blog->image)
                    <div class="blog-featured-image">
                        <img src="{{ \Storage::url($blog->image) }}" class="img-fluid w-100 rounded-top" alt="{{ $blog->title }}">
                    </div>
                @endif

                {{-- Video Section --}}
                @if(!empty($blog->video_url))
                    <div class="blog-video-wrapper my-4">
                        <div class="video-container">
                            <iframe
                                src="{{ preg_replace('/watch\?v=/', 'embed/', $blog->video_url) }}"
                                frameborder="0"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                @endif

                {{-- Blog Content --}}
                <div class="card-body">
                    <h1 class="h4 font-weight-bold mb-2">{{ $blog->title ?? '' }}</h1>
                    <div class="text-muted small mb-3">
                        <i class="far fa-calendar-alt"></i> {{ $blog->published_at->format('d M Y') }}
                        @if($blog->tag)
                            <span class="ml-3"><i class="fas fa-tag"></i> {{ $blog->tag }}</span>
                        @endif
                    </div>
                    <div class="blog-content">
                        {!! $blog->content !!}
                    </div>
                </div>
            </article>


        </div>

        <!-- Related Blogs Sidebar -->
        <div class="col-lg-4">
            <h5 class="font-weight-bold mb-3">Related Blogs</h5>
            @foreach($blogs->where('id', '!=', $blog->id) as $uBlog)
                <div class="media mb-3 border-bottom pb-2">
                    @if($uBlog->image)
                        <a href="{{ route('ourBlogs', $uBlog) }}">
                            <img src="{{ \Storage::url($uBlog->image) }}" class="mr-3 rounded" width="80" height="60" alt="{{ $uBlog->title }}">
                        </a>
                    @endif
                    <div class="media-body">
                        <h6 class="mt-0 mb-1">
                            <a href="{{ route('ourBlogs', $uBlog) }}" class="text-dark">
                                {{ \Illuminate\Support\Str::limit($uBlog->name, 50) }}
                            </a>
                        </h6>
                        <small class="text-muted">{{ $uBlog->published_at->format('d M Y') }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .blog-content p {
        line-height: 1.7;
        margin-bottom: 1rem;
    }
    .blog-content img {
        max-width: 100%;
        height: auto;
    }
    .media img {
        object-fit: cover;
    }
    .card:hover {
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        transition: 0.3s ease;
    }
    .blog-video-wrapper {
       position: relative;
       background: #000;
       border-radius: 10px;
       overflow: hidden;
       box-shadow: 0 4px 15px rgba(0,0,0,0.15);
   }

   .video-container {
       position: relative;
       padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
       height: 0;
   }

   .video-container iframe {
       position: absolute;
       top: 0;
       left: 0;
       width: 100%;
       height: 100%;
       border: none;
   }

</style>
@endsection
