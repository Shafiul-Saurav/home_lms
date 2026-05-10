<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Handled by UserController@teacher
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::with(['user', 'courses'])->findOrFail($id);

        // Get assigned courses with pivot data
        $assignedCourses = $teacher->courses()->withPivot('is_active')->get();

        return view('backend.pages.teacher.view', compact('teacher', 'assignedCourses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('edit-user');
        $user = User::with(['teacher.courses'])->findOrFail($id);

        // Check if the user has role_id == 7 (teacher role)
        if ($user->role_id != 7) {
            abort(403, 'Unauthorized to edit teacher information');
        }

        $courses = Course::all();

        return view('backend.pages.teacher.edit', compact('user', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Assign courses to a teacher via AJAX
     */
    public function assignCourses(Request $request, $id)
    {
        Gate::authorize('edit-user');

        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'course_ids' => 'required|array',
            'course_ids.*' => 'exists:courses,id'
        ]);

        // Sync the courses with the teacher through the course_teachers pivot table
        $syncData = [];
        foreach($request->course_ids as $course_id) {
            $syncData[$course_id] = ['is_active' => true];
        }

        // Sync without detaching existing courses
        $teacher->courses()->syncWithoutDetaching($syncData);

        return response()->json([
            'success' => true,
            'message' => 'Courses assigned to teacher successfully!'
        ]);
    }

    /**
     * Remove a specific course assignment from a teacher
     */
    public function removeCourse($teacher_id, $course_id)
    {
        Gate::authorize('edit-user');

        $teacher = Teacher::findOrFail($teacher_id);

        // Detach the specific course from the teacher
        $teacher->courses()->detach($course_id);

        return response()->json([
            'success' => true,
            'message' => 'Course removed from teacher successfully!'
        ]);
    }

    public function updateOrCreateFromUser(Request $request, $userId)
    {
        Gate::authorize('edit-user');

        // Find the teacher associated with the user
        $teacher = Teacher::where('user_id', $userId)->first();

        $request->validate([
            'qualification' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'hire_date' => 'nullable|date',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($teacher) {
            // Update existing teacher
            $teacher->update([
                'qualification' => $request->qualification,
                'salary' => $request->salary,
                'hire_date' => $request->hire_date,
            ]);
        } else {
            // Create new teacher
            $teacher = Teacher::create([
                'user_id' => $userId,
                'qualification' => $request->qualification,
                'salary' => $request->salary,
                'hire_date' => $request->hire_date,
            ]);
        }

        $this->image_upload($request, $teacher->id);

        return redirect()->back()->with('message', $teacher->wasRecentlyCreated ? 'Teacher Information Created Successfully 🙂' : 'Teacher Information Updated Successfully 🙂');
    }


    /**
     * Store/Update the Image file.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function image_upload($request, $teacher_id)
    {
        $teacher = Teacher::findOrFail($teacher_id);
        if ($request->hasFile('profile_image')) {
            if ($teacher->profile_image != 'default_profile_image.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/teachers/';
                $old_photo_location = $photo_location . $teacher->profile_image;
                if(file_exists(base_path($old_photo_location))) {
                    unlink(base_path($old_photo_location));
                }
            }
            $photo_location = 'public/uploads/teachers/';
            $uploaded_photo = $request->file('profile_image');
            $new_photo_name = $teacher->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;

            // Check if Image class exists (Intervention Image)
            if (class_exists('Intervention\Image\Facades\Image')) {
                Image::make($uploaded_photo)->resize(600, 600)->save(base_path($new_photo_location), 80);
            } else {
                // Fallback for simple upload if Intervention is not installed/configured
                $uploaded_photo->move(base_path($photo_location), $new_photo_name);
            }

            $teacher->update([
                'profile_image' => $new_photo_name,
            ]);
        }
    }
}
