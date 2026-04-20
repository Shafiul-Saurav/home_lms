<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PdfBookSubcategoryStoreRequest extends FormRequest
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
            'pdf_book_category_id' => 'required|exists:pdf_book_categories,id',
            'name' => 'required|string|max:255|unique:pdf_book_subcategories,name',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
        ];
    }
}
