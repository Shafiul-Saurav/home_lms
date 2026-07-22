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
            'course_level' => 'nullable|string|in:beginner,intermediate,advance',
            'free_or_paid' => 'nullable|string|in:free,paid',
            'price' => 'nullable|numeric|min:0|required_if:free_or_paid,paid',
            'discount' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'pdf' => 'nullable|file|mimes:pdf|max:10240',
            'description' => 'nullable|string',
            'full_description' => 'nullable|string',
            'live_schedule' => 'nullable|string|max:255',
            'start_date' => 'nullable|date|required_if:live_or_record,live',
            'end_date' => 'nullable|date|after_or_equal:start_date|required_if:live_or_record,live',
            'max_student' => 'nullable|integer|min:0|required_if:live_or_record,live',
            'meeting_link' => 'nullable|string|max:1000|required_if:live_or_record,live',
            'button_type' => 'nullable|string|in:Enroll Now,Comming Soon',
            'learning_outcomes' => 'nullable|string',
            'requirement' => 'nullable|string',
            'tags' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'live_or_record' => 'nullable|string|in:live,record',
            'is_offline' => 'nullable|boolean',
            'video_link' => 'nullable|string|max:1000',
            'lessons' => 'nullable|array',
            'lessons.*.id' => 'nullable|exists:lessons,id',
            'lessons.*.ref' => 'nullable|string|max:100',
            'lessons.*.name' => 'nullable|string|max:255',
            'lessons.*.description' => 'nullable|string',
            'modules' => 'nullable|array',
            'modules.*.id' => 'nullable|exists:course_modules,id',
            'modules.*.lesson_ref' => 'nullable|string|max:100',
            'modules.*.title' => 'nullable|string',
            'modules.*.module_type' => 'nullable|string|in:video,article',
            'modules.*.link' => 'nullable|string|max:1000',
            'modules.*.article' => 'nullable|string',
            'modules.*.duration' => 'nullable|string|max:255',
            'modules.*.free_paid' => 'nullable|string|max:255',
            'modules.*.live_record' => 'nullable|string|max:255',
            'modules.*.pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'modules.*.date' => 'nullable|string|max:255',
            'modules.*.time' => 'nullable|string|max:255',
        ];
    }
}
