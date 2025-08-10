@extends('admin.master')

@section('seo')
    <title>Edit Home Page Settings</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active fw-semibold">Edit Home Page</li>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-10 col-md-12 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 fw-bold text-white">
                        <i class='bx bx-home me-2'></i>Edit Home Page Settings
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.homepage.update', $homePage) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Nav Tabs for Sections --}}
                        <ul class="nav nav-pills mb-4" id="homePageTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="seo-tab" data-bs-toggle="pill" data-bs-target="#seo-section" type="button" role="tab" aria-controls="seo-section" aria-selected="true">General & SEO</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="pill" data-bs-target="#contact-section" type="button" role="tab" aria-controls="contact-section" aria-selected="false">Contact Info</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="about-tab" data-bs-toggle="pill" data-bs-target="#about-section" type="button" role="tab" aria-controls="about-section" aria-selected="false">About Section</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="images-tab" data-bs-toggle="pill" data-bs-target="#images-section" type="button" role="tab" aria-controls="images-section" aria-selected="false">Images & Banners</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="social-tab" data-bs-toggle="pill" data-bs-target="#social-section" type="button" role="tab" aria-controls="social-section" aria-selected="false">Social & Footer</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">

                            {{-- General & SEO Section --}}
                            <div class="tab-pane fade show active" id="seo-section" role="tabpanel" aria-labelledby="seo-tab">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Website Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $homePage->title) }}" placeholder="e.g., My Company Official Site">
                                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <small class="form-text text-muted">Title shown in the browser tab and search results.</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Meta Keywords</label>
                                    <input type="text" name="keywords" class="form-control @error('keywords') is-invalid @enderror" value="{{ old('keywords', $homePage->keywords) }}" placeholder="e.g., furniture, decor, home goods">
                                    @error('keywords')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <small class="form-text text-muted">Comma-separated keywords for SEO.</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Meta Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Brief description for search engines.">{{ old('description', $homePage->description) }}</textarea>
                                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <small class="form-text text-muted">This description appears in search results.</small>
                                </div>
                            </div>

                            {{-- Contact Information Section --}}
                            <div class="tab-pane fade" id="contact-section" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Primary Mobile</label>
                                        <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile', $homePage->mobile) }}" placeholder="e.g., +1 555-123-4567">
                                        @error('mobile')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Alternative Mobile (Optional)</label>
                                        <input type="text" name="alt_mobile" class="form-control @error('alt_mobile') is-invalid @enderror" value="{{ old('alt_mobile', $homePage->alt_mobile) }}" placeholder="e.g., +1 555-987-6543">
                                        @error('alt_mobile')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Primary Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $homePage->email) }}" placeholder="e.g., contact@mycompany.com">
                                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Alternative Email (Optional)</label>
                                        <input type="email" name="alt_email" class="form-control @error('alt_email') is-invalid @enderror" value="{{ old('alt_email', $homePage->alt_email) }}" placeholder="e.g., support@mycompany.com">
                                        @error('alt_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Address</label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2" placeholder="Street, City, State, ZIP">{{ old('address', $homePage->address) }}</textarea>
                                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            {{-- About Section --}}
                            <div class="tab-pane fade" id="about-section" role="tabpanel" aria-labelledby="about-tab">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">About Section Heading</label>
                                    <input type="text" name="heading" class="form-control @error('heading') is-invalid @enderror" value="{{ old('heading', $homePage->heading) }}" placeholder="e.g., Welcome to Our Company">
                                    @error('heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Short About Description</label>
                                    <textarea name="short_about_description" class="form-control @error('short_about_description') is-invalid @enderror" rows="3" placeholder="Brief summary for the main landing page.">{{ old('short_about_description', $homePage->short_about_description) }}</textarea>
                                    @error('short_about_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Long About Description</label>
                                    <textarea name="long_about_description" id="long_about_description" class="form-control @error('long_about_description') is-invalid @enderror" rows="6" placeholder="Detailed story about your company.">{{ old('long_about_description', $homePage->long_about_description) }}</textarea>
                                    @error('long_about_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            {{-- Images & Banners Section --}}
                            <div class="tab-pane fade" id="images-section" role="tabpanel" aria-labelledby="images-tab">
                                <div class="row">
                                    {{-- Favicon --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Favicon</label>
                                        <input type="file" name="favicon" class="form-control @error('favicon') is-invalid @enderror" accept="image/*">
                                        @error('favicon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        @if($homePage->favicon)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $homePage->favicon) }}" width="60" class="rounded border shadow-sm" alt="Favicon">
                                                <small class="text-muted d-block mt-1">Current Favicon. Upload to replace.</small>
                                            </div>
                                        @else
                                            <small class="form-text text-muted d-block mt-1">Recommended size: 32x32px</small>
                                        @endif
                                    </div>
                                    {{-- Logo --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Website Logo</label>
                                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                                        @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        @if($homePage->logo)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $homePage->logo) }}" height="50" class="rounded border shadow-sm" alt="Logo">
                                                <small class="text-muted d-block mt-1">Current Logo. Upload to replace.</small>
                                            </div>
                                        @else
                                            <small class="form-text text-muted d-block mt-1">Recommended size: 200x50px</small>
                                        @endif
                                    </div>
                                    {{-- Banner 1 --}}
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-semibold">Banner Image 1</label>
                                        <input type="file" name="banner_image_1" class="form-control @error('banner_image_1') is-invalid @enderror" accept="image/*">
                                        @error('banner_image_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        @if($homePage->banner_image_1)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $homePage->banner_image_1) }}" width="100%" class="rounded border shadow-sm" alt="Banner Image 1">
                                                <small class="text-muted d-block mt-1">Current Banner. Upload to replace.</small>
                                            </div>
                                        @else
                                            <small class="form-text text-muted d-block mt-1">Recommended size: 1920x600px</small>
                                        @endif
                                    </div>
                                    {{-- Banner 2 --}}
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-semibold">Banner Image 2</label>
                                        <input type="file" name="banner_image_2" class="form-control @error('banner_image_2') is-invalid @enderror" accept="image/*">
                                        @error('banner_image_2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        @if($homePage->banner_image_2)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $homePage->banner_image_2) }}" width="100%" class="rounded border shadow-sm" alt="Banner Image 2">
                                                <small class="text-muted d-block mt-1">Current Banner. Upload to replace.</small>
                                            </div>
                                        @else
                                            <small class="form-text text-muted d-block mt-1">Recommended size: 1920x600px</small>
                                        @endif
                                    </div>
                                    {{-- Banner 3 --}}
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-semibold">Banner Image 3</label>
                                        <input type="file" name="banner_image_3" class="form-control @error('banner_image_3') is-invalid @enderror" accept="image/*">
                                        @error('banner_image_3')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        @if($homePage->banner_image_3)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $homePage->banner_image_3) }}" width="100%" class="rounded border shadow-sm" alt="Banner Image 3">
                                                <small class="text-muted d-block mt-1">Current Banner. Upload to replace.</small>
                                            </div>
                                        @else
                                            <small class="form-text text-muted d-block mt-1">Recommended size: 1920x600px</small>
                                        @endif
                                    </div>
                                    {{-- Other Image 1 --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Home page branding (800*800px)</label>
                                        <input type="file" name="other_image_1" class="form-control @error('other_image_1') is-invalid @enderror" accept="image/*">
                                        @error('other_image_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        @if($homePage->other_image_1)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $homePage->other_image_1) }}" width="100%" class="rounded border shadow-sm" alt="Other Image 1">
                                                <small class="text-muted d-block mt-1">Current Image. Upload to replace.</small>
                                            </div>
                                        @else
                                            <small class="form-text text-muted d-block mt-1">Used for marketing sections.</small>
                                        @endif
                                    </div>
                                    {{-- Other Image 2 --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Other Image 2</label>
                                        <input type="file" name="other_image_2" class="form-control @error('other_image_2') is-invalid @enderror" accept="image/*">
                                        @error('other_image_2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        @if($homePage->other_image_2)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $homePage->other_image_2) }}" width="100%" class="rounded border shadow-sm" alt="Other Image 2">
                                                <small class="text-muted d-block mt-1">Current Image. Upload to replace.</small>
                                            </div>
                                        @else
                                            <small class="form-text text-muted d-block mt-1">Used for marketing sections.</small>
                                        @endif
                                    </div>
                                </div>
                                <hr class="my-4">
                                {{-- Section Visibility Toggles --}}
                                {{-- <div class="d-flex align-items-center mb-3">
                                    <div class="form-check form-switch me-4">
                                        <input class="form-check-input" type="checkbox" id="showBanners" name="show_banners" value="1" @checked(old('show_banners', $homePage->show_banners))>
                                        <label class="form-check-label" for="showBanners">Show Banners</label>
                                    </div>
                                    <div class="form-check form-switch me-4">
                                        <input class="form-check-input" type="checkbox" id="showAbout" name="show_about_section" value="1" @checked(old('show_about_section', $homePage->show_about_section))>
                                        <label class="form-check-label" for="showAbout">Show About Section</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="showTestimonials" name="show_testimonials" value="1" @checked(old('show_testimonials', $homePage->show_testimonials))>
                                        <label class="form-check-label" for="showTestimonials">Show Testimonials</label>
                                    </div>
                                </div> --}}
                            </div>
                            
                            {{-- Social Media & Footer Section --}}
                            <div class="tab-pane fade" id="social-section" role="tabpanel" aria-labelledby="social-tab">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Facebook URL</label>
                                    <input type="url" name="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $homePage->facebook) }}" placeholder="e.g., https://facebook.com/mycompany">
                                    @error('facebook')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Twitter URL</label>
                                    <input type="url" name="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ old('twitter', $homePage->twitter) }}" placeholder="e.g., https://twitter.com/mycompany">
                                    @error('twitter')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Instagram URL</label>
                                    <input type="url" name="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram', $homePage->instagram) }}" placeholder="e.g., https://instagram.com/mycompany">
                                    @error('instagram')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">LinkedIn URL</label>
                                    <input type="url" name="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin', $homePage->linkedin) }}" placeholder="e.g., https://linkedin.com/company/mycompany">
                                    @error('linkedin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">YouTube URL</label>
                                    <input type="url" name="youtube" class="form-control @error('youtube') is-invalid @enderror" value="{{ old('youtube', $homePage->youtube) }}" placeholder="e.g., https://youtube.com/mycompany">
                                    @error('youtube')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Footer Text</label>
                                    <textarea name="footer_text" class="form-control @error('footer_text') is-invalid @enderror" rows="3" placeholder="Enter copyright information or a short footer message.">{{ old('footer_text', $homePage->footer_text) }}</textarea>
                                    @error('footer_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-4">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                                <i class='bx bx-arrow-back me-1'></i>Back to Dashboard
                            </a>
                            <div class="d-flex">
                                <button type="reset" class="btn btn-outline-warning me-2">
                                    <i class='bx bx-reset me-1'></i>Reset
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class='bx bx-save me-1'></i>Update Settings
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .card {
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .form-label {
            margin-bottom: 8px;
            color: #495057;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e0e6ed;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
            transform: translateY(-1px);
        }
        .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .nav-pills .nav-link {
            border-radius: 8px;
            margin-right: 10px;
            color: #495057;
            background-color: #f8f9fa;
        }
        .nav-pills .nav-link.active {
            color: #fff;
            background-color: #0d6efd;
        }
        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
@endsection

@section('scripts')
    {{-- You can include a rich text editor like CKEditor here if needed, e.g., for the long_about_description --}}
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Optional: Initialize rich text editor if the script is included
             ClassicEditor
                 .create(document.querySelector('#long_about_description'))
                 .catch(error => {
                     console.error(error);
                 });
        });
    </script>
@endsection