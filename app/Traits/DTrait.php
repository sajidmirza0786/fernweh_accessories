<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

trait DTrait
{
    /**
     * Upload and resize an image.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path Relative path inside storage/app/public/
     * @return string Stored file path
     */
    public function image($file, $path, $width, $height)
    {
        // Resize using Intervention
        $image = Image::read($file)->resize($width, $height);

        // Generate unique filename
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        // Store in the specified path on the public disk
        Storage::disk('public')->put(
            $path . '/' . $filename,
            $image->encodeByExtension($file->getClientOriginalExtension(), quality: 70)
        );

        // Return stored path (e.g., "uploads/bilty/abc123.jpg")
        return $path . '/' . $filename;
    }
}
