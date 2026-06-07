<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ExamCategory;
use App\Http\Requests\ExamCategoryStoreRequest;
use App\Http\Requests\ExamCategoryUpdateRequest;

class ExamCategoryController extends Controller
{
    public function index()
    {
        $categories = ExamCategory::latest('id')->paginate(30);
        return view('backend.pages.exam_category.category', compact('categories'));
    }

    public function create()
    {
        return redirect()->route('exam_categories.index');
    }

    public function store(ExamCategoryStoreRequest $request)
    {
        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/exam_categories'), $fileName);
        }

        ExamCategory::create([
            'name' => $request->name,
            'slug' => $request->slug ?? preg_replace('/\s+/u', '-', trim($request->name)),
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'free_paid' => $request->free_paid,
            'image' => $fileName,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->back()->with('message', 'Exam Category Created Successfully');
    }

    public function show(string $id)
    {
        return redirect()->route('exam_categories.index');
    }

    public function edit(string $id)
    {
        $category = ExamCategory::findOrFail($id);
        return view('backend.pages.exam_category.edit', compact('category'));
    }

    public function update(ExamCategoryUpdateRequest $request, string $id)
    {
        $category = ExamCategory::findOrFail($id);

        $fileName = $category->image;
        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path('uploads/exam_categories/' . $category->image))) {
                unlink(public_path('uploads/exam_categories/' . $category->image));
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/exam_categories'), $fileName);
        }

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug ?? preg_replace('/\s+/u', '-', trim($request->name)),
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'free_paid' => $request->free_paid,
            'image' => $fileName,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('exam_categories.index')->with('message', 'Exam Category Updated Successfully');
    }

    public function destroy(string $id)
    {
        $category = ExamCategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('warning', 'Exam Category Moved to Trash Successfully');
    }

    public function checkActive($id)
    {
        $category = ExamCategory::find($id);
        if (!$category) {
            return response()->json(['type' => 'error', 'message' => 'Not found'], 404);
        }
        $category->is_active = $category->is_active ? 0 : 1;
        $category->save();
        return response()->json(['type' => 'success', 'message' => 'Status Updated Successfully']);
    }
}
