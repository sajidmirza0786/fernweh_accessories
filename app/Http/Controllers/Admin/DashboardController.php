<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Enquiry;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalBlogs = Blog::count();
        $totalEnquiries = Enquiry::count();

        $recentBlogs = Blog::latest()->take(5)->get();
        $recentEnquiries = Enquiry::latest()->take(5)->get();

        return view('dashboard', compact('totalProducts', 'totalCategories', 'totalBlogs', 'totalEnquiries', 'recentBlogs', 'recentEnquiries'));
    }
}