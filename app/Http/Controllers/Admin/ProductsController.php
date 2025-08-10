<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Traits\DTrait;

class ProductsController extends Controller
{
    use DTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $categories = Category::all();
        $query = Product::with('category');

        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where('name', 'like', $searchTerm)
                  ->orWhere('slug', 'like', $searchTerm)
                  ->orWhere('code', 'like', $searchTerm);
        }

        if($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $products = $query->latest()->paginate(20);

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $product = new Product();
        $categories = Category::all();

        return view('admin.products.create', [
            'product' => $product,
            'categories' => $categories,
            'action' => 'store',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'category_id' => 'required|numeric|exists:categories,id',
            'name' => 'required|string|max:255|unique:products,name',
            'code' => 'nullable|string|max:255|unique:products,code',
            'keyword' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'mrp'  => ['required','numeric','gte:selling'],
            'selling'  => ['required','numeric','lte:mrp'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string|in:Active,Inactive',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $slug = Str::slug($validatedData['name']);
            $count = 2;
            while (Product::where('slug', $slug)->exists()) {
                $slug = Str::slug($validatedData['name']) . '-' . $count;
                $count++;
            }
            $validatedData['slug'] = $slug;
            $validatedData['code'] = empty($validatedData['code']) ? 'FRN'.mt_rand(00000,99999) : $validatedData['code'];

            if ($request->hasFile('image')) {
                $path = $this->image($request->file('image'), 'products', 800, 800);
                $validatedData['image'] = $path;
            }

            Product::create($validatedData);
            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            return redirect()->back()->withInput()->with('error', 'Failed to create product. Please try again.');
        }
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();

        return view('admin.products.create', [
            'product' => $product,
            'categories' => $categories,
            'action' => 'update',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validatedData = $request->validate([
            'category_id' => 'required|numeric|exists:categories,id',
            'name' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'code' => ['nullable', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'keyword' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'mrp'  => ['required','numeric','gte:selling'],
            'selling'  => ['required','numeric','lte:mrp'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string|in:Active,Inactive',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $slug = Str::slug($validatedData['name']);
            $count = 2;
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = Str::slug($validatedData['name']) . '-' . $count;
                $count++;
            }
            $validatedData['slug'] = $slug;
            $validatedData['code'] = empty($validatedData['code']) ? 'FRN'.mt_rand(00000,99999) : $validatedData['code'];

            if ($request->hasFile('image')) {
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($oldImagePath);
                }

                $path = $this->image($request->file('image'), 'products', 800, 800);
                $validatedData['image'] = $path;

            }

            $product->update($validatedData);
            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Failed to update product. Please try again.'. $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        DB::beginTransaction();
        try {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $product->delete();
            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete product. Please try again.');
        }
    }
}