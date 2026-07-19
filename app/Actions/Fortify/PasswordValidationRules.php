<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     */
    protected function passwordRules(): array
    {
        return [
            'required',
            'string',
            Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols(),
            'confirmed',
            function ($attribute, $value, $fail) {
                $request = request();
                $name = $request->input('name');
                $email = $request->input('email');

                if (auth()->check()) {
                    $name = $name ?: auth()->user()->name;
                    $email = $email ?: auth()->user()->email;
                }

                if ($name) {
                    $nameParts = array_filter(explode(' ', strtolower($name)), function ($part) {
                        return strlen($part) > 2;
                    });
                    foreach ($nameParts as $part) {
                        if (str_contains(strtolower($value), $part)) {
                            $fail('The password cannot contain your name.');
                            return;
                        }
                    }
                }

                if ($email) {
                    $emailLocal = strtolower(explode('@', $email)[0]);
                    if (strlen($emailLocal) > 2 && str_contains(strtolower($value), $emailLocal)) {
                        $fail('The password cannot contain parts of your email address.');
                        return;
                    }
                    if (str_contains(strtolower($value), strtolower($email))) {
                        $fail('The password cannot contain your email address.');
                        return;
                    }
                }
            }
        ];
    }
}
