<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookSubcategoryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'book_category_id' => 'required|exists:book_categories,id',
            'name' => 'required|string|max:255|unique:book_subcategories,name',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'is_active' => 'nullable|boolean',
            'is_home' => 'nullable|boolean',
        ];
    }
}
