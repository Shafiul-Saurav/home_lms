<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilePasswordChangeRequest;
use App\Models\Profile;
use App\Models\ProfileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function userDashboard()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', Auth::user()->id)->first();

        if ($profile) {
            $profileImage = ProfileImage::where('profile_id', Auth::user()->profile->id)->first();

            return view('frontend.pages.account.dashboard', compact('user', 'profile', 'profileImage'));
        }

        return view('frontend.pages.account.dashboard', compact('user', 'profile'));
    }

    public function generalSetting()
    {
        $user = Auth::user();

        return view('frontend.pages.account.generalsetting', compact('user'));
    }

    public function generalStore(Request $request)
    {
        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:20'],
        ], [
            'phone.required' => 'The phone field is required.',
            'phone.max' => 'The phone number may not be greater than 20 characters.',
        ]);

        $user = Auth::user();
        $user->update([
            'phone' => $validated['phone'],
        ]);

        return redirect()->back()->with('message', 'General settings updated successfully.');
    }

    public function personalSetting()
    {
        $user = Auth::user();
        $profile = Profile::firstOrNew([
            'user_id' => Auth::id(),
        ]);

        return view('frontend.pages.account.personalsetting', compact('user', 'profile'));
    }

    public function personalStore(Request $request)
    {
        $validated = $request->validate([
            'nid_num' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'in:male,female,other'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'twitter' => ['nullable', 'url', 'max:255'],
            'linkedIn' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
        ]);

        $validated['user_id'] = Auth::id();

        $existingProfile = Profile::where('user_id', Auth::id())->first();

        if ($existingProfile) {
            $existingProfile->update($validated);
        } else {
            Profile::create($validated);
        }

        return redirect()->back()->with('message', 'Profile updated successfully.');
    }

    public function updatePassword(ProfilePasswordChangeRequest $request)
    {
        $user = Auth::user();
        $hashedPassword = $user->password;

        if (!Hash::check($request->old_password, $hashedPassword)) {
            return redirect()->back()->withErrors([
                'old_password' => 'Current password does not match our records.',
            ])->withInput();
        }

        if (Hash::check($request->password, $hashedPassword)) {
            return redirect()->back()->withErrors([
                'password' => 'New password cannot be the same as old password.',
            ])->withInput();
        }

        if ($request->password !== $request->password_confirmation) {
            return redirect()->back()->withErrors([
                'password_confirmation' => 'The new password confirmation does not match.',
            ])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        Auth::logout();

        return redirect()->route('login')->with('message', 'Password updated successfully.');
    }
}
