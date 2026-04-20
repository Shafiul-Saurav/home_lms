<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookUpdateRequest extends FormRequest
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
            'book_category_id' => 'nullable|exists:book_categories,id',
            'book_subcategory_id' => 'nullable|exists:book_subcategories,id',
            'name' => ['required', 'string', 'max:255', Rule::unique('books', 'name')->ignore($this->route('book'))],
            'price' => 'required|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ];
    }
}
