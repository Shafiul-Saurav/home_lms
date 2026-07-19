<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'email', 'max:255', 'unique:users',
                function ($attribute, $value, $fail) {
                    $blockedDomains = [
                        'mailinator.com', 'yopmail.com', 'tempmail.com', 
                        'temp-mail.org', 'guerrillamail.com', 'sharklasers.com',
                        'dispostable.com', 'getairmail.com', 'maildrop.cc'
                    ];
                    $domain = strtolower(substr(strrchr($value, "@"), 1));
                    if (in_array($domain, $blockedDomains)) {
                        $fail('Temporary or disposable email addresses are not allowed.');
                    }
                }
            ],
            'phone' => ['required', 'string', 'max:20'],
            'password' => $this->passwordRules(),
            'captcha' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (session('captcha_result') === null || intval($value) !== intval(session('captcha_result'))) {
                        $fail('Robot check failed. Please solve the math problem correctly.');
                    }
                }
            ],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'role_id' => '4',
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'password' => Hash::make($input['password']),
        ]);

        Mail::to($user->email)->send(new RegistrationConfirmation());

        return $user;
    }
}
