<?php

namespace App\Http\Controllers\Trash;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentTrashController extends Controller
{
    public function trash()
    {
        $departments = Department::onlyTrashed()->latest('id')->paginate(100);
        return view('backend.pages.department.trash', compact('departments'));
    }

    public function restore($id)
    {
        $department = Department::onlyTrashed()->where('id', $id)->first();
        $department->restore();

        return redirect()->back()->with('info', 'Department Restored Successfully 🙂');
    }

    public function forceDelete($id)
    {
        $department = Department::onlyTrashed()->where('id', $id)->first();
        $department->forceDelete();

        return redirect()->back()->with('error', 'Department Deleted Permanently');
    }
}
