<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function userDashboard()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', Auth::user()->id)->first();
        return view('frontend.pages.user.dashboard', compact('user', 'profile'));
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
}
