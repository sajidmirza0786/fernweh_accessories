<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <!-- App Brand -->
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <img src="{{ url('users/images/logob.png') }}" 
                 width="100px" 
                 alt="Fernweh Accessories Logo"
                 class="app-brand-logo">
            {{-- Alternative text logo if needed --}}
            {{-- <h5 class="app-brand-text demo menu-text fw-bolder ms-2">Parcial on Board</h5> --}}
        </a>
        <a href="javascript:void(0);" 
           class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <!-- Navigation Menu -->
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- Menu Divider -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Content Management</span>
        </li>

        <!-- Categories -->
        <li class="menu-item {{ request()->routeIs('admin.categories.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-category-alt"></i>
                <div data-i18n="Categories">Categories</div>
                @php
                    $categoryCount = \App\Models\Category::count();
                @endphp
                @if($categoryCount > 0)
                    <div class="badge badge-center rounded-pill bg-primary ms-auto">{{ $categoryCount }}</div>
                @endif
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}" class="menu-link">
                        <div data-i18n="All Categories">All Categories</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.categories.create') || request()->routeIs('admin.categories.edit') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.create') }}" class="menu-link">
                        <div data-i18n="Add Category">Add Category</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Products -->
        <li class="menu-item {{ request()->routeIs('admin.products.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Products">Products</div>
                @php
                    $productCount = \App\Models\Product::count();
                @endphp
                @if($productCount > 0)
                    <div class="badge badge-center rounded-pill bg-success ms-auto">{{ $productCount }}</div>
                @endif
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}" class="menu-link">
                        <div data-i18n="All Products">All Products</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.products.create') || request()->routeIs('admin.products.edit') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.create') }}" class="menu-link">
                        <div data-i18n="Add Product">Add Product</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Menu Divider -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Blogs Management</span>
        </li>

        <!-- Products -->
        <li class="menu-item {{ request()->routeIs('admin.blogs.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="blogs">blogs</div>
                @php
                    $blogsCount = \App\Models\Blog::count();
                @endphp
                @if($blogsCount > 0)
                    <div class="badge badge-center rounded-pill bg-success ms-auto">{{ $blogsCount }}</div>
                @endif
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.blogs.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.blogs.index') }}" class="menu-link">
                        <div data-i18n="All blogs">All Blogs</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.blogs.create') || request()->routeIs('admin.blogs.edit') ? 'active' : '' }}">
                    <a href="{{ route('admin.blogs.create') }}" class="menu-link">
                        <div data-i18n="Add Blog">Add Blog</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Menu Divider -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">System</span>
        </li>

        <!-- Settings -->
        <li class="menu-item {{ request()->routeIs('admin.homepage.*') ? 'active' : '' }}">
            <a href="{{ route('admin.homepage.edit') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Settings">Update Settings</div>
            </a>
        </li>

        <!-- Settings -->
        <li class="menu-item {{ request()->routeIs('admin.enquiries.*') ? 'active' : '' }}">
            <a href="{{ route('admin.enquiries.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Settings">Enquiries</div>
            </a>
        </li>
    </ul>
</aside>

<!-- Custom Styles for Enhanced Menu -->
<style>
/* Logo styling */
.app-brand-logo {
    max-height: 40px;
    width: auto;
    transition: all 0.3s ease;
}

.app-brand-logo:hover {
    transform: scale(1.05);
}

/* Menu header styling */
.menu-header {
    padding: 1rem 1.5rem 0.5rem;
    margin-top: 1rem;
}

.menu-header:first-child {
    margin-top: 0;
}

.menu-header-text {
    color: #a7acb2;
    font-weight: 600;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}

/* Badge styling for counters */
.badge {
    font-size: 0.625rem;
    min-width: 18px;
    height: 18px;
    line-height: 1;
}

.badge-center {
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Menu item hover effects */
.menu-item .menu-link {
    transition: all 0.3s ease;
    border-radius: 6px;
    margin: 2px 8px;
}

.menu-item .menu-link:hover {
    background-color: rgba(67, 89, 113, 0.04);
    transform: translateX(4px);
}

.menu-item.active > .menu-link {
    background-color: rgba(105, 108, 255, 0.08);
    color: #696cff;
    font-weight: 500;
}

.menu-item.active > .menu-link .menu-icon {
    color: #696cff;
}

/* Sub-menu styling */
.menu-sub .menu-item .menu-link {
    padding-left: 3rem;
    font-size: 0.9rem;
}

.menu-sub .menu-item.active .menu-link {
    background-color: rgba(105, 108, 255, 0.12);
    border-left: 3px solid #696cff;
    border-radius: 0 6px 6px 0;
}

/* Icon spacing */
.menu-icon {
    margin-right: 0.75rem;
    font-size: 1.125rem;
    color: #a7acb2;
    transition: color 0.3s ease;
}

/* Menu toggle arrow animation */
.menu-toggle::after {
    transition: transform 0.3s ease;
}

.menu-item.open > .menu-toggle::after {
    transform: rotate(90deg);
}

/* Responsive adjustments */
@media (max-width: 1199.98px) {
    .layout-menu-toggle {
        display: block !important;
    }
}

/* Scrollbar styling for menu */
.menu-inner::-webkit-scrollbar {
    width: 4px;
}

.menu-inner::-webkit-scrollbar-track {
    background: transparent;
}

.menu-inner::-webkit-scrollbar-thumb {
    background: rgba(167, 172, 178, 0.3);
    border-radius: 2px;
}

.menu-inner::-webkit-scrollbar-thumb:hover {
    background: rgba(167, 172, 178, 0.5);
}
</style>