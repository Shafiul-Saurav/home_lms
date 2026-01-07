<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Profile;
use App\Models\ProfileImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfilePasswordChangeRequest;

class ProfileController extends Controller
{
    public function userDashboard()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        if($profile) {
            $profileImage = ProfileImage::where('profile_id', Auth::user()->profile->id)->first();
            return view('frontend.pages.account.dashboard', compact('user', 'profile', 'profileImage'));
        } else {
            return view('frontend.pages.account.dashboard', compact('user', 'profile'));
        }
    }
    public function myProfile()
    {
        return view('frontend.pages.account.myprofile');
    }

    public function generalStore(Request $request)
    {
        $user = User::find($request->id);
        $user->update([
            'phone' => $request->phone
        ]);

        return redirect()->back()->with('message', 'Phone Added Successfully 🙂');
    }
    public function profileStore(Request $request)
    {
        $profileData = $request->all();
        $profileData['user_id'] = Auth::id();

        $existingProfile = Profile::where('user_id', Auth::id())->first();

        if ($existingProfile) {
            $existingProfile->update($profileData);
        } else {
            Profile::create([
                'user_id' => Auth::id(),
                'nid_num' => $request->nid_num,
                'address' => $request->address,
                'gender' => $request->gender,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedIn' => $request->linkedIn,
                'Instagram' => $request->Instagram,
            ]);
        }

        return redirect()->back()->with('message', 'Profile Updated Successfully 🙂');
    }

    public function updatePassword(ProfilePasswordChangeRequest $request)
    {
        // dd($request->all());
        // Get the currently authenticated user
        $user = Auth::user();
        $hashedPassword = $user->password;

        // Check if the old password matches the current password
        if (Hash::check($request->old_password, $hashedPassword)) {

            // Check if the new password is not the same as the old password
            if (!Hash::check($request->password, $hashedPassword)) {

                // Check if the new password matches the confirmation
                if ($request->password === $request->password_confirmation) {
                    // Update the user's password
                    $user->update([
                        'password' => Hash::make($request->password),
                    ]);

                    // Logout the user after password change for security reasons
                    Auth::logout();

                    // Redirect to login page with a success message
                    return redirect()->route('login')->with('message', 'Password Updated Successfully');
                } else {
                    // Redirect back with an error message if the new password confirmation does not match
                    return redirect()->back()->with('error', 'The new password confirmation does not match');
                }
            } else {
                // Redirect back with an error message if the new password matches the old password
                return redirect()->back()->with('error', 'New Password cannot be the same as old password');
            }
        } else {
            // Redirect back with an error message if the old password does not match
            return redirect()->back()->with('error', "Current password does not match our records");
        }
    }
}
