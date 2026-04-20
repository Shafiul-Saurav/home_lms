<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PdfBookCategoryUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:pdf_book_categories,name,' . $this->route('pdf_book_category'),
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
        ];
    }
}
