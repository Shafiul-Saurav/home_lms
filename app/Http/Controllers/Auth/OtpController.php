<?php

namespace App\Http\Controllers\Auth;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class OtpController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // Generate 6-digit OTP
        $otp = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

        // Set expiration time (10 minutes from now)
        $expiresAt = now()->addMinutes(10);

        // Delete any existing OTPs for this email
        Otp::where('email', $request->email)->delete();

        // Create new OTP
        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => $expiresAt
        ]);

        // Send OTP via email
        $this->sendOtpEmail($request->email, $otp);

        return redirect()->route('otp.verify.form', ['email' => $request->email])
            ->with('status', 'OTP sent to your email address.');
    }

    public function showVerifyOtpForm(Request $request)
    {
        $email = $request->query('email');

        if (!$email) {
            return redirect()->route('password.request')->with('error', 'Email is required.');
        }

        // Get the OTP record to show accurate expiration time
        $otpRecord = Otp::where('email', $email)->latest()->first();

        if (!$otpRecord) {
            return redirect()->route('password.request')->with('error', 'No OTP found for this email. Please request a new one.');
        }

        // Calculate time left, but ensure it starts from 10 minutes (600 seconds) if it's a fresh OTP
        $expiresAt = $otpRecord->expires_at;
        $calculatedTimeLeft = max(0, $expiresAt->timestamp - now()->timestamp);

        // If the OTP was just sent (within the last 30 seconds), start the timer from 10 minutes
        // This accounts for the time it takes for the user to navigate to the page
        $otpAge = now()->diffInSeconds($otpRecord->created_at);
        $isFreshOtp = $otpAge <= 30;
        $timeLeft = $isFreshOtp ? 600 : $calculatedTimeLeft;

        return view('auth.verify-otp', compact('email', 'expiresAt', 'timeLeft'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6'
        ]);

        $otpRecord = Otp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        if ($otpRecord->isExpired()) {
            return back()->withErrors(['otp' => 'OTP has expired. Please request a new one.']);
        }

        if ($otpRecord->isUsed()) {
            return back()->withErrors(['otp' => 'OTP has already been used. Please request a new one.']);
        }

        // Mark OTP as used
        $otpRecord->update(['used' => true]);

        // Redirect to reset password form with token
        return redirect()->route('password.reset.form', [
            'email' => $request->email,
            'token' => $otpRecord->id
        ]);
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // Generate 6-digit OTP
        $otp = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

        // Set expiration time (10 minutes from now)
        $expiresAt = now()->addMinutes(10);

        // Delete any existing OTPs for this email
        Otp::where('email', $request->email)->delete();

        // Create new OTP
        Otp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => $expiresAt
        ]);

        // Send OTP via email
        $this->sendOtpEmail($request->email, $otp);

        return response()->json([
            'success' => true,
            'message' => 'OTP resent successfully'
        ]);
    }

    public function showResetPasswordForm(Request $request)
    {
        $email = $request->query('email');
        $token = $request->query('token');

        if (!$email || !$token) {
            return redirect()->route('password.request')->with('error', 'Invalid request.');
        }

        // Verify that the token corresponds to a valid, used OTP
        $otpRecord = Otp::find($token);
        if (!$otpRecord || $otpRecord->email !== $email || !$otpRecord->isUsed()) {
            return redirect()->route('password.request')->with('error', 'Invalid or expired token.');
        }

        return view('auth.reset-password', compact('email', 'token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Verify the OTP token
        $otpRecord = Otp::find($request->token);
        if (!$otpRecord || $otpRecord->email !== $request->email || !$otpRecord->isUsed()) {
            return back()->withErrors(['email' => 'Invalid token.']);
        }

        // Find user and update password
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        // Optionally delete the OTP record after use
        $otpRecord->delete();

        return redirect()->route('login')->with('status', 'Your password has been reset!');
    }

    private function sendOtpEmail($email, $otp)
    {
        // Send OTP via email
        Mail::send('emails.otp', ['otp' => $otp], function($message) use ($email) {
            $message->to($email)
                    ->subject('Your Password Reset OTP');
        });
    }
}
