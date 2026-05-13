<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PdfBookUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pdf_book_category_id' => 'nullable|exists:pdf_book_categories,id',
            'pdf_book_subcategory_id' => 'nullable|exists:pdf_book_subcategories,id',
            'name' => 'required|string|max:255|unique:pdf_books,name,' . $this->route('pdf_book'),
            'price' => 'required|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
            'description' => 'nullable|string',
            'author_name' => 'nullable|string|max:255',
            'author_description' => 'nullable|string',
            'author_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'is_active' => 'nullable|boolean',
        ];
    }
}
