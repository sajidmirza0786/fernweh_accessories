<!-- WHO WE ARE SECTION -->
<section class="who-we-are py-5 pb-0 mb-0">
    <div class="container">
        <div class="row align-items-center">
            
            <!-- Left Column: Video -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="video-container">
                    <iframe width="100%" height="360" 
                        src="https://www.youtube.com/embed/1hU-zT-oTQc?si=q05iX4tMsft0q7hx" 
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen></iframe>
                </div>
            </div>
            
            <!-- Right Column: Content -->
            <div class="col-lg-6">
                <div class="content-wrapper">
                    <span class="section-badge">Who we are</span>
                    <h2 class="section-title">Get to know about <span class="text-accent">our company</span></h2>
                    <p class="section-description pb-3">
                        Royal Enterprises, since 2000, has been one of the most renowned manufacturers, exporters, 
                        and suppliers of an extensive range of laptop bags, backpack bags, duffle bags, and much more.
                    </p>
                    <a href="#" class="btn-danger btn">
                        <span>Read More</span>
                        &nbsp;&nbsp;<i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STYLES -->
<style>
    .who-we-are {
        background-color: #ffffff;
        padding: 80px 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
        align-items: center;
    }

    .col-lg-6 {
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
    }

    @media (min-width: 992px) {
        .col-lg-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    @media (min-width: 992px) {
        .mb-lg-0 {
            margin-bottom: 0 !important;
        }
    }

    .g-5 {
        gap: 3rem;
    }

    /* Video Styling */
    .video-container {
        position: relative;
        width: 100%;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .video-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .video-container iframe {
        width: 100%;
        height: 360px;
        border: none;
        display: block;
    }

    /* Content Styling */
    .content-wrapper {
        padding-left: 20px;
    }

    .section-badge {
        display: inline-block;
        background-color: #f8f9fa;
        color: #4285f4;
        font-size: 14px;
        font-weight: 500;
        padding: 8px 16px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 20px;
        border: 1px solid #e8eaed;
    }

    .section-title {
        font-size: 36px;
        font-weight: 400;
        line-height: 1.3;
        margin-bottom: 24px;
        color: #202124;
    }

    .text-accent {
        color: #4285f4;
        font-weight: 500;
    }

    .section-description {
        font-size: 16px;
        line-height: 1.7;
        color: #5f6368;
        margin-bottom: 32px;
        max-width: 90%;
    }

    /* Responsive Design */
    @media (max-width: 991.98px) {
        .content-wrapper {
            padding-left: 0;
            text-align: center;
        }

        .section-title {
            font-size: 32px;
        }

        .who-we-are {
            padding: 60px 0;
        }
    }

    @media (max-width: 768px) {
        .section-title {
            font-size: 28px;
        }

        .video-container iframe {
            height: 250px;
        }

        .section-description {
            max-width: 100%;
        }

        .who-we-are {
            padding: 40px 0;
        }

        .container {
            padding: 0 15px;
        }
    }

    @media (max-width: 576px) {
        .section-title {
            font-size: 24px;
        }

        .btn-primary-custom {
            padding: 12px 24px;
            font-size: 15px;
        }
    }
</style>