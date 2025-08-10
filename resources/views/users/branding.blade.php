@extends('users.master')

@section('seo')
<title>Branding | Fernweh Premium Accessories</title>
<meta name="description" content="Explore premium branding options for corporate gifting at Fernweh.">
<meta name="author" content="Fernweh Premium Accessories">
@endsection

@section('content')
<!-- Breadcrumb Navigation -->
<nav aria-label="breadcrumb" class="bg-white border-bottom">
    <div class="container py-3">
        <ol class="breadcrumb mb-0 bg-white px-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}" class="text-muted">Home</a>
            </li>
            <li class="breadcrumb-item active text-dark" aria-current="page">
                Branding
            </li>
        </ol>
    </div>
</nav>

<!-- Intro Section -->
<div class="container py-4">
    <h1 class="font-weight-bold mb-3" style="font-size: 2rem;">Branding</h1>
    <p class="text-muted">
        Corporate gifting is a powerful way to create meaningful touchpoints with employees, clients, and prospects.
        Receiving a thoughtful gift builds a strong emotional connection with the giver, reinforcing positive associations
        with both the person and the brand.
    </p>
    <p class="text-muted">
        Adding your <strong>logo</strong> or a <strong>personalized message</strong> to gifts transforms them into impactful branding tools.
        At <strong>Fernweh Premium Accessories</strong>, we specialize in branding techniques that enhance your gifts and leave a lasting impression.
    </p>
</div>

<!-- Why Branding -->
<div class="container pb-4 border-bottom">
    <h4 class="font-weight-bold mb-3">Why Corporate Branding Matters</h4>
    <p class="text-muted">
        A company's brand is its stamp of approval — a symbol of trust, recognition, and appreciation.
        Strengthening corporate relationships through meaningful gifts not only supports business growth
        but also celebrates the people who contribute to it.
    </p>
    <p class="text-muted">
        At <strong>Fernweh Premium Accessories</strong>, we bring expertise in various branding techniques, considering the material, shape,
        complexity, and style of your logo — and suggest the <strong>best branding method</strong> to reflect your brand identity.
    </p>
</div>

<!-- Branding Techniques Grid -->
<div class="container py-5">
    <div class="row">
        <!-- Debossing -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ url('users/images/brandings/debos.jpeg') }}" class="card-img-top" alt="Debossing">
                <div class="card-body">
                    <h5 class="font-weight-bold">1. Debossing</h5>
                    <p class="text-muted small mb-0">
                        Debossing creates a deep, tactile impression on leather surfaces using heated brass dies.
                        It delivers a refined and classic look, especially effective with special leathers that respond to heat.
                    </p>
                </div>
            </div>
        </div>

        <!-- Foil Printing -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ url('users/images/brandings/foil.jpeg') }}" class="card-img-top" alt="Foil Printing">
                <div class="card-body">
                    <h5 class="font-weight-bold">2. Foil Printing</h5>
                    <p class="text-muted small mb-0">
                        Foil stamping adds a shiny metallic finish (gold, silver, copper, etc.) over debossed areas.
                        Great for leather, paper, velvet, or packaging lids to give a luxurious finish.
                    </p>
                </div>
            </div>
        </div>

        <!-- Laser Engraving -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ url('users/images/brandings/laser.jpeg') }}" class="card-img-top" alt="Laser Engraving">
                <div class="card-body">
                    <h5 class="font-weight-bold">3. Laser Engraving</h5>
                    <p class="text-muted small mb-0">
                        A high-precision laser etches your logo onto materials like wood, metal, and leather.
                        Clean, permanent, and professional — ideal for detailed branding.
                    </p>
                </div>
            </div>
        </div>

        <!-- Screen Printing -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ url('users/images/brandings/screen.jpeg') }}" class="card-img-top" alt="Screen Printing">
                <div class="card-body">
                    <h5 class="font-weight-bold">4. Screen Printing</h5>
                    <p class="text-muted small mb-0">
                        A flexible method for colorful logos across leather, paper, fabric, and plastic.
                        It's known for durability and is perfect for vibrant, high-contrast designs.
                    </p>
                </div>
            </div>
        </div>

        <!-- UV Printing -->
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ url('users/images/brandings/digital.jpeg') }}" class="card-img-top" alt="UV Printing">
                <div class="card-body">
                    <h5 class="font-weight-bold">5. UV / Digital Printing</h5>
                    <p class="text-muted small mb-0">
                        UV ink dries instantly on surfaces like leather, acrylic, and metal, offering rich, full-color logos.
                        Ideal for multicolor or intricate branding with high-definition clarity.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Closing Text -->
<div class="container pb-5">
    <p class="text-muted">
        At <strong>Fernweh Premium Accessories</strong>, your brand is treated with care and precision. Whether you're choosing a traditional
        technique or a modern digital method, we ensure every gift represents your brand's excellence.
    </p>
</div>
@endsection
