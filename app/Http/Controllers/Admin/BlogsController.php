<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Traits\DTrait;

class BlogsController extends Controller
{
    use DTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Start a query on the Blog model
        $query = Blog::latest();

        // Add search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%");
        }

        if($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        // Paginate the results
        $blogs = $query->paginate(10);

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pass a new, empty Blog model instance to the view
        $blog = new Blog();
        return view('admin.blogs.create', compact('blog'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:blogs,name',
            'title' => 'required|string|max:100',
            'keywords' => 'required|string|max:155',
            'description' => 'nullable|string|max:155',
            'short_description' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tag' => 'nullable|string',
            'video_url' => 'nullable|url',
            'status' => 'required|string|in:Active,Inactive',
            'published_at' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            $input = $request->except(['_token', 'image']);
            $input['auth_id'] = auth()->id();
            $input['created_by'] = auth()->user()->name;
            $input['url_key'] = Str::slug($request->name);

            if ($request->hasFile('image')) {
                $path = $this->image($request->file('image'), 'blogs', 1200, 630);
                $input['image'] = $path;
            }

            Blog::create($input);

            DB::commit();
            return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create blog: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.create', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:blogs,name,' . $id,
            'title' => 'required|string|max:100',
            'keywords' => 'required|string|max:155',
            'description' => 'nullable|string|max:155',
            'short_description' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tag' => 'nullable|string',
            'video_url' => 'nullable|url',
            'status' => 'required|string|in:Active,Inactive',
            'published_at' => 'required|date',
        ]);

        $blog = Blog::findOrFail($id);

        DB::beginTransaction();

        try {
            $input = $request->except(['_token', 'image', '_method']);
            $input['url_key'] = Str::slug($request->name);

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($blog->image) {
                    Storage::disk('public')->delete($blog->image);
                }
                $path = $this->image($request->file('image'), 'blogs', 1200, 630);
                $input['image'] = $path;
            }

            $blog->update($input);

            DB::commit();
            return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update blog: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);

        DB::beginTransaction();

        try {
            // Delete image if it exists
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            $blog->delete();

            DB::commit();
            return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete blog: ' . $e->getMessage());
        }
    }
}