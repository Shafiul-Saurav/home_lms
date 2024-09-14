<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class SocialiteLoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        // dd($user);
        $existingUser = User::where('email', $user->getEmail())->first();
        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $newUser = User::create([
                'role_id' => Role::where('role_slug', 'user')->first()->id,
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => Hash::make('12345678'),
                'is_active' => true
            ]);

            Auth::login($newUser);
        }

        // Mail::to($user->email)->send(new RegistrationConfirmation());
        return redirect()->intended('user/dashboard'); // Change this to your desired redirect path
    }

}
