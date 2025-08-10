@extends('users.master')
@section('seo')
<title>{{ home()->title ?? 'Home | Fernweh Preminum Accessories' }}</title>
<meta name="description" content="{{ home()->keywords ?? 'Home | Fernweh Preminum Accessories' }}">
<meta name="author" content="{{ home()->description ?? 'Home | Fernweh Preminum Accessories' }}">
@endsection
@section('content')

<!-- Banner Starts Here -->
<div id="demo" class="carousel slide" data-ride="carousel">
      <ul class="carousel-indicators">
         <li data-target="#demo" data-slide-to="0" class="active"></li>
         <li data-target="#demo" data-slide-to="1"></li>
         <li data-target="#demo" data-slide-to="2"></li>
      </ul>
      <div class="carousel-inner">
         <div class="carousel-item active">
            <img src="{{ home()->banner_image_1 ? \Storage::url(home()->banner_image_1) : url('users/assets/images/slider-image-1-1920x900.jpg') }}" alt="Home | Fernweh Preminum Accessories" width="100%" height=" ">
         </div>
         <div class="carousel-item">
            <img src="{{ home()->banner_image_2 ? \Storage::url(home()->banner_image_2) : url('users/assets/images/slider-image-2-1920x900.jpg') }}" alt="Home | Fernweh Preminum Accessories" width="100%" height=" ">
         </div>
         <div class="carousel-item">
            <img src="{{ home()->banner_image_2 ? \Storage::url(home()->banner_image_2) : url('users/assets/images/slider-image-3-1920x900.jpg') }}" alt="Home | Fernweh Preminum Accessories" width="100%" height=" ">
         </div>
      </div>
      <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
      </a>
   </div>
<!-- Banner Ends Here -->

<div class="request-form">
   <div class="container">
      <div class="row">
         <div class="col-md-8">
            <h4>Request a call back right now ?</h4>
            <span>Royal Enterprises since 2000 is one of the most famous manufacturer, exporter and supplier of an extensive array of laptop bags, backpack bags, duffle bags and much more.</span>
         </div>
         <div class="col-md-4">
            <a href="{{ route('contact') }}" class="border-button">Contact Us</a>
         </div>
      </div>
   </div>
</div>
<div class="container pt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="section-heading">
               <h2>Royal <em>Enterprises</em></h2>
                <span>Royal Enterprises since 2000 is one of the most famous manufacturer, exporter and supplier of an extensive array of laptop bags, backpack bags, duffle bags and much more. The products that we are offering are admired for their attractive designs, shrink resistance, long life, lightweight and perfect finishing. These products are available in different patterns and sizes as per the various choices of our customers and clients. Our company is based in Delhi, India but we have gained popularity all around the country.</span>
            </div>
        </div>
    </div>
</div>
@include('users.partials.home_categories')
@include('users.partials.who')



@include('users.partials.latest_product')
<div class="testimonials pb-2 pt-4 bg-white">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="section-heading">
               <h2>What they say <em>about us</em></h2>
               <span>testimonials from our greatest clients</span>
            </div>
         </div>
         <div class="col-md-12">
            <div class="owl-testimonials owl-carousel">
               <div class="testimonial-item bg-light">
                  <div class="inner-content">
                     <h4>Vivek Bindra</h4>
                     <span>Delhi</span>
                     <p>"Discover the epitome of luxury with Fernwah's leather bags. Impeccably designed, these bags merge
                        functionality with beauty. The supple leather, meticulous stitching, and versatile styles make them a
                        must-have for those who appreciate fine craftsmanship."
                     </p>
                  </div>
                  <img src="{{ url('users/images/user.jpg') }}" alt="">
               </div>
               <div class="testimonial-item bg-light">
                  <div class="inner-content">
                     <h4>Ajay Singh</h4>
                     <span>Tamilnadu</span>
                     <p>"Fernwah's leather bags are a fusion of artistry and functionality. Crafted with precision and using
                        the finest materials, these bags elevate any outfit. From classic designs to modern aesthetics, they
                        cater to diverse tastes while maintaining their signature quality and charm."
                     </p>
                  </div>
                  <img src="{{ url('users/images/user.jpg') }}" alt="">
               </div>
               <div class="testimonial-item bg-light">
                  <div class="inner-content">
                     <h4>Neha Maurya</h4>
                     <span>Gujrat</span>
                     <p>"Indulge in the luxury of Fernwah's leather bags. Impeccably made, these bags are a testament to
                        exquisite craftsmanship. They seamlessly blend style and functionality, becoming a statement piece
                        that stands the test of time in both fashion and durability."
                     </p>
                  </div>
                  <img src="assets/images/woman.png" alt="">
               </div>
               <div class="testimonial-item bg-light">
                  <div class="inner-content">
                     <h4>Chetan Gaur</h4>
                     <span>Utter Pardesh</span>
                     <p>"Fernwah's leather bags redefine elegance. The premium quality leather, combined with thoughtful
                        design, results in accessories that exude class. From sleek totes to versatile backpacks, each piece
                        speaks volumes about refined taste and lasting durability."
                     </p>
                  </div>
                  <img src="{{ url('users/images/user.jpg') }}" alt="">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<style>
    
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        .premium-section {
            background: white;
            position: relative;
            overflow: hidden;
            padding: 80px 0;
        }
        
        .premium-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, rgba(66, 133, 244, 0.03) 0%, rgba(52, 168, 83, 0.02) 100%);
            border-radius: 50%;
            transform: translate(150px, -150px);
        }
        
        .section-badge {
            display: inline-block;
            background: linear-gradient(135deg, #4285f4, #34a853);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }
        
        .premium-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #202124;
            margin-bottom: 12px;
            line-height: 1.2;
        }
        
        .premium-subtitle {
            font-size: 1.125rem;
            color: #5f6368;
            font-weight: 400;
            margin-bottom: 0;
            line-height: 1.5;
        }
        
        .content-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(60, 64, 67, 0.08), 0 4px 8px 3px rgba(60, 64, 67, 0.04);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .content-card:hover {
            box-shadow: 0 2px 6px rgba(60, 64, 67, 0.12), 0 8px 16px 4px rgba(60, 64, 67, 0.08);
            transform: translateY(-2px);
        }
        
        .image-container {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
        }
        
        .image-container img {
            width: 100%;
            height: auto;
            transition: transform 0.4s ease;
            border-radius: 16px;
        }
        
        .image-container:hover img {
            transform: scale(1.02);
        }
        
        .content-body {
            padding: 40px;
        }
        
        .content-heading {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a73e8;
            margin-bottom: 20px;
            line-height: 1.3;
        }
        
        .content-text {
            font-size: 1rem;
            color: #5f6368;
            line-height: 1.6;
            margin-bottom: 16px;
        }
        
        .content-text:last-of-type {
            margin-bottom: 24px;
        }
        
        .brand-highlight {
            color: #1a73e8;
            font-weight: 600;
        }
        
        .cta-button {
            background: linear-gradient(135deg, rgb(220, 53, 69), rgb(255, 107, 122));
            border: none;
            color: white;
            padding: 12px 28px;
            border-radius: 24px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 1px 3px rgba(26, 115, 232, 0.3);
        }
        
        .cta-button:hover {
            background: linear-gradient(135deg, rgb(220, 53, 69), rgb(255, 107, 122));
            box-shadow: 0 2px 8px rgba(26, 115, 232, 0.4);
            transform: translateY(-1px);
            color: white;
            text-decoration: none;
        }
        
        .cta-button i {
            transition: transform 0.3s ease;
        }
        
        .cta-button:hover i {
            transform: translateX(2px);
        }
        
        @media (max-width: 991px) {
            .premium-section {
                padding: 60px 0;
            }
            
            .premium-title {
                font-size: 2rem;
            }
            
            .content-body {
                padding: 30px;
                margin-top: 30px;
            }
        }
        
        @media (max-width: 576px) {
            .premium-section {
                padding: 40px 0;
            }
            
            .premium-title {
                font-size: 1.75rem;
            }
            
            .premium-subtitle {
                font-size: 1rem;
            }
            
            .content-body {
                padding: 24px;
            }
            
            .cta-button {
                padding: 10px 24px;
                font-size: 0.9rem;
            }
        }
</style>
@include('users.partials.blogs')

<section class="premium-section">
    <div class="container">
        <!-- Section Header -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <div class="section-badge">
                    Professional Services
                </div>
                <h2 class="premium-title">Branding Excellence</h2>
                <p class="premium-subtitle">
                    Create lasting impressions with professionally branded corporate gifts
                </p>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="row align-items-center">
            <!-- Image Column -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="image-container">
                    <img src="{{ home()->other_image_1 ? \Storage::url(home()->other_image_1) : url('users/images/brand.jpeg') }}" 
                         alt="Professional Branding Services" 
                         class="img-fluid">
                </div>
            </div>
            
            <!-- Content Column -->
            <div class="col-lg-6">
                <div class="content-body">
                    <h3 class="content-heading">
                        Branding That Leaves a Lasting Impression
                    </h3>
                    
                    <p class="content-text">
                        A company's brand is its stamp of approval — a symbol of trust, recognition, and appreciation. 
                        Strengthening corporate relationships through meaningful gifts not only supports business growth 
                        but also celebrates the people who contribute to it.
                    </p>
                    
                    <p class="content-text">
                        Recognition through gifting is always valued, and branded gifts serve as a lasting reminder of 
                        your appreciation and professional excellence.
                    </p>
                    
                    <p class="content-text">
                        At <span class="brand-highlight">Fernweh Premium Accessories</span>, we bring expertise in various branding techniques, considering 
                        not only the material and shape of each gift but also the complexity and style of your logo. 
                        Based on these factors, we recommend the <span class="brand-highlight">best branding method</span> to complement your 
                        brand identity perfectly.
                    </p>
                    
                    <a href="{{ route('branding') }}" class="cta-button">
                        <i class="fas fa-arrow-right"></i>
                        Explore Our Services
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection