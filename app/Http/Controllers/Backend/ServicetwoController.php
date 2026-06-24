<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Servicetwo;
use App\Models\Servicetwocategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class ServicetwoController extends Controller
{
    public function index()
    {
        // Gate::authorize('index-servicetwo');

        $servicetwos = Servicetwo::latest('id')->paginate(100);
        $categories = Servicetwocategory::latest('id')->get();

        return view('backend.pages.servicetwos.servicetwos', compact('servicetwos', 'categories'));
    }

    public function store(Request $request)
    {
        // Gate::authorize('create-servicetwo');

        $request->validate([
            'servicetwocategory_id' => 'required|exists:servicetwocategories,id',
            'title' => 'required|string|max:255',
            'service_icon' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'description' => 'required|string',
            'service_type' => 'required|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
        ]);

        $service = Servicetwo::create([
            'servicetwocategory_id' => $request->servicetwocategory_id,
            'title' => $request->title,
            'description' => $request->description,
            'service_type' => $request->service_type,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'image' => 'default_service.jpg',
            'service_icon' => null,
        ]);

        $this->imageUpload($request, $service->id);
        $this->iconUpload($request, $service->id);

        return redirect()->back()->with('message', 'Service Two Created Successfully 🙂');
    }

    public function destroy(string $id)
    {
        // Gate::authorize('delete-servicetwo');

        $service = Servicetwo::findOrFail($id);
        if ($service->image && $service->image !== 'default_service.jpg') {
            $imagePath = public_path('uploads/servicetwos/' . $service->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        if ($service->service_icon) {
            $iconPath = public_path('uploads/servicetwos/' . $service->service_icon);
            if (file_exists($iconPath)) {
                unlink($iconPath);
            }
        }
        $service->delete();

        return redirect()->back()->with('warning', 'Service Two Deleted Successfully');
    }

    public function edit(string $id)
    {
        // Gate::authorize('edit-servicetwo');

        $service = Servicetwo::findOrFail($id);
        $categories = Servicetwocategory::latest('id')->get();

        return view('backend.pages.servicetwos.edit', compact('service', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        // Gate::authorize('edit-servicetwo');

        $service = Servicetwo::findOrFail($id);

        $request->validate([
            'servicetwocategory_id' => 'required|exists:servicetwocategories,id',
            'title' => 'required|string|max:255',
            'service_icon' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'description' => 'required|string',
            'service_type' => 'required|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
        ]);

        $service->update([
            'servicetwocategory_id' => $request->servicetwocategory_id,
            'title' => $request->title,
            'description' => $request->description,
            'service_type' => $request->service_type,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        $this->imageUpload($request, $service->id);
        $this->iconUpload($request, $service->id);

        return redirect()->route('servicetwos.index')->with('message', 'Service Two Updated Successfully 🙂');
    }

    public function imageUpload(Request $request, int $serviceId): void
    {
        $service = Servicetwo::findOrFail($serviceId);

        if ($request->hasFile('image')) {
            if ($service->image && $service->image !== 'default_service.jpg') {
                $oldImagePath = public_path('uploads/servicetwos/' . $service->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageLocation = public_path('uploads/servicetwos/');
            $uploadedImage = $request->file('image');
            $newImageName = $service->id . '.' . $uploadedImage->getClientOriginalExtension();

            if (!file_exists($imageLocation)) {
                mkdir($imageLocation, 0755, true);
            }

            $newImageLocation = $imageLocation . $newImageName;

            $ext = strtolower($uploadedImage->getClientOriginalExtension());
            if ($ext === 'avif') {
                $uploadedImage->move($imageLocation, $newImageName);
            } elseif ($ext === 'webp') {
                Image::make($uploadedImage)->resize(600, 450)->save($newImageLocation);
            } else {
                Image::make($uploadedImage)->resize(600, 450)->save($newImageLocation, 80);
            }

            $service->update([
                'image' => $newImageName,
            ]);
        }
    }

    public function iconUpload(Request $request, int $serviceId): void
    {
        $service = Servicetwo::findOrFail($serviceId);

        if ($request->hasFile('service_icon')) {
            if ($service->service_icon) {
                $oldIconPath = public_path('uploads/servicetwos/' . $service->service_icon);
                if (file_exists($oldIconPath)) {
                    unlink($oldIconPath);
                }
            }

            $imageLocation = public_path('uploads/servicetwos/');
            $uploadedIcon = $request->file('service_icon');
            $newIconName = $service->id . '_icon.' . $uploadedIcon->getClientOriginalExtension();

            if (!file_exists($imageLocation)) {
                mkdir($imageLocation, 0755, true);
            }

            $newIconLocation = $imageLocation . $newIconName;

            $ext = strtolower($uploadedIcon->getClientOriginalExtension());
            if ($ext === 'svg' || $ext === 'avif') {
                $uploadedIcon->move($imageLocation, $newIconName);
            } elseif ($ext === 'webp') {
                Image::make($uploadedIcon)->resize(100, 100)->save($newIconLocation);
            } else {
                Image::make($uploadedIcon)->resize(100, 100)->save($newIconLocation, 80);
            }

            $service->update([
                'service_icon' => $newIconName,
            ]);
        }
    }

    public function checkActive($service_id)
    {
        // Gate::authorize('edit-servicetwo');

        $service = Servicetwo::find($service_id);
        if (! $service) {
            return response()->json([
                'type' => 'error',
                'message' => 'Service not found',
            ], 404);
        }

        $service->is_active = $service->is_active ? 0 : 1;
        $service->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated',
        ]);
    }
}
