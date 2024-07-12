<?php

namespace App\Http\Controllers\Frontend;

use App\Models\ProfileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileImageController extends Controller
{
    public function crop(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $user = Auth::user();
            $profile = $user->profile;

            if (!$profile) {
                Log::error('Profile not found for user ID: ' . $user->id);
                return response()->json(['status' => 0, 'msg' => 'Profile not found']);
            }

            $dest = 'profile/'; // Where profile image will be stored
            $file = $request->file('profile_image');
            $newImageFileName = 'UIMG' . date('YmdHis') . uniqid() . '.jpg';

            // Remove old image if it exists
            $oldProfileImage = $profile->profileImage;
            if ($oldProfileImage) {
                $oldImagePath = public_path($oldProfileImage->profile_image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                    Log::info('Old image deleted: ' . $oldImagePath);
                } else {
                    Log::warning('Old image not found at path: ' . $oldImagePath);
                }
            }

            // Upload File
            $filePath = public_path($dest) . $newImageFileName;
            $move = $file->move(public_path($dest), $newImageFileName);

            if (!$move) {
                Log::error('Failed to move uploaded file for user ID: ' . $user->id);
                return response()->json(['status' => 0, 'msg' => 'Failed to upload image']);
            }

            // Save the new image path to the profile image table
            if (!$oldProfileImage) {
                $oldProfileImage = new ProfileImage();
                $oldProfileImage->profile_id = $profile->id;
            }
            $oldProfileImage->profile_image = $dest . $newImageFileName;
            $oldProfileImage->save();

            return response()->json(['status' => 1, 'msg' => 'Image uploaded successfully!', 'file' => $newImageFileName]);

        } catch (\Exception $e) {
            Log::error('Error processing image upload for user ID: ' . Auth::id() . ' - ' . $e->getMessage());
            return response()->json(['status' => 0, 'msg' => 'Something went wrong: ' . $e->getMessage()]);
        }
    }
}
