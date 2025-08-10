<div class="py-5 bg-light">
    <div class="container">

        @if($similarProducts->count())
        <div class="mt-5">
            <h4 class="mb-4">Similar Products</h4>
            <div class="owl-carousel owl-theme category-slider">
                @foreach($similarProducts as $sp)
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <a href="{{ route('products', $sp) }}">
                                <img src="{{ url($sp->image) }}" class="card-img-top" alt="{{ $sp->name }}">
                            </a>
                            <div class="card-body">
                                <h6>{{ $sp->name }}</h6>
                                @if($sp->selling)
                                    <p class="text-danger mb-2">₹{{ $sp->selling }}</p>
                                @endif
                                @if($sp->mrp && $sp->selling && $sp->mrp != $sp->selling)
                                    <small class="text-muted"><del>₹{{ $sp->mrp }}</del></small>
                                @endif
                                <a href="{{ route('products', $sp) }}" class="btn btn-outline-primary btn-sm mt-2">View Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>
<!-- jQuery + Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.category-slider').owlCarousel({
            loop: true,
            margin: 16,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            navText: [
                '<span class="arrow-custom">&#10095;</span>', // minimal arrow
                '<span class="arrow-custom">&#10095;</span>'  // right arrow only style
            ],
            responsive: {
                0: { items: 1.25 }, // <-- 1.25 visible on mobile
                576: { items: 2 },
                768: { items: 3 },
                992: { items: 4 }
            }
        });
    });
</script>

<style>
    /* Minimal floating arrows like Google UI */
    .category-slider .owl-nav {
        position: absolute;
        top: 35%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        pointer-events: none; /* allows click-through for slide swiping */
    }

    .category-slider .owl-nav button {
        background: none !important;
        border: none !important;
        box-shadow: none !important;
        width: auto;
        height: auto;
        pointer-events: auto; /* re-enable click on arrow itself */
    }

    .arrow-custom {
        font-size: 28px;
        color: #666;
        background: rgba(255,255,255,0.9);
        padding: 4px 8px;
        border-radius: 6px;
        transition: background 0.3s ease, color 0.3s ease;
    }

    .arrow-custom:hover {
        background: linear-gradient(135deg, rgb(220, 53, 69), rgb(255, 107, 122));
        color: white;
    }

    /* Smooth hover for cards */
    .category-slider .card {
        transition: transform 0.3s ease;
    }
    .category-slider .card:hover {
        transform: translateY(-5px);
    }
</style>

