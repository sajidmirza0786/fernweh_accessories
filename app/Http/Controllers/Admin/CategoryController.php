<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Traits\DTrait;

class CategoryController extends Controller
{
    use DTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Category::with('parent');

        if ($request->filled('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';
            $query->where('name', 'like', $searchTerm)
                  ->orWhere('slug', 'like', $searchTerm)
                  ->orWhere('keyword', 'like', $searchTerm);
        }

        if($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $categories = $query->latest()->paginate(30);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $parentCategories = Category::all();
        $category = new Category(); // Instantiate a new Category model

        // Pass the 'action' variable to the view
        return view('admin.categories.create', [
            'parentCategories' => $parentCategories,
            'category' => $category,
            'action' => 'store' // Set the action to 'store' for creating
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            //'parent_id' => 'nullable|numeric|exists:categories,id',
            'name' => 'required|string|max:255|unique:categories,name',
            //'slug' => 'required|string|max:255|unique:categories,slug',
            'keyword' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string|in:Active,Inactive',
        ]);

        DB::beginTransaction();

        try {
            $path = null;
            if ($request->hasFile('image')) {
                $path = $this->image($request->file('image'), 'categories', 800, 800);
                $validatedData['image'] = $path;
            }

            $validatedData['slug'] = Str::slug($request->input('name'));

            Category::create($validatedData);

            DB::commit();

            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return redirect()->back()->withInput()->with('error', 'Failed to create category. Please try again.'. $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        // Get all categories *except* the current one for parent selection
        $parentCategories = Category::where('id', '!=', $category->id)->get();

        return view('admin.categories.create', [
            'category' => $category,
            'parentCategories' => $parentCategories,
            'action' => 'update', // This tells the form it's for updating
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        if(!$category) {
            return redirect()->route('admin.categories.index')->with('error', 'Category not found!');
        }
        $validatedData = $request->validate([
            //'parent_id' => 'nullable|numeric|exists:categories,id',
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
            'keyword' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string|in:Active,Inactive',
        ]);

        DB::beginTransaction();

        try {

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($category->image) {
                    Storage::disk('public')->delete($category->image);
                }
                $path = $this->image($request->file('image'), 'categories', 800, 800);
                $validatedData['image'] = $path;
            }

            $validatedData['slug'] = Str::slug($request->input('name'));

            $category->update($validatedData);

            DB::commit();

            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($newImagePath)) {
                Storage::disk('public')->delete($newImagePath);
            }

            return redirect()->back()->withInput()->with('error', 'Failed to update category. Please try again.'. $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $imagePath = $category->image;

            $category->delete();

            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            DB::commit();

            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to delete category. Please try again.');
        }
    }
}