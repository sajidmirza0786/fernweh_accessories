<div class="py-5 bg-light">
    <div class="container">

        <!-- Section Heading -->
        <div class="section-heading text-center mb-4">
            <h2>Our <em>Categories</em></h2>
            <p>
                Our sincere effort and quality approach has enabled us to carve a niche in the sector.
                We have chosen an adroit team of quality supervisors that value the quality of our
                provided products at each stage of designing to make sure that the norms are effectively met.
                To ensure the presence of accurate features in our offered printed products, we make use of
                high-class raw materials.
            </p>
        </div>

        @php
            $uCategories = App\Models\Category::where('status','Active')->take(9)->latest()->get();
        @endphp

        <!-- Owl Carousel -->
        <div class="owl-carousel owl-theme category-slider">
            @foreach($uCategories ?? [] as $uCat)
                <div class="item">
                    <div class="card border-0 shadow-sm h-100">
                        <a href="{{ route('products', $uCat) }}">
                            <img src="{{ \Storage::url($uCat->image ?? '') }}" 
                                 class="card-img-top img-fluid rounded" 
                                 alt="{{ $uCat->name ?? '' }}">
                        </a>
                        <div class="card-body text-center p-3">
                            <h6 class="card-title mb-2 fw-bold">{{ str($uCat->name)->limit(25) }}</h6>
                            <a href="{{ route('products', $uCat) }}" class="btn btn-outline-primary btn-sm">
                                Explore <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

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

