<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseUpdateRequest extends FormRequest
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
        $courseId = $this->route('course') ?? $this->route('id');

        return [
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'name' => ['required', 'string', 'max:255', Rule::unique('courses', 'name')->ignore($courseId)],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('courses', 'slug')->ignore($courseId)],
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'pdf' => 'nullable|file|mimes:pdf|max:10240',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'live_or_record' => 'nullable|string|max:255',
            'is_offline' => 'nullable|boolean',
            'video_link' => 'nullable|string|max:1000',
            'lessons' => 'nullable|array',
            'lessons.*.ref' => 'nullable|string|max:100',
            'lessons.*.name' => 'nullable|string|max:255',
            'modules' => 'nullable|array',
            'modules.*.lesson_ref' => 'nullable|string|max:100',
            'modules.*.title' => 'nullable|string',
            'modules.*.link' => 'nullable|string',
            'modules.*.free_paid' => 'nullable|string|max:255',
            'modules.*.live_record' => 'nullable|string|max:255',
            'modules.*.pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'modules.*.date' => 'nullable|string|max:255',
            'modules.*.time' => 'nullable|string|max:255',
        ];
    }
}
