<?php

namespace App\Http\Controllers\Backend;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentStoreUpdateRequest;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::latest('id')->paginate(100);
        return view('backend.pages.department.department', compact('departments'));
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
    public function store(DepartmentStoreUpdateRequest $request)
    {
        // dd($request->all());
        Department::create([
            'dep_name' => $request->dep_name,
            'dep_description' => $request->dep_description,
        ]);

        return redirect()->route('departments.index')->with('message', 'Department Created Successfully 🙂');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::findOrFail($id);
        return view('backend.pages.department.view', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::findOrFail($id);
        return view('backend.pages.department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentStoreUpdateRequest $request, string $id)
    {
        // dd($request->all());
        $department = Department::findOrFail($id);

        $department->update([
            'dep_name' => $request->dep_name,
            'dep_description' => $request->dep_description,
        ]);
        return redirect()->route('departments.index')->with('message', 'Department Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->back()->with('error', 'Department Deleted Successfully.');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('departments', 'public');
            return response()->json(['url' => Storage::url($path)]);
        }
        return response()->json(['error' => 'No image uploaded'], 400);
    }
}
