<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AwardStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'nullable|digits:4|integer',
            'file' => 'nullable|file|max:2048',
            'is_active' => 'nullable|in:0,1',
        ];
    }
}
