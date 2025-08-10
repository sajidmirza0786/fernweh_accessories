@extends('users.master')

@section('seo')
<title>{{ $product->name ?? '' }}</title>
<meta name="description" content="{{ $product->description ?? '' }}">
<meta name="keywords" content="{{ $product->keyword ?? '' }}">
@endsection

@section('content')
<div class="container my-4">

    {{-- Breadcrumbs --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent p-0 mb-3">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            @if($product->category)
                <li class="breadcrumb-item">
                    <a href="{{ route('products', $product->category) }}">{{ $product->category->name }}</a>
                </li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ str($product->name)->limit(40) }}</li>
        </ol>
    </nav>

    <div class="row">
        {{-- Product Image Carousel --}}
        <div class="col-lg-5 mb-4">
            <div class="owl-carousel owl-theme" id="product-gallery">
                {{-- Main image --}}
                @if($product->image)
                    <div class="item">
                        <img src="{{ \Storage::url($product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                    </div>
                @else
                    <div class="item">
                        <img src="{{ asset('images/no-image.png') }}" class="img-fluid rounded" alt="No image">
                    </div>
                @endif

                {{-- Extra images --}}
                @if(isset($product->images) && !empty($product->images))
                    @foreach($product->images as $img)
                        <div class="item">
                            <img src="{{ \Storage::url($img->image_path) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- Product Details --}}
        <div class="col-lg-7">
            <h2 class="mb-3">{{ $product->name }}</h2>

            @if($product->selling)
                <h4 class="text-danger mb-1">₹{{ $product->selling }}</h4>
            @endif

            @if($product->mrp && $product->selling && $product->mrp != $product->selling)
                <p class="text-muted"><del>₹{{ $product->mrp }}</del></p>
            @endif

            @if($product->code)
                <p class="mb-1"><strong>Product Code:</strong> {{ $product->code }}</p>
            @endif

            {{-- <strong class="text-muted small">Category:</strong> --}}
            <p>
                @if($product->category)
                    <a href="{{ route('products', $product->category) }}" 
                       class="btn btn-light btn-sm text-dark border fs-6 mb-2">
                        <i class="fas fa-tags me-1"></i> {{-- FA5 icon --}}
                        {{ $product->category->name }}
                    </a>
                @else
                    <span class="text-muted">No Category Assigned</span>
                @endif
            </p>


            @if($product->color)
                <p class="mb-1"><strong>Color:</strong> {{ $product->color }}</p>
            @endif

            @if($product->size)
                <p class="mb-3"><strong>Size:</strong> {{ $product->size }}</p>
            @endif

            @if($product->description)
                <div class="mb-3">{{ $product->description }}</div>
            @endif

            {{-- Enquiry Form --}}
            <form action="{{ route('contact') }}" method="POST" class="enquiry-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="subject" value="Product Enquiry">

                <div class="row g-2">
                    <div class="col-md-6 pt-2">
                        <input type="text" name="name" class="form-control" placeholder="Full Name" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6 pt-2">
                        <input type="text" name="phone" class="form-control" placeholder="Mobile Number" value="{{ old('phone') }}" required>
                    </div>
                    <div class="col-md-12 pt-2">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-12 pt-2">
                        <textarea name="message" rows="2" class="form-control" placeholder="Your Message" required>{{ old('message') }}</textarea>
                    </div>
                </div>

                <div class="form-actions mt-2">
                    <button type="submit" class="btn btn-danger btn-sm">Submit</button>
                    <a href="tel:+918506959914" class="btn btn-success btn-sm"><i class="fa fa-phone"></i> Call</a>
                </div>
            </form>


        </div>

         @if($product->long_description)
         <div class="col-md-12 pt-3">
            <div class="mb-3">{!! $product->long_description !!}</div>
         </div>
         @endif
    </div>

    {{-- Similar Products Carousel --}}
   @if($similarProducts->count())
   <div class="mt-5">
       <h4 class="mb-4">Similar Products</h4>
       <div class="owl-carousel owl-theme" id="similar-products-carousel">
           @foreach($similarProducts as $sp)
               <div class="item">
                   <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                       <div class="card product-card border-0 shadow-sm h-100">
                           <a href="{{ route('products', $sp) }}" class="d-block">
                               <img src="{{ \Storage::url($sp->image ?? '') }}" 
                                    class="card-img-top" 
                                    alt="{{ $sp->name ?? '' }}">
                           </a>
                           <div class="card-body p-2" style="font-family: 'Roboto', sans-serif;">
                               <h6 class="card-title mb-1 text-truncate" title="{{ $sp->name ?? '' }}">
                                   <a href="{{ route('products', $sp) }}" class="text-dark">
                                       {{ $sp->name ?? '' }}
                                   </a>
                               </h6>

                               {{-- Color and Size --}}
                               @if(!empty($sp->color) || !empty($sp->size))
                                   <p class="mb-1 text-muted" style="font-size: 0.85rem;">
                                       @if(!empty($sp->color))
                                           <strong>Color:</strong> {{ $sp->color }}
                                       @endif
                                       @if(!empty($sp->size))
                                           <span class="ml-2"><strong>Size:</strong> {{ $sp->size }}</span>
                                       @endif
                                   </p>
                               @endif

                               {{-- Prices --}}
                               @if(!empty($sp->selling))
                                   <p class="text-success font-weight-bold mb-1">
                                       ₹{{ number_format($sp->selling) }}
                                       @if(!empty($sp->mrp) && $sp->mrp > $sp->selling)
                                           <small class="text-muted ml-1"><del>₹{{ number_format($sp->mrp) }}</del></small>
                                       @endif
                                   </p>
                               @elseif(!empty($sp->mrp))
                                   <p class="text-danger font-weight-bold mb-1">
                                       ₹{{ number_format($sp->mrp) }}
                                   </p>
                               @endif
                           </div>
                       </div>
                   </div>
               </div>
           @endforeach
       </div>
   </div>
   @endif

</div>

{{-- CSS & JS Includes --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Carousel Init --}}
<script>
$(document).ready(function(){
    // Product gallery
    var pgCount = $('#product-gallery .item').length;
    $('#product-gallery').owlCarousel({
        items: 1,
        loop: pgCount > 1,
        margin: 10,
        nav: pgCount > 1,
        dots: true,
        navText: [
            '<i class="fa fa-chevron-left"></i>',
            '<i class="fa fa-chevron-right"></i>'
        ]
    });

    // Similar products carousel
    $('#similar-products-carousel').owlCarousel({
        items: 3,
        loop: true,
        margin: 15,
        nav: true,
        dots: false,
        navText: [
            '<i class="fa fa-chevron-left"></i>',
            '<i class="fa fa-chevron-right"></i>'
        ],
        responsive:{
            0:{ items:1 },
            576:{ items:2 },
            992:{ items:3 }
        }
    });
});
</script>

<style>
.breadcrumb { font-size: 0.9rem; }
.breadcrumb a { color: #007bff; text-decoration: none; }
.breadcrumb a:hover { text-decoration: underline; }
.owl-carousel .item img { width: 100%; height: auto; display: block; }

/* Owl Carousel nav styling */
.owl-carousel .owl-nav {
    position: absolute;
    top: 40%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    pointer-events: none;
}
.owl-carousel .owl-nav button {
    pointer-events: all;
    background: rgba(255,255,255,0.9);
    border-radius: 50%;
    border: none;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}
.owl-carousel .owl-nav button i {
    font-size: 18px;
    color: #333;
}
.enquiry-form {
    background: #fff;
    border: 1px solid #ddd;
    padding: 12px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    font-size: 0.9rem;
}

.enquiry-form .form-control {
    border-radius: 6px;
    padding: 6px 10px;
    font-size: 0.88rem;
}

.enquiry-form textarea {
    resize: none;
}

.enquiry-form .form-actions {
    display: flex;
    gap: 6px;
}

@media (max-width: 576px) {
    .enquiry-form .row > div {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .enquiry-form .form-actions {
        flex-direction: column;
    }
}
</style>
@endsection
