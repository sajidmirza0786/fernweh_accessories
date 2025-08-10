@extends('users.master')

@section('seo')
<title>Contact | Fernweh Premium Accessories</title>
<meta name="description" content="Contact | Fernweh Premium Accessories">
<meta name="author" content="Contact | Fernweh Premium Accessories">
@endsection

@section('content')
<div class="container py-4">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4 pb-2 border-bottom">
        <ol class="breadcrumb bg-transparent p-0 mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact</li>
        </ol>
    </nav>

    <!-- Page Heading -->
    <div class="mb-5">
        <h1 class="h3 font-weight-bold mb-1">Contact Us</h1>
        <p class="text-muted">We’re here to help you. Reach out via phone, email, or our form below.</p>
    </div>

    <!-- Contact Cards -->
    <div class="row text-center mb-5">
        <div class="col-md-4 mb-4">
            <div class="p-4 border rounded-lg shadow-sm h-100">
                <i class="fas fa-phone fa-2x text-danger mb-3"></i>
                <h5 class="mb-2 font-weight-bold">Phone</h5>
                <p class="text-muted small mb-2">Call us during working hours for any inquiries.</p>
                <a href="tel:+918506959914" class="font-weight-bold text-dark">+91-8506959914</a>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-4 border rounded-lg shadow-sm h-100">
                <i class="fas fa-envelope fa-2x text-danger mb-3"></i>
                <h5 class="mb-2 font-weight-bold">Email</h5>
                <p class="text-muted small mb-2">Send us your queries and we’ll respond promptly.</p>
                <a href="mailto:mohdzikrullah9810@gmail.com" class="font-weight-bold text-dark">mohdzikrullah9810@gmail.com</a>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-4 border rounded-lg shadow-sm h-100">
                <i class="fas fa-map-marker-alt fa-2x text-danger mb-3"></i>
                <h5 class="mb-2 font-weight-bold">Location</h5>
                <p class="text-muted small mb-2">T222 gali No.3, Sadar Bazar, Nawab Road Delhi-110006</p>
                <a href="https://maps.app.goo.gl/egMLWa5vCfcNra2M8" target="_blank" class="font-weight-bold text-dark">View on Google Maps</a>
            </div>
        </div>
    </div>

    <!-- Contact Form -->
   <div class="mb-5">
       <h4 class="mb-3 font-weight-bold">Send us a Message</h4>

       @if(session('success'))
           <div class="alert alert-success">
               {{ session('success') }}
           </div>
       @endif

       @if(session('error'))
           <div class="alert alert-danger">
               {{ session('error') }}
           </div>
       @endif

       <form action="{{ route('ContactStore') }}" method="POST" class="p-4 border rounded-lg shadow-sm bg-white">
           @csrf
           <input type="hidden" name="page_url" value="{{ old('page_url', $product->slug ?? '') }}">

           <div class="form-row">
               <div class="form-group col-md-4">
                   <label class="small text-muted">Full Name</label>
                   <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       placeholder="John Doe" value="{{ old('name') }}" required>
                   @error('name')
                       <small class="text-danger">{{ $message }}</small>
                   @enderror
               </div>
               <div class="form-group col-md-4">
                   <label class="small text-muted">Mobile Number</label>
                   <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                       placeholder="+91-XXXXXXXXXX" value="{{ old('phone') }}" required>
                   @error('phone')
                       <small class="text-danger">{{ $message }}</small>
                   @enderror
               </div>
               <div class="form-group col-md-4">
                   <label class="small text-muted">Email Address</label>
                   <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       placeholder="you@example.com" value="{{ old('email') }}" required>
                   @error('email')
                       <small class="text-danger">{{ $message }}</small>
                   @enderror
               </div>
           </div>

           <div class="form-group">
               <label class="small text-muted">Subject</label>
               <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" 
                   placeholder="Subject" value="{{ old('subject') }}" required>
               @error('subject')
                   <small class="text-danger">{{ $message }}</small>
               @enderror
           </div>

           <div class="form-group">
               <label class="small text-muted">Your Message</label>
               <textarea name="message" rows="5" class="form-control @error('message') is-invalid @enderror" 
                   placeholder="Type your message..." required>{{ old('message') }}</textarea>
               @error('message')
                   <small class="text-danger">{{ $message }}</small>
               @enderror
           </div>

           <button type="submit" class="btn btn-primary px-4">Send Message</button>
       </form>
   </div>


    <!-- Google Map -->
    <div id="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.1556743033852!2d77.20656857651039!3d28.655057083055574!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfdc74e51e971%3A0xd6dfea02e12368c5!2sFernweh%20Premium%20accessories!5e0!3m2!1sen!2sin!4v1729493617879!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
   </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action="{{ route('ContactStore') }}"]');
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalBtnHtml = submitBtn.innerHTML;

    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Sending...`;
    });
});
</script>

@endsection
