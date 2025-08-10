<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::view('about-us', 'users.about')->name('about');
Route::view('videos', 'users.videos')->name('videos');
Route::view('branding', 'users.branding')->name('branding');
Route::view('contact-us', 'users.contact')->name('contact');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(PageController::class)->group(function(){
    Route::get('{slug}', 'products')->name('products');
    Route::post('contact-store', 'ContactStore')->name('ContactStore');
    Route::get('blogs/list', 'blogs')->name('ourBlogs');
    Route::get('blogs/{blog}', 'blogsDetails')->name('blogsDetails');
});

require __DIR__.'/auth.php';

Route::namespace('App\Http\Controllers\Admin')->middleware(['auth','admin'])->prefix('admin')->name('admin.')
    ->group(function() {

    Route::controller(ProductImageController::class)->group(function() {
        Route::post('/admin/products/{product}/upload-single-image', 'storeSingle')->name('products.images.store');
        Route::delete('/admin/products/{product}/images/{image}', 'destroy')->name('products.images.destroy');
    });

    Route::controller(HomePageController::class)->prefix('homepage')->name('homepage.')->group(function(){
        Route::get('edit', 'edit')->name('edit');
        Route::put('update', 'update')->name('update');
    });

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('users', UserController::class);
    Route::resource('enquiries', EnquiryController::class);
    Route::resource('blogs', BlogsController::class);
});
