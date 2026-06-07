<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoGalleryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'nullable|numeric',
            'title' => 'nullable|string|max:50',
            'price' => 'nullable|string',
            'description' => 'nullable|string',
            'gall_image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
        ];
    }
}
