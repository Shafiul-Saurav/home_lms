<?php

namespace App\Http\Controllers\Trash;

use App\Models\Stuff;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StuffTrashController extends Controller
{
    public function trash()
    {
        $stuffs = Stuff::onlyTrashed()->latest('id')->paginate(100);
        $departments = Department::get();
        return view('backend.pages.stuff.trash', compact('stuffs', 'departments'));
    }

    public function restore($id)
    {
        $stuffs = Stuff::onlyTrashed()->where('id', $id)->first();
        $stuffs->restore();

        return redirect()->back()->with('info', 'Staff Restored Successfully 🙂');
    }

    public function forceDelete($id)
    {
        $stuffs = Stuff::onlyTrashed()->where('id', $id)->first();
        if($stuffs->stuff_image != 'default_stuff.png'){
            $photo_location = 'uploads/stuffs/'.$stuffs->stuff_image;
            unlink($photo_location);
        }
        $stuffs->forceDelete();

        return redirect()->back()->with('error', 'Staff Deleted Permanently');
    }
}
