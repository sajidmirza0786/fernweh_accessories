<div class="py-4 bg-light">
    <div class="container">
        <div class="row">
            <!-- Section Heading -->
            <div class="col-12 text-center mb-4">
                <h2 class="font-weight-bold mb-2">Latest <em class="text-primary">Products</em></h2>
                <p class="text-muted mb-0">Discover our premium collection of leather accessories crafted with precision and style. Each product combines functionality with elegance to meet your lifestyle needs.</p>
            </div>

            @php
            $uProducts = App\Models\Product::where('status','Active')->inRandomOrder()->take(6)->get();
            @endphp

            @foreach($uProducts ?? [] as $uproduct)
            <div class="col-lg-4 col-md-6 col-6 mb-4 p-1">
                <div class="product-card h-100">
                    
                    <!-- Product Image -->
                    <div class="product-image-container">
                        <a href="{{ route('products', $uproduct) }}">
                            <img src="{{ \Storage::url($uproduct->image ?? '') }}" alt="{{ $uproduct->name ?? '' }}">
                        </a>
                        @if(!empty($uproduct->is_featured))
                        <div class="product-badge featured">Featured</div>
                        @elseif(!empty($uproduct->is_new))
                        <div class="product-badge new">New</div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="product-content">
                        <div class="product-category">{{ str($uproduct->category->name)->limit(25) ?? 'Premium Accessories' }}</div>
                        <h4 class="product-title">
                            <a href="{{ route('products', $uproduct) }}">{{ str($uproduct->name ?? '')->limit(30) }}</a>
                        </h4>
                        @if(!empty($uproduct->description))
                        <p class="product-description">{{ str($uproduct->description)->limit(60) }}</p>
                        @endif

                        <!-- Price -->
                        <div class="price-section mt-auto">
                            @if(!empty($uproduct->sale_price) && $uproduct->sale_price < $uproduct->mrp)
                                <span class="price-original">₹{{ number_format($uproduct->mrp) }}</span>
                                <span class="price-sale">₹{{ number_format($uproduct->sale_price) }}</span>
                                <span class="discount-badge">{{ round((($uproduct->mrp - $uproduct->sale_price) / $uproduct->mrp) * 100) }}% OFF</span>
                            @else
                                <span class="price-current">₹{{ number_format($uproduct->mrp) }}</span>
                            @endif
                        </div>

                        <!-- View Button -->
                        <a href="{{ route('products', $uproduct) }}" class="btn btn-primary btn-sm mt-2">
                            <i class="fas fa-info-circle"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
.product-card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}
.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
}
.product-image-container {
    position: relative;
    padding-top: 100%;
    background: #f5f5f5;
}
.product-image-container img {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}
.product-card:hover img {
    transform: scale(1.05);
}
.product-badge {
    position: absolute;
    top: 8px; left: 8px;
    padding: 4px 8px;
    font-size: 0.7rem;
    font-weight: 600;
    border-radius: 4px;
    color: #fff;
}
.product-badge.featured { background: #1e88e5; }
.product-badge.new { background: #43a047; }
.product-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding: 12px;
}
.product-category {
    font-size: 0.75rem;
    color: #757575;
    margin-bottom: 4px;
    text-transform: uppercase;
}
.product-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 8px;
}
.product-title a { color: inherit; text-decoration: none; }
.product-description {
    font-size: 0.85rem;
    color: #616161;
    margin-bottom: 8px;
}
.price-section {
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 6px;
}
.price-original {
    text-decoration: line-through;
    color: #9e9e9e;
}
.price-sale {
    color: #e53935;
    font-weight: bold;
}
.price-current {
    color: #212121;
    font-weight: bold;
}
.discount-badge {
    font-size: 0.75rem;
    color: #e53935;
    font-weight: bold;
}
@media (max-width: 576px) {
    .product-description { display: none; }
}
</style>
