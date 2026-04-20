<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamUpdateRequest extends FormRequest
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
            'category_id' => 'required|exists:exam_categories,id',
            'course_id' => 'nullable|exists:courses,id',
            'mcq_written' => 'required|string|in:mcq,written,both',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'free_paid' => 'required|string|in:free,paid',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:exams,slug,' . $this->route('exam'),
            'temporary_permanent' => 'required|string|in:temporary,permanent',
            'start_date' => 'nullable|date',
            'exam_time' => 'nullable|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'written_paragraph' => 'nullable|string',
        ];
    }
}
