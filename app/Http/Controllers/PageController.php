<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PageController extends Controller
{
    public function blogs(Request $request)
    {
        try {
            $blogsQuery = Blog::where('status', 'Active');

            // Blog listing
            $blogs = $blogsQuery->latest()->get();

            return view('users.blogs', compact('blogs'));

        } catch (ModelNotFoundException $e) {
            // Blog not found
            return redirect()->route('blogs')->with('error', 'The blog you are looking for does not exist.');
        } catch (\Throwable $e) {
            // Generic fallback for unexpected errors
            return redirect()->route('blogs')->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function blogsDetails($blog)
    {
        try {
            $blog = Blog::where('status', 'Active')->where('url_key', $blog)->first();
            if(!$blog) {
                return redirect()->route('blogs')->with('error', 'The blog you are looking for does not exist.');
            }
            $blogs = Blog::where('status', 'Active')->latest()->get();
            return view('users.blog_detail', compact('blog', 'blogs'));
        } catch (\Throwable $e) {
            // Generic fallback for unexpected errors
            return redirect()->route('blogs')->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function products($slug = null)
    {
        try {
            // Validate slug input
            $slug = strip_tags($slug); // Prevents HTML injection
            $slug = trim($slug);       // Removes extra spaces

            // Fetch active categories for navigation
            $categories = Category::where('status', 'Active')->get();

            // Check if slug matches a category
            $category = Category::where('slug', $slug)
                ->where('status', 'Active')
                ->first();

            if ($category) {
                $products = Product::where('category_id', $category->id)
                    ->where('status', 'Active')
                    ->get();

                return view('users.listing', compact('categories', 'category', 'products'));
            }

            // If not category, check if it's a product
            $product = Product::where('slug', $slug)
                ->where('status', 'Active')
                ->first();

            if ($product) {
                $similarProducts = Product::where('category_id', $product->category_id)
                    ->where('status', 'Active')
                    ->where('id', '!=', $product->id)
                    ->inRandomOrder()
                    ->limit(9)
                    ->get();

                return view('users.product_detail', compact('product', 'similarProducts', 'categories'));
            }

            // If neither found, throw 404
            abort(404);

        } catch (\Exception $e) {
            // Log error for debugging
            \Log::error('Product retrieval failed', [
                'slug' => $slug,
                'error' => $e->getMessage()
            ]);

            // Show 500 error page
            abort(500, 'Something went wrong while loading the page.');
        }
    }

}
