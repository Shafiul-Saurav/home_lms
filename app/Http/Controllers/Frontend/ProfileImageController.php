<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\ProfileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProfileImageController extends Controller
{
    public function crop(Request $request)
    {
        try {
            $request->validate([
                'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $user = Auth::user();
            $profile = Profile::firstOrCreate([
                'user_id' => $user->id,
            ]);

            $destination = public_path('profile');
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }

            $file = $request->file('profile_image');
            $newImageFileName = 'UIMG' . now()->format('YmdHis') . uniqid() . '.jpg';

            $existingProfileImage = $profile->profileImage;
            if ($existingProfileImage && $existingProfileImage->profile_image) {
                $oldImagePath = public_path($existingProfileImage->profile_image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $file->move($destination, $newImageFileName);

            $profileImage = $existingProfileImage ?? new ProfileImage();
            $profileImage->profile_id = $profile->id;
            $profileImage->profile_image = 'profile/' . $newImageFileName;
            $profileImage->save();

            return response()->json([
                'status' => 1,
                'msg' => 'Profile image updated successfully.',
                'path' => asset($profileImage->profile_image),
            ]);
        } catch (\Exception $e) {
            Log::error('Error processing profile image upload for user ID: ' . Auth::id() . ' - ' . $e->getMessage());

            return response()->json([
                'status' => 0,
                'msg' => 'Something went wrong while uploading the image.',
            ], 500);
        }
    }
}
