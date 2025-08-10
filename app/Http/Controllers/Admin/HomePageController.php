<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Traits\DTrait;

class HomePageController extends Controller
{
    use DTrait;

    /**
     * Show the edit form for homepage.
     */
    public function edit()
    {
        $homePage = HomePage::firstOrFail(); // Assuming only 1 row
        return view('admin.homepage.edit', compact('homePage'));
    }

    /**
     * Update homepage details.
     */
    public function update(Request $request)
    {
        $rules = [
            'title' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            'mobile' => 'nullable|string|max:20',
            'alt_mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alt_email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',

            'heading' => 'nullable|string|max:255',
            'short_about_description' => 'nullable|string|max:255',
            'long_about_description' => 'nullable|string',

            'banner_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'banner_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'banner_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',

            'other_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'other_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',

            'show_banners' => 'nullable|boolean',
            'show_about_section' => 'nullable|boolean',
            'show_testimonials' => 'nullable|boolean',

            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'youtube' => 'nullable|url',

            'footer_text' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Define allowed fields (except images)
        $fields = [
            'title', 'keywords', 'description', 'mobile', 'alt_mobile', 'email', 'alt_email',
            'address', 'heading', 'short_about_description', 'long_about_description',
            'show_banners', 'show_about_section', 'show_testimonials',
            'facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'footer_text'
        ];

        // Image fields with their width & height for resizing
        $imageFields = [
            'favicon' => ['width' => 64, 'height' => 64],
            'logo' => ['width' => 1200, 'height' => 300],
            'banner_image_1' => ['width' => 1920, 'height' => 900],
            'banner_image_2' => ['width' => 1920, 'height' => 900],
            'banner_image_3' => ['width' => 1920, 'height' => 900],
            'other_image_1' => ['width' => 800, 'height' => 800], //use for home page branding
            'other_image_2' => ['width' => 800, 'height' => 600],
        ];

        DB::beginTransaction();

        try {
            $homePage = HomePage::firstOrFail();

            // Prepare data array with only allowed fields
            $data = $request->only($fields);

            // Handle image uploads
            foreach ($imageFields as $field => $size) {
                if ($request->hasFile($field)) {
                    // Delete old image if exists
                    if ($homePage->$field && Storage::disk('public')->exists($homePage->$field)) {
                        Storage::disk('public')->delete($homePage->$field);
                    }
                    // Upload and resize image via your trait method
                    $data[$field] = $this->image($request->file($field), 'homepage', $size['width'], $size['height']);
                }
            }

            // Cast checkbox boolean fields because sometimes unchecked are missing in request
            $data['show_banners'] = $request->has('show_banners') ? (bool)$request->show_banners : false;
            $data['show_about_section'] = $request->has('show_about_section') ? (bool)$request->show_about_section : false;
            $data['show_testimonials'] = $request->has('show_testimonials') ? (bool)$request->show_testimonials : false;

            // Update the model
            $homePage->update($data);

            DB::commit();

            return redirect()->back()->with('success', 'Homepage updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }
}

