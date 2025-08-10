@php
$uCategories = App\Models\Category::where('status','Active')->orderBy('name','asc')->get();
@endphp

<!-- Professional Footer Starts Here -->
<footer class="modern-footer">
    <!-- Main Footer Content -->
    <div class="footer-main">
        <div class="container">
            <div class="row g-4">
                <!-- Company Info Column -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <div class="footer-logo mb-4">
                            <a href="{{ route('welcome') }}">
                                <img src="{{ url('users/images/logo.png') }}" alt="Fernweh Premium Accessories" class="img-fluid" style="max-width: 180px;">
                            </a>
                        </div>
                        <p class="footer-description">
                            Established in Delhi, Fernweh Premium Accessories is a prominent and thriving company engaged in manufacturing and supplying high-quality leather bags and premium accessories to our prestigious customers worldwide.
                        </p>
                        
                        <!-- Social Media Links -->
                        <div class="social-links">
                            <h6 class="social-title">Follow Us</h6>
                            <div class="social-icons-wrapper">
                                <a href="https://www.facebook.com/share/1F3VcQX9QC/" target="_blank" class="social-icon facebook" aria-label="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://youtube.com/@fernweh-v7q?si=URR1BL_hJVUfJEt3" target="_blank" class="social-icon youtube" aria-label="YouTube">
                                    <i class="fab fa-youtube"></i>
                                </a>
                                <a href="https://www.instagram.com/fernweh_premium_accessories?igsh=NWRwMXl2Z3E1bXIy" target="_blank" class="social-icon instagram" aria-label="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Column -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h5 class="footer-title">Our Products</h5>
                        <ul class="footer-links">
                            @foreach($uCategories->take(8) as $uCat)
                            <li>
                                <a href="{{ route('products', $uCat) }}">
                                    <i class="fa fa-angle-right"></i>
                                    {{ $uCat->name ?? '' }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @if($uCategories->count() > 8)
                        <a href="#" class="view-all-link">
                            <i class="fa fa-plus-circle"></i> View All Products
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links Column -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h5 class="footer-title">Quick Links</h5>
                        <ul class="footer-links">
                            <li>
                                <a href="{{ route('about') }}">
                                    <i class="fa fa-angle-right"></i>
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}">
                                    <i class="fa fa-angle-right"></i>
                                    Contact Us
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('branding') }}">
                                    <i class="fa fa-angle-right"></i>
                                    Branding Services
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="return false;">
                                    <i class="fa fa-angle-right"></i>
                                    Quality Assurance
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="return false;">
                                    <i class="fa fa-angle-right"></i>
                                    Corporate Gifts
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="return false;">
                                    <i class="fa fa-angle-right"></i>
                                    Bulk Orders
                                </a>
                            </li>
                        </ul>

                        <!-- Company Stats -->
                        <div class="company-stats mt-4">
                            <div class="stat-item">
                                <div class="stat-number">20+</div>
                                <div class="stat-label">Years Experience</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">1000+</div>
                                <div class="stat-label">Happy Clients</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Info Column -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h5 class="footer-title">Get In Touch</h5>
                        
                        <!-- Contact Information -->
                        <div class="contact-info">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-details">
                                    <h6>Address</h6>
                                    <p>T222 Gali No.3, Sadar Bazar,<br>Nawab Road, Delhi-110006</p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="contact-details">
                                    <h6>Phone Numbers</h6>
                                    <p>
                                        <a href="tel:+918048778770">+91-80487 78770</a><br>
                                        <a href="tel:+918506959914">+91-85069 59914</a>
                                    </p>
                                </div>
                            </div>

                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="contact-details">
                                    <h6>Email</h6>
                                    <p>
                                        <a href="mailto:mohdzikrullah9810@gmail.com">mohdzikrullah9810@gmail.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Business Hours -->
                        <div class="business-hours mt-4">
                            <h6 class="hours-title">
                                <i class="fa fa-clock-o"></i> Business Hours
                            </h6>
                            <div class="hours-content">
                                <p><strong>Mon - Sat:</strong> 9:00 AM - 7:00 PM</p>
                                <p><strong>Sunday:</strong> Closed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="copyright-text">
                        <p>&copy; {{ date('Y') }} Royal Enterprises. All rights reserved.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-bottom-links">
                        <span>Designed by: 
                            <a href="https://www.cypwebtech.com/" target="_blank" class="designer-link">
                                <i class="fa fa-external-link"></i> CypWebtech
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Custom Footer Styles -->
<style>
/* Footer Main Styles */
.modern-footer {
    background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
    color: #ffffff;
    font-family: 'Poppins', sans-serif;
    position: relative;
    overflow: hidden;
}

.modern-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #dc3545 0%, #ff6b7a 50%, #dc3545 100%);
}

.footer-main {
    padding: 60px 0 40px;
    position: relative;
}

.footer-widget {
    height: 100%;
}

/* Footer Titles */
.footer-title {
    color: #dc3545;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 25px;
    position: relative;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.footer-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 40px;
    height: 2px;
    background: linear-gradient(90deg, #dc3545, #ff6b7a);
}

/* Footer Description */
.footer-description {
    color: #cccccc;
    font-size: 14px;
    line-height: 1.7;
    margin-bottom: 25px;
}

/* Footer Links */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
    transition: all 0.3s ease;
}

.footer-links li:hover {
    transform: translateX(5px);
}

.footer-links a {
    color: #cccccc;
    text-decoration: none;
    font-size: 14px;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
    position: relative;
}

.footer-links a i {
    color: #dc3545;
    margin-right: 8px;
    font-size: 12px;
    transition: all 0.3s ease;
}

.footer-links a:hover {
    color: #dc3545;
    padding-left: 5px;
}

.footer-links a:hover i {
    color: #ff6b7a;
    transform: rotate(90deg);
}

/* View All Link */
.view-all-link {
    color: #dc3545;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    margin-top: 15px;
    transition: all 0.3s ease;
}

.view-all-link:hover {
    color: #ff6b7a;
    transform: translateX(3px);
}

.view-all-link i {
    margin-right: 5px;
    font-size: 12px;
}

/* Social Media */
.social-title {
    color: #dc3545;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.social-icons-wrapper {
    display: flex;
    gap: 12px;
}

.social-icon {
    width: 40px;
    height: 40px;
    background: rgba(220, 53, 69, 0.1);
    border: 2px solid rgba(220, 53, 69, 0.3);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #dc3545;
    font-size: 16px;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.social-icon::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: #dc3545;
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.3s ease;
    z-index: -1;
}

.social-icon:hover::before {
    width: 100%;
    height: 100%;
}

.social-icon:hover {
    color: #ffffff;
    border-color: #dc3545;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
}

/* Contact Information */
.contact-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 25px;
    padding: 15px;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 8px;
    border-left: 3px solid #dc3545;
    transition: all 0.3s ease;
}

.contact-item:hover {
    background: rgba(220, 53, 69, 0.05);
    transform: translateX(5px);
}

.contact-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #dc3545, #ff6b7a);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 16px;
    margin-right: 15px;
    flex-shrink: 0;
}

.contact-details h6 {
    color: #dc3545;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.contact-details p {
    color: #cccccc;
    font-size: 13px;
    line-height: 1.6;
    margin: 0;
}

.contact-details a {
    color: #cccccc;
    text-decoration: none;
    transition: color 0.3s ease;
}

.contact-details a:hover {
    color: #dc3545;
}

/* Company Stats */
.company-stats {
    display: flex;
    gap: 20px;
}

.stat-item {
    text-align: center;
    padding: 15px;
    background: rgba(220, 53, 69, 0.1);
    border-radius: 8px;
    border: 1px solid rgba(220, 53, 69, 0.2);
    flex: 1;
    transition: all 0.3s ease;
}

.stat-item:hover {
    background: rgba(220, 53, 69, 0.15);
    transform: translateY(-3px);
}

.stat-number {
    font-size: 20px;
    font-weight: 700;
    color: #dc3545;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 11px;
    color: #cccccc;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Business Hours */
.business-hours {
    background: rgba(255, 255, 255, 0.02);
    border-radius: 8px;
    padding: 20px;
    border: 1px solid rgba(220, 53, 69, 0.2);
}

.hours-title {
    color: #dc3545;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.hours-title i {
    margin-right: 8px;
    font-size: 16px;
}

.hours-content p {
    color: #cccccc;
    font-size: 13px;
    margin-bottom: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.hours-content strong {
    color: #ffffff;
}

/* Footer Bottom */
.footer-bottom {
    background: rgba(0, 0, 0, 0.8);
    padding: 20px 0;
    border-top: 1px solid rgba(220, 53, 69, 0.2);
}

.copyright-text p {
    color: #cccccc;
    font-size: 13px;
    margin: 0;
}

.footer-bottom-links {
    text-align: right;
    color: #cccccc;
    font-size: 13px;
}

.designer-link {
    color: #dc3545;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.designer-link:hover {
    color: #ff6b7a;
}

.designer-link i {
    margin-left: 5px;
    font-size: 11px;
}

/* Responsive Design */
@media (max-width: 991px) {
    .footer-main {
        padding: 40px 0 30px;
    }
    
    .company-stats {
        justify-content: center;
        margin-top: 20px;
    }
    
    .footer-bottom-links {
        text-align: center;
        margin-top: 10px;
    }
}

@media (max-width: 767px) {
    .footer-main {
        padding: 30px 0 20px;
    }
    
    .footer-widget {
        margin-bottom: 30px;
    }
    
    .social-icons-wrapper {
        justify-content: center;
    }
    
    .company-stats {
        flex-direction: column;
        gap: 10px;
    }
    
    .contact-item {
        margin-bottom: 20px;
        padding: 12px;
    }
    
    .footer-title {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .footer-title::after {
        left: 50%;
        transform: translateX(-50%);
    }
}

/* Animation for footer elements */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.footer-widget {
    animation: fadeInUp 0.6s ease-out;
}

.footer-widget:nth-child(2) { animation-delay: 0.1s; }
.footer-widget:nth-child(3) { animation-delay: 0.2s; }
.footer-widget:nth-child(4) { animation-delay: 0.3s; }

/* Dropdown item styling */
.dropdown-item {
    border-bottom: 1px solid rgba(220, 53, 69, 0.2);
    transition: all 0.3s ease;
}

.dropdown-item:hover {
    background-color: rgba(220, 53, 69, 0.1);
    border-left: 3px solid #dc3545;
    padding-left: 18px;
}
</style>

<!-- Bootstrap core JavaScript -->
<script src="{{ url('users/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ url('users/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Additional Scripts -->
<script src="{{ url('users/assets/js/custom.js') }}"></script>
<script src="{{ url('users/assets/js/owl.js') }}"></script>
<script src="{{ url('users/assets/js/slick.js') }}"></script>
<script src="{{ url('users/assets/js/accordions.js') }}"></script>

<!-- Custom Footer JavaScript -->
<script>
// Clear field functionality
var cleared = [];
cleared[0] = cleared[1] = cleared[2] = 0;

function clearField(t) {
    if (!cleared[t.id]) {
        cleared[t.id] = 1;
        t.value = '';
        t.style.color = '#fff';
    }
}

// Smooth scroll for footer links
$(document).ready(function() {
    // Add smooth scrolling to all footer links
    $('.footer-links a[href^="#"]').on('click', function(e) {
        var target = $(this.hash);
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 80
            }, 800);
        }
    });
    
    // Add loading animation to footer
    $('.footer-widget').each(function(index) {
        $(this).delay(100 * index).queue(function(next) {
            $(this).addClass('animate-fade-in-up');
            next();
        });
    });
    
    // Phone number formatting
    $('a[href^="tel:"]').each(function() {
        var phoneNumber = $(this).attr('href').replace('tel:', '');
        $(this).text(phoneNumber);
    });
});

// Add scroll-to-top functionality
$(window).scroll(function() {
    if ($(this).scrollTop() > 300) {
        if (!$('.scroll-to-top').length) {
            $('body').append(`
                <div class="scroll-to-top" style="
                    position: fixed;
                    bottom: 30px;
                    right: 30px;
                    width: 50px;
                    height: 50px;
                    background: linear-gradient(135deg, #dc3545, #ff6b7a);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 18px;
                    cursor: pointer;
                    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
                    transition: all 0.3s ease;
                    z-index: 1000;
                " onclick="$('html, body').animate({scrollTop: 0}, 800);">
                    <i class="fa fa-arrow-up"></i>
                </div>
            `);
        }
        $('.scroll-to-top').fadeIn();
    } else {
        $('.scroll-to-top').fadeOut();
    }
});
</script>

</body>
</html>