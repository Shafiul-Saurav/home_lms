<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::authenticateUsing(function (Request $request) {
            // 1. Validate Math Captcha
            $request->validate([
                'captcha' => [
                    'required',
                    'integer',
                    function ($attribute, $value, $fail) {
                        if (session('captcha_result') === null || intval($value) !== intval(session('captcha_result'))) {
                            $fail('Robot check failed. Please solve the math problem correctly.');
                        }
                    }
                ]
            ]);

            $email = $request->input('email');
            $ip = $request->ip();

            // 2. Check permanent block in database
            if (\App\Models\BlockedEntity::where('type', 'email')->where('value', $email)->exists()) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'email' => ['This email address has been permanently blocked due to multiple failed login attempts.'],
                ]);
            }

            if (\App\Models\BlockedEntity::where('type', 'ip')->where('value', $ip)->exists()) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'email' => ['Your IP address has been permanently blocked due to multiple failed login attempts.'],
                ]);
            }

            // 3. Check temporary block (using cache)
            $blockedUntilEmail = \Illuminate\Support\Facades\Cache::get("login_blocked_until_email_{$email}");
            if ($blockedUntilEmail && now()->lt($blockedUntilEmail)) {
                $diff = now()->diffInMinutes($blockedUntilEmail) + 1;
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'email' => ["Too many login failures. You are temporarily blocked. Please try again in {$diff} minutes."],
                ]);
            }

            $blockedUntilIp = \Illuminate\Support\Facades\Cache::get("login_blocked_until_ip_{$ip}");
            if ($blockedUntilIp && now()->lt($blockedUntilIp)) {
                $diff = now()->diffInMinutes($blockedUntilIp) + 1;
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'email' => ["Too many login failures from this IP. You are temporarily blocked. Please try again in {$diff} minutes."],
                ]);
            }

            // 4. Attempt login
            $user = \App\Models\User::where('email', $email)->first();

            if ($user && \Illuminate\Support\Facades\Hash::check($request->input('password'), $user->password)) {
                // Success: reset counters
                \Illuminate\Support\Facades\Cache::forget("login_fails_email_{$email}");
                \Illuminate\Support\Facades\Cache::forget("login_fails_ip_{$ip}");
                return $user;
            }

            // 5. Failed login: increment counters and block
            $failsEmail = \Illuminate\Support\Facades\Cache::get("login_fails_email_{$email}", 0) + 1;
            \Illuminate\Support\Facades\Cache::put("login_fails_email_{$email}", $failsEmail, now()->addHour());

            $failsIp = \Illuminate\Support\Facades\Cache::get("login_fails_ip_{$ip}", 0) + 1;
            \Illuminate\Support\Facades\Cache::put("login_fails_ip_{$ip}", $failsIp, now()->addHour());

            // 7 failed attempts: temporary block (15 minutes)
            if ($failsEmail >= 7 && $failsEmail < 12) {
                \Illuminate\Support\Facades\Cache::put("login_blocked_until_email_{$email}", now()->addMinutes(15), now()->addMinutes(15));
            }
            if ($failsIp >= 7 && $failsIp < 12) {
                \Illuminate\Support\Facades\Cache::put("login_blocked_until_ip_{$ip}", now()->addMinutes(15), now()->addMinutes(15));
            }

            // 12 failed attempts total (7 + another 5): permanent block (mail and IP)
            if ($failsEmail >= 12) {
                \App\Models\BlockedEntity::firstOrCreate([
                    'type' => 'email',
                    'value' => $email
                ]);
                \App\Models\BlockedEntity::firstOrCreate([
                    'type' => 'ip',
                    'value' => $ip
                ]);
            }
            if ($failsIp >= 12) {
                \App\Models\BlockedEntity::firstOrCreate([
                    'type' => 'email',
                    'value' => $email
                ]);
                \App\Models\BlockedEntity::firstOrCreate([
                    'type' => 'ip',
                    'value' => $ip
                ]);
            }

            return null;
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
