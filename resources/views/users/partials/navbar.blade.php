@php
$uCategories = App\Models\Category::where('status','Active')->orderBy('name','asc')->get();
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow">
    <div class="container">
        <!-- Brand Logo -->
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <img src="{{ home()->logo ? \Storage::url(home()->logo) : url('users/images/logob.png') }}" alt="Logo" height="45" class="d-inline-block align-top">
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="custom-toggler-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </button>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse mobile-slide-menu" id="mainNavbar">
            <ul class="navbar-nav ml-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('welcome') }}">
                        <i class="fas fa-home mr-2 d-lg-none"></i>Home
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('about') }}">
                        <i class="fas fa-info-circle mr-2 d-lg-none"></i>About Us
                    </a>
                </li>
                
                <!-- Products Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark dropdown-toggle" href="#" id="productsDropdown" role="button" 
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-box mr-2 d-lg-none"></i>Products
                    </a>
                    <div class="dropdown-menu professional-dropdown" aria-labelledby="productsDropdown">
                        @foreach($uCategories as $uCat)
                            <a class="dropdown-item" href="{{ route('products', $uCat) }}">
                                <i class="fas fa-chevron-right mr-2"></i>
                                {{ str($uCat->name)->limit(20) }}
                            </a>
                        @endforeach
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('branding') }}">
                        <i class="fas fa-paint-brush mr-2 d-lg-none"></i>Branding
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('contact') }}">
                        <i class="fas fa-phone mr-2 d-lg-none"></i>Contact Us
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('ourBlogs') }}">
                        <i class="fas fa-blog mr-2 d-lg-none"></i>Blogs
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Mobile Menu Overlay -->
<div class="mobile-overlay" id="mobileOverlay"></div>

<!-- Professional Navbar Styles -->
<style>
/* Modern Professional Navbar */
.navbar {
    padding: 1rem 0;
    border-bottom: 2px solid #f8f9fa;
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
}

.navbar.scrolled {
    padding: 0.5rem 0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

/* Brand Logo */
.navbar-brand {
    font-weight: 700;
    font-size: 1.5rem;
}

.navbar-brand img {
    transition: all 0.3s ease;
    filter: brightness(1);
}

.navbar-brand:hover img {
    transform: scale(1.05);
    filter: brightness(1.1);
}

/* Custom Toggle Button */
.custom-toggler {
    border: none;
    padding: 8px;
    background: #dc3545;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
    z-index: 1051;
}

.custom-toggler:hover {
    background: #c82333;
    transform: scale(1.05);
}

.custom-toggler:focus {
    box-shadow: 0 0 0 3px rgba(220,53,69,0.25);
    outline: none;
}

/* Custom Hamburger Icon */
.custom-toggler-icon {
    width: 24px;
    height: 18px;
    position: relative;
    transform: rotate(0deg);
    transition: .3s ease-in-out;
    cursor: pointer;
    display: block;
}

.custom-toggler-icon span {
    display: block;
    position: absolute;
    height: 3px;
    width: 100%;
    background: white;
    border-radius: 2px;
    opacity: 1;
    left: 0;
    transform: rotate(0deg);
    transition: .3s ease-in-out;
}

.custom-toggler-icon span:nth-child(1) {
    top: 0px;
}

.custom-toggler-icon span:nth-child(2) {
    top: 7px;
}

.custom-toggler-icon span:nth-child(3) {
    top: 14px;
}

/* Animated hamburger to X */
.custom-toggler[aria-expanded="true"] .custom-toggler-icon span:nth-child(1) {
    top: 7px;
    transform: rotate(135deg);
}

.custom-toggler[aria-expanded="true"] .custom-toggler-icon span:nth-child(2) {
    opacity: 0;
    left: -60px;
}

.custom-toggler[aria-expanded="true"] .custom-toggler-icon span:nth-child(3) {
    top: 7px;
    transform: rotate(-135deg);
}

/* Navigation Links */
.nav-link {
    font-weight: 500;
    font-size: 0.95rem;
    padding: 0.75rem 1rem !important;
    margin: 0 0.25rem;
    border-radius: 8px;
    transition: all 0.2s ease;
    position: relative;
    color: #495057 !important;
}

.nav-link:hover {
    color: #495057 !important;
    background: rgba(0,0,0,0.04);
}

.nav-link.active {
    color: #495057 !important;
    background: rgba(0,0,0,0.08);
}

/* Professional Dropdown */
.professional-dropdown {
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    padding: 0.5rem 0;
    margin-top: 0.5rem;
    background: white;
    min-width: 250px;
    max-width: 320px;
    max-height: 350px;
    overflow-y: auto;
}

/* Custom scrollbar for dropdown */
.professional-dropdown::-webkit-scrollbar {
    width: 6px;
}

.professional-dropdown::-webkit-scrollbar-track {
    background: #f8f9fa;
    border-radius: 10px;
}

.professional-dropdown::-webkit-scrollbar-thumb {
    background: #dee2e6;
    border-radius: 10px;
}

.professional-dropdown::-webkit-scrollbar-thumb:hover {
    background: #adb5bd;
}

.professional-dropdown::before {
    content: '';
    position: absolute;
    top: -8px;
    left: 20px;
    width: 16px;
    height: 16px;
    background: white;
    transform: rotate(45deg);
    border-top: 1px solid rgba(0,0,0,0.08);
    border-left: 1px solid rgba(0,0,0,0.08);
}

.dropdown-item {
    padding: 0.6rem 1.25rem;
    font-weight: 400;
    color: #495057;
    transition: all 0.15s ease;
    border-radius: 0;
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.dropdown-item:hover {
    background: rgba(0,0,0,0.04);
    color: #495057;
}

.dropdown-item i {
    transition: all 0.2s ease;
    font-size: 0.75rem;
    opacity: 0.6;
    min-width: 12px;
}

.dropdown-item:hover i {
    opacity: 0.8;
}

/* Mobile Styles */
@media (max-width: 991.98px) {
    /* Mobile overlay */
    .mobile-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 1040;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    
    .mobile-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    
    /* Mobile slide menu */
    .mobile-slide-menu {
        position: fixed;
        top: 0;
        right: -350px;
        width: 320px;
        height: 100vh;
        background: #ffffff;
        z-index: 1050;
        transition: right 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        overflow-y: auto;
        border-radius: 0;
        box-shadow: -5px 0 25px rgba(0,0,0,0.15);
        border-left: 1px solid rgba(0,0,0,0.08);
    }
    
    .mobile-slide-menu.show {
        right: 0;
    }
    
    /* Mobile menu header */
    .mobile-slide-menu::before {
        content: 'Menu';
        display: block;
        padding: 2rem 1.5rem 1.5rem;
        font-size: 1.4rem;
        font-weight: 600;
        color: #495057;
        border-bottom: 1px solid rgba(0,0,0,0.08);
        margin-bottom: 1rem;
        background: #fafafa;
    }
    
    .navbar-nav {
        padding: 0 1.25rem 2rem;
        width: 100%;
    }
    
    .nav-item {
        margin: 0.25rem 0;
        width: 100%;
    }
    
    .nav-link {
        padding: 0.9rem 1.25rem !important;
        margin: 0 1rem 0.4rem;
        border-radius: 8px;
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.04);
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        color: #495057 !important;
        font-weight: 500;
    }
    
    .nav-link i {
        font-size: 1rem;
        color: #dc3545;
        width: 20px;
        margin-right: 12px;
    }
    
    .nav-link:hover {
        background: rgba(0,0,0,0.04);
        color: #495057 !important;
        transform: none;
        box-shadow: none;
        border-color: rgba(0,0,0,0.08);
    }
    
    .nav-link:hover i {
        color: #dc3545;
    }
    
    /* Mobile dropdown */
    .dropdown-menu {
        position: static !important;
        transform: none !important;
        width: calc(100% - 2rem) !important;
        border: 1px solid rgba(0,0,0,0.06);
        border-radius: 8px;
        margin: 0.3rem 1rem 0.5rem;
        background: #fafafa;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.04);
        max-height: 0;
        overflow: hidden;
        transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    .dropdown.show .dropdown-menu {
        max-height: 280px;
        padding: 0.6rem 0;
        overflow-y: auto;
    }
    
    /* Mobile dropdown scrollbar */
    .dropdown.show .dropdown-menu::-webkit-scrollbar {
        width: 4px;
    }
    
    .dropdown.show .dropdown-menu::-webkit-scrollbar-track {
        background: rgba(0,0,0,0.03);
        border-radius: 4px;
    }
    
    .dropdown.show .dropdown-menu::-webkit-scrollbar-thumb {
        background: rgba(220,53,69,0.3);
        border-radius: 4px;
    }
    
    .dropdown.show .dropdown-menu::-webkit-scrollbar-thumb:hover {
        background: rgba(220,53,69,0.5);
    }
    
    .dropdown-item {
        padding: 0.7rem 1rem;
        margin: 0.2rem 0.5rem;
        border-radius: 6px;
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.03);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        color: #495057;
        font-weight: 400;
    }
    
    .dropdown-item i {
        color: #dc3545;
        font-size: 0.75rem;
        margin-right: 8px;
        opacity: 0.7;
    }
    
    .dropdown-item:hover {
        background: rgba(0,0,0,0.04);
        color: #495057;
        transform: none;
        border-color: rgba(0,0,0,0.06);
    }
    
    .dropdown-item:hover i {
        opacity: 1;
    }
}

@media (max-width: 576px) {
    .mobile-slide-menu {
        width: 280px;
        right: -300px;
    }
    
    .navbar-brand img {
        height: 35px;
    }
    
    .navbar {
        padding: 0.75rem 0;
    }
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Loading animation */
@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.mobile-slide-menu.show .nav-item {
    animation: slideInRight 0.3s ease forwards;
}

.mobile-slide-menu.show .nav-item:nth-child(1) { animation-delay: 0.1s; }
.mobile-slide-menu.show .nav-item:nth-child(2) { animation-delay: 0.15s; }
.mobile-slide-menu.show .nav-item:nth-child(3) { animation-delay: 0.2s; }
.mobile-slide-menu.show .nav-item:nth-child(4) { animation-delay: 0.25s; }
.mobile-slide-menu.show .nav-item:nth-child(5) { animation-delay: 0.3s; }
.mobile-slide-menu.show .nav-item:nth-child(6) { animation-delay: 0.35s; }
</style>

<!-- Professional JavaScript -->
<script>
$(document).ready(function() {
    const $navbar = $('.navbar');
    const $toggler = $('.custom-toggler');
    const $navbarCollapse = $('#mainNavbar');
    const $overlay = $('#mobileOverlay');
    
    // Navbar scroll effect
    $(window).scroll(function() {
        if ($(window).scrollTop() > 100) {
            $navbar.addClass('scrolled');
        } else {
            $navbar.removeClass('scrolled');
        }
    });
    
    // Mobile menu toggle
    $toggler.on('click', function() {
        const isExpanded = $(this).attr('aria-expanded') === 'true';
        
        if (!isExpanded) {
            // Open menu
            $navbarCollapse.addClass('show');
            $overlay.addClass('active');
            $('body').addClass('overflow-hidden');
            $(this).attr('aria-expanded', 'true');
        } else {
            // Close menu
            closeMenu();
        }
    });
    
    // Close menu function
    function closeMenu() {
        $navbarCollapse.removeClass('show');
        $overlay.removeClass('active');
        $('body').removeClass('overflow-hidden');
        $toggler.attr('aria-expanded', 'false');
        
        // Close any open dropdowns
        $('.dropdown-menu').removeClass('show');
        $('.dropdown-toggle').attr('aria-expanded', 'false');
    }
    
    // Close menu when clicking overlay
    $overlay.on('click', closeMenu);
    
    // Close menu when clicking nav links (except dropdown toggle)
    $('.nav-link:not(.dropdown-toggle)').on('click', function() {
        if ($(window).width() < 992) {
            setTimeout(closeMenu, 200);
        }
    });
    
    // Handle dropdown on mobile
    $('.dropdown-toggle').on('click', function(e) {
        if ($(window).width() < 992) {
            e.preventDefault();
            const $dropdown = $(this).closest('.dropdown');
            const $menu = $dropdown.find('.dropdown-menu');
            
            if ($dropdown.hasClass('show')) {
                $dropdown.removeClass('show');
                $menu.removeClass('show');
                $(this).attr('aria-expanded', 'false');
            } else {
                // Close other dropdowns
                $('.dropdown').removeClass('show');
                $('.dropdown-menu').removeClass('show');
                $('.dropdown-toggle').attr('aria-expanded', 'false');
                
                // Open this dropdown
                $dropdown.addClass('show');
                $menu.addClass('show');
                $(this).attr('aria-expanded', 'true');
            }
        }
    });
    
    // Close menu on window resize
    $(window).on('resize', function() {
        if ($(window).width() >= 992) {
            closeMenu();
        }
    });
    
    // Prevent body scroll when menu is open
    $('body').addClass('overflow-hidden').removeClass('overflow-hidden');
});
</script>
