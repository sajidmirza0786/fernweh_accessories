@include('users.partials.header')
@include('users.partials.navbar')
<title>Our Videos</title>
<div class="clear-fix"></div>
  <!-- ======= Hero Section ======= -->
  <main id="main">

  <section class="mt-5 card-header">
        <!--breadcumb-3 area are start-->
        <div class="breadcumb-area breadcumb-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 pt-2">
                        <div class="breadcumb-3-area">
                            <div class="bread-main-3">
                                <div class="bred-hading text-center">
                                    <ol class="breadcrumb">
                                        <li class="home"><a title="Go to Home Page" href="{{ route('welcome') }}">Home &nbsp;&nbsp; /  &nbsp;&nbsp;</a></li> 
                                        
                                        <li class="active">Our Videos</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcumb-3 area are start-->
  </section><!-- End Hero -->

    
    <section id="cta" class="cta bg-white">
      <div class="container" data-aos="fade-in">
        <div class="row">
          <div class="text-center col-md-12 py-4">
            <h1 class="text-dark">Our Videos</h1>
          </div>

          <div class="col-md-6 pt-3">
            <div class="card">
              <iframe width="100%" height="315" src="https://www.youtube.com/embed/usdlYOBU_4w" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          </div>

          <div class="col-md-6 pt-3">
            <div class="card">
              <iframe width="100%" height="315" src="https://www.youtube.com/embed/aCV_WkFjLyI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
@include('users.partials.footer')