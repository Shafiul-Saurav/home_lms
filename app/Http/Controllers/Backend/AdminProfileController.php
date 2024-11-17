<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminProfileController extends Controller
{
    public function adminProfile()
    {
        return view('backend.pages.admin_profile.admin_profile');
    }

    public function adminProfileStore(Request $request)
    {
        // dd($request->all());

         // Validate the request
        //  $request->validate([
        //     'profile_photo_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        // ]);

        // Get the currently authenticated user
        $user = auth()->user();

        if ($request->hasFile('profile_photo_path')) {
            // Delete old profile photo if it exists
            if ($user->profile_photo_path && File::exists(public_path($user->profile_photo_path))) {
                File::delete(public_path($user->profile_photo_path));
            }

            // Define the path and move the file
            $fileName = uniqid() . '.' . $request->profile_photo_path->extension();
            $filePath = 'uploads/admin_profiles/' . $fileName;
            $request->profile_photo_path->move(public_path('uploads/admin_profiles'), $fileName);

            // Update user profile photo path
            $user->profile_photo_path = $filePath;
        }

        // Save the user's updated information
        $user->save();

        // Redirect back with a success message
        return redirect()->route('admin.profile')->with('message', 'Profile updated successfully!');

    }
}
