<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamCategoryUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:exam_categories,name,' . $this->route('exam_category'),
            'slug' => 'nullable|string|max:255|unique:exam_categories,slug,' . $this->route('exam_category'),
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'free_paid' => 'required|string|in:free,paid',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
        ];
    }
}
