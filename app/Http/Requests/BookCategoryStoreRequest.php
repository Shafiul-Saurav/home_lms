<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookCategoryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:book_categories,name',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'is_active' => 'nullable|boolean',
            'is_home' => 'nullable|boolean',
        ];
    }
}
