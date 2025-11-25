<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use App\Models\LandingPageImage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $landingPages = LandingPage::latest('id')->paginate(50);
        return view('backend.pages.landingpage.landingpage', compact('landingPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::get();
        return view('backend.pages.landingpage.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'main_heading' => 'nullable|string|max:500',
            'main_description' => 'nullable|string',
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv,flv|max:27648', // 27MB limit
            // 'main_call_to_action_text' => 'nullable|string|max:255',
            // 'main_call_to_action_url' => 'nullable|url',
            'benefits_title' => 'nullable|string|max:500',
            'benefits_list' => 'nullable|array',
            'benefits_list.*' => 'string|max:500',
            'why_buy_title' => 'nullable|string|max:500',
            'why_buy_images' => 'nullable',
            'why_buy_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'why_buy_description' => 'nullable|string',
            // 'why_buy_call_to_action_text' => 'nullable|string|max:255',
            // 'why_buy_call_to_action_url' => 'nullable|url',
            'usage_title' => 'nullable|string|max:500',
            'usage_instructions' => 'nullable|string',
            // 'usage_call_to_action_text' => 'nullable|string|max:255',
            // 'usage_call_to_action_url' => 'nullable|url',
            'certificate_title' => 'nullable|string|max:500',
            'certificate_subtitle' => 'nullable|string|max:500',
            'certificate_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'cta_banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'cta_banner_text' => 'nullable|string|max:500',
            'cta_banner_phone' => 'nullable|string|max:50',
            // 'cta_banner_call_to_action_text' => 'nullable|string|max:255',
            // 'cta_banner_call_to_action_url' => 'nullable|url',
            'footer_text' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'section_visibility' => 'nullable|array',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        $landingPageData = [
            'main_heading' => $request->main_heading,
            'main_description' => $request->main_description,
            // 'main_call_to_action_text' => $request->main_call_to_action_text,
            // 'main_call_to_action_url' => $request->main_call_to_action_url,
            'benefits_title' => $request->benefits_title,
            'benefits_list' => $request->benefits_list,
            'why_buy_title' => $request->why_buy_title,
            'why_buy_description' => $request->why_buy_description,
            // 'why_buy_call_to_action_text' => $request->why_buy_call_to_action_text,
            // 'why_buy_call_to_action_url' => $request->why_buy_call_to_action_url,
            'usage_title' => $request->usage_title,
            'usage_instructions' => $request->usage_instructions,
            // 'usage_call_to_action_text' => $request->usage_call_to_action_text,
            // 'usage_call_to_action_url' => $request->usage_call_to_action_url,
            'certificate_title' => $request->certificate_title,
            'certificate_subtitle' => $request->certificate_subtitle,
            'cta_banner_text' => $request->cta_banner_text,
            'cta_banner_phone' => $request->cta_banner_phone,
            // 'cta_banner_call_to_action_text' => $request->cta_banner_call_to_action_text,
            // 'cta_banner_call_to_action_url' => $request->cta_banner_call_to_action_url,
            'footer_text' => $request->footer_text,
            'is_active' => $request->is_active ?? false,
            'section_visibility' => $request->section_visibility,
        ];

        $landingPage = LandingPage::create($landingPageData);

        // Handle file uploads
        if ($request->hasFile('video')) {
            $this->video_upload($request, $landingPage->id);
        }
        if ($request->hasFile('certificate_image')) {
            $this->certificate_image_upload($request, $landingPage->id);
        }
        if ($request->hasFile('cta_banner_image')) {
            $this->cta_banner_image_upload($request, $landingPage->id);
        }
        if ($request->hasFile('why_buy_images')) {
            $this->why_buy_images_upload($request, $landingPage->id);
        }

        // Sync products to the landing page
        if ($request->has('product_ids')) {
            $landingPage->products()->sync($request->product_ids);
        }

        return redirect()->route('landingpages.index')->with('message', 'Landing Page Created Successfully 🙂');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $landingPage = LandingPage::with('products')->findOrFail($id);
        return view('backend.pages.landingpage.show', compact('landingPage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $landingPage = LandingPage::with('products')->findOrFail($id);
        $products = Product::where('is_active', 1)->get();
        $selectedProductIds = $landingPage->products->pluck('id')->toArray();

        return view('backend.pages.landingpage.edit', compact('landingPage', 'products', 'selectedProductIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'main_heading' => 'nullable|string|max:500',
            'main_description' => 'nullable|string',
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv,flv|max:27648', // 27MB limit
            // 'main_call_to_action_text' => 'nullable|string|max:255',
            // 'main_call_to_action_url' => 'nullable|url',
            'benefits_title' => 'nullable|string|max:500',
            'benefits_list' => 'nullable|array',
            'benefits_list.*' => 'string|max:500',
            'why_buy_title' => 'nullable|string|max:500',
            'why_buy_images' => 'nullable',
            'why_buy_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'why_buy_description' => 'nullable|string',
            // 'why_buy_call_to_action_text' => 'nullable|string|max:255',
            // 'why_buy_call_to_action_url' => 'nullable|url',
            'usage_title' => 'nullable|string|max:500',
            'usage_instructions' => 'nullable|string',
            // 'usage_call_to_action_text' => 'nullable|string|max:255',
            // 'usage_call_to_action_url' => 'nullable|url',
            'certificate_title' => 'nullable|string|max:500',
            'certificate_subtitle' => 'nullable|string|max:500',
            'certificate_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'cta_banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'cta_banner_text' => 'nullable|string|max:500',
            'cta_banner_phone' => 'nullable|string|max:50',
            // 'cta_banner_call_to_action_text' => 'nullable|string|max:255',
            // 'cta_banner_call_to_action_url' => 'nullable|url',
            'footer_text' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'section_visibility' => 'nullable|array',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        $landingPage = LandingPage::findOrFail($id);

        $landingPageData = [
            'main_heading' => $request->main_heading,
            'main_description' => $request->main_description,
            // 'main_call_to_action_text' => $request->main_call_to_action_text,
            // 'main_call_to_action_url' => $request->main_call_to_action_url,
            'benefits_title' => $request->benefits_title,
            'benefits_list' => $request->benefits_list,
            'why_buy_title' => $request->why_buy_title,
            'why_buy_description' => $request->why_buy_description,
            // 'why_buy_call_to_action_text' => $request->why_buy_call_to_action_text,
            // 'why_buy_call_to_action_url' => $request->why_buy_call_to_action_url,
            'usage_title' => $request->usage_title,
            'usage_instructions' => $request->usage_instructions,
            // 'usage_call_to_action_text' => $request->usage_call_to_action_text,
            // 'usage_call_to_action_url' => $request->usage_call_to_action_url,
            'certificate_title' => $request->certificate_title,
            'certificate_subtitle' => $request->certificate_subtitle,
            'cta_banner_text' => $request->cta_banner_text,
            'cta_banner_phone' => $request->cta_banner_phone,
            // 'cta_banner_call_to_action_text' => $request->cta_banner_call_to_action_text,
            // 'cta_banner_call_to_action_url' => $request->cta_banner_call_to_action_url,
            'footer_text' => $request->footer_text,
            'is_active' => $request->is_active ?? false,
            'section_visibility' => $request->section_visibility,
        ];

        $landingPage->update($landingPageData);

        // Handle file uploads
        if ($request->hasFile('video')) {
            $this->video_upload($request, $landingPage->id);
        }
        if ($request->hasFile('certificate_image')) {
            $this->certificate_image_upload($request, $landingPage->id);
        }
        if ($request->hasFile('cta_banner_image')) {
            $this->cta_banner_image_upload($request, $landingPage->id);
        }
        if ($request->hasFile('why_buy_images')) {
            $this->why_buy_images_upload($request, $landingPage->id);
        }

        // Sync products to the landing page
        if ($request->has('product_ids')) {
            $landingPage->products()->sync($request->product_ids);
        } else {
            $landingPage->products()->detach();
        }

        return redirect()->route('landingpages.index')->with('message', 'Landing Page Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $landingPage = LandingPage::with('landingPageImages')->findOrFail($id);

        // Delete associated files before deleting the record
        $this->deleteAssociatedFiles($landingPage);

        $landingPage->delete();

        return redirect()->route('landingpages.index')->with('message', 'Landing Page Deleted Successfully 🙂');
    }

    /**
     * Delete all associated files for a landing page.
     */
    protected function deleteAssociatedFiles($landingPage)
    {
        // Delete main video if exists
        if ($landingPage->video_url) {
            $videoPath = public_path('uploads/landingpages/' . $landingPage->video_url);
            if (file_exists($videoPath)) {
                unlink($videoPath);
            }
        }

        // Delete certificate image if exists
        if ($landingPage->certificate_image) {
            $imagePath = public_path('uploads/landingpages/' . $landingPage->certificate_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete CTA banner image if exists
        if ($landingPage->cta_banner_image) {
            $imagePath = public_path('uploads/landingpages/' . $landingPage->cta_banner_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete all related images from the landing_page_images table
        foreach ($landingPage->landingPageImages as $image) {
            $imagePath = public_path('uploads/landingpages/' . $image->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image->delete(); // Delete the database record
        }
    }

    /**
     * Delete a single landing page image.
     */
    public function deleteLandingPageImage($id)
    {
        $landingPageImage = LandingPageImage::findOrFail($id);

        // Delete the image file from the public directory if it exists
        $imagePath = public_path('uploads/landingpages/' . $landingPageImage->image_path);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete the record from the database
        $landingPageImage->delete();

        return response()->json(['success' => 'Image deleted successfully.']);
    }

    /**
     * Delete the video file.
     */
    public function deleteLandingPageVideo($id)
    {
        $landingPage = LandingPage::findOrFail($id);

        // Delete the video file from the public directory if it exists
        if ($landingPage->video_url) {
            $videoPath = public_path('uploads/landingpages/' . $landingPage->video_url);
            if (file_exists($videoPath)) {
                unlink($videoPath);
            }

            // Update the database to remove the video reference
            $landingPage->update([
                'video_url' => null,
            ]);

            return response()->json(['success' => 'Video deleted successfully.']);
        }

        return response()->json(['error' => 'No video found.'], 404);
    }

    /**
     * Delete a single image field (like certificate_image or cta_banner_image).
     */
    public function deleteLandingPageSingleImage(Request $request, $id)
    {
        $request->validate([
            'field' => 'required|in:certificate_image,cta_banner_image'
        ]);

        $landingPage = LandingPage::findOrFail($id);
        $field = $request->field;

        // Delete the image file from the public directory if it exists
        if ($landingPage->$field) {
            $imagePath = public_path('uploads/landingpages/' . $landingPage->$field);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Update the database to remove the image reference
            $landingPage->update([
                $field => null,
            ]);

            return response()->json(['success' => 'Image deleted successfully.']);
        }

        return response()->json(['error' => 'No image found.'], 404);
    }

    /**
     * Store/Update the video file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $landingPage_id
     * @return void
     */
    protected function video_upload($request, $landingPage_id)
    {
        $landingPage = LandingPage::findOrFail($landingPage_id);

        if ($request->hasFile('video')) {
            // Delete old video if exists
            if ($landingPage->video_url) {
                $video_location = public_path('uploads/landingpages/' . $landingPage->video_url);
                if (file_exists($video_location)) {
                    unlink($video_location);
                }
            }

            $video_location = public_path('uploads/landingpages/');
            $uploaded_video = $request->file('video');
            $new_video_name = $landingPage->id . '_video.' . $uploaded_video->getClientOriginalExtension();

            // Create directory if it doesn't exist
            if (!file_exists($video_location)) {
                mkdir($video_location, 0755, true);
            }

            // Move the uploaded video to the landingpages directory
            $uploaded_video->move($video_location, $new_video_name);

            $landingPage->update([
                'video_url' => $new_video_name,
            ]);
        }
    }

    /**
     * Store/Update the certificate image file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $landingPage_id
     * @return void
     */
    protected function certificate_image_upload($request, $landingPage_id)
    {
        $landingPage = LandingPage::findOrFail($landingPage_id);

        if ($request->hasFile('certificate_image')) {
            if ($landingPage->certificate_image && $landingPage->certificate_image != 'default_certificate.jpg') {
                // Delete old photo
                $photo_location = public_path('uploads/landingpages/' . $landingPage->certificate_image);
                if (file_exists($photo_location)) {
                    unlink($photo_location);
                }
            }

            $photo_location = public_path('uploads/landingpages/');
            $uploaded_photo = $request->file('certificate_image');
            $new_photo_name = $landingPage->id . '_certificate.' . $uploaded_photo->getClientOriginalExtension();

            // Create directory if it doesn't exist
            if (!file_exists($photo_location)) {
                mkdir($photo_location, 0755, true);
            }

            $new_photo_location = $photo_location . $new_photo_name;

            // Handle WebP format properly
            if ($uploaded_photo->getClientOriginalExtension() == 'webp') {
                Image::make($uploaded_photo)->resize(800, 600)->save($new_photo_location);
            } else {
                Image::make($uploaded_photo)->resize(800, 600)->save($new_photo_location, 80);
            }

            $landingPage->update([
                'certificate_image' => $new_photo_name,
            ]);
        }
    }

    /**
     * Store/Update the CTA banner image file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $landingPage_id
     * @return void
     */
    protected function cta_banner_image_upload($request, $landingPage_id)
    {
        $landingPage = LandingPage::findOrFail($landingPage_id);

        if ($request->hasFile('cta_banner_image')) {
            if ($landingPage->cta_banner_image && $landingPage->cta_banner_image != 'default_cta_banner.jpg') {
                // Delete old photo
                $photo_location = public_path('uploads/landingpages/' . $landingPage->cta_banner_image);
                if (file_exists($photo_location)) {
                    unlink($photo_location);
                }
            }

            $photo_location = public_path('uploads/landingpages/');
            $uploaded_photo = $request->file('cta_banner_image');
            $new_photo_name = $landingPage->id . '_cta_banner.' . $uploaded_photo->getClientOriginalExtension();

            // Create directory if it doesn't exist
            if (!file_exists($photo_location)) {
                mkdir($photo_location, 0755, true);
            }

            $new_photo_location = $photo_location . $new_photo_name;

            // Handle WebP format properly
            if ($uploaded_photo->getClientOriginalExtension() == 'webp') {
                Image::make($uploaded_photo)->resize(1200, 400)->save($new_photo_location);
            } else {
                Image::make($uploaded_photo)->resize(1200, 400)->save($new_photo_location, 80);
            }

            $landingPage->update([
                'cta_banner_image' => $new_photo_name,
            ]);
        }
    }

    /**
     * Store multiple images for the Why Buy section.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $landingPage_id
     * @return void
     */
    protected function why_buy_images_upload($request, $landingPage_id)
    {
        $landingPage = LandingPage::findOrFail($landingPage_id);

        if ($request->hasFile('why_buy_images')) {
            // Delete old why_buy_images from database and files
            $oldImages = $landingPage->whyBuyImages; // Use the relationship method
            foreach ($oldImages as $oldImage) {
                $imagePath = public_path('uploads/landingpages/' . $oldImage->image_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $oldImage->delete(); // Delete the record from database
            }

            // Upload and save new images
            foreach ($request->file('why_buy_images') as $index => $uploaded_photo) {
                if ($uploaded_photo->isValid()) {
                    // Handle each multiple image upload
                    $photo_location = public_path('uploads/landingpages/');
                    $new_photo_name = $landingPage->id . '_whybuy_' . time() . '_' . uniqid() . '.' . $uploaded_photo->getClientOriginalExtension();

                    // Create directory if it doesn't exist
                    if (!file_exists($photo_location)) {
                        mkdir($photo_location, 0755, true);
                    }

                    $new_photo_location = $photo_location . $new_photo_name;

                    // Resize and save the image
                    // Handle WebP format properly
                    if ($uploaded_photo->getClientOriginalExtension() == 'webp') {
                        Image::make($uploaded_photo)->resize(800, 600)->save($new_photo_location);
                    } else {
                        Image::make($uploaded_photo)->resize(800, 600)->save($new_photo_location, 80);
                    }

                    // Save image record to the new landing_page_images table
                    $landingPage->landingPageImages()->create([
                        'image_path' => $new_photo_name,
                        'section_type' => 'why_buy',
                        'order' => $index, // Store the order of the image
                    ]);
                }
            }
        }
    }
}
