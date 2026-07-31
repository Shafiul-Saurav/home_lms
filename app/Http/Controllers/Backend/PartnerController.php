<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Gate;

class PartnerController extends Controller
{
    public function index()
    {
        // Gate::authorize('index-partner');
        $partners = Partner::latest('id')->paginate(50);
        return view('backend.pages.general.partner.index', compact('partners'));
    }

    public function create()
    {
        return view('backend.pages.general.partner.create');
    }

    public function store(Request $request)
    {
        // Gate::authorize('create-partner');
        $validated = $request->validate([
            'partner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $partner = Partner::create([
            'partner_image' => '',
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        $this->image_upload($request, $partner->id);
        return redirect()->back()->with('message', 'Partner Created Successfully 🙂');
    }

    public function edit(string $id)
    {
        // Gate::authorize('edit-partner');
        $partner = Partner::findOrFail($id);
        return view('backend.pages.general.partner.edit', compact('partner'));
    }

    public function update(Request $request, string $id)
    {
        // Gate::authorize('edit-partner');
        $partner = Partner::findOrFail($id);
        $partner->update([
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        $this->image_upload($request, $partner->id);
        return redirect()->route('partners.index')->with('message', 'Partner Updated Successfully 🙂');
    }

    public function destroy(string $id)
    {
        // Gate::authorize('delete-partner');
        $partner = Partner::findOrFail($id);
        if ($partner->partner_image && $partner->partner_image != 'default_partner.jpg') {
            $photo_location = 'uploads/partners/' . $partner->partner_image;
            if (file_exists(public_path($photo_location))) {
                unlink(public_path($photo_location));
            }
        }
        $partner->delete();
        return redirect()->back()->with('error', 'Partner Moved to Trash Successfully');
    }

    public function image_upload($request, $partner_id)
    {
        $partner = Partner::findOrFail($partner_id);

        if ($request->hasFile('partner_image')) {
            $photo_location = public_path('uploads/partners/');

            if ($partner->partner_image && $partner->partner_image != 'default_partner.jpg') {
                $old_photo_path = $photo_location . $partner->partner_image;
                if (file_exists($old_photo_path)) {
                    unlink($old_photo_path);
                }
            }

            if (!file_exists($photo_location)) {
                mkdir($photo_location, 0755, true);
            }

            $uploaded_photo = $request->file('partner_image');
            $extension = strtolower($uploaded_photo->getClientOriginalExtension());
            $new_photo_name = $partner->id . '.' . $extension;
            $new_photo_path = $photo_location . $new_photo_name;

            $img = Image::read($uploaded_photo)->resize(240, 90);

            if ($extension === 'webp') {
                $img->toWebp(80)->save($new_photo_path);
            } else {
                $img->toJpeg(80)->save($new_photo_path);
            }

            $partner->update(['partner_image' => $new_photo_name]);
        }
    }

    public function checkActive($id)
    {
        $partner = Partner::find($id);
        if (!$partner) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }
        $partner->is_active = $partner->is_active ? 0 : 1;
        $partner->save();
        return response()->json(['type' => 'success', 'message' => 'Status Updated']);
    }
}
