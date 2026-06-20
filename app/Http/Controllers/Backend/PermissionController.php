<?php

namespace App\Http\Controllers\Backend;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PermissionStoreUpdateRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //authorize this user to access/give access to admin dashboard
        // Gate::authorize('index-permission');

        $permissions = Permission::with(['module:id,module_name,module_slug'])->latest('id')
        ->select(['id', 'module_id','permission_name', 'permission_slug', 'updated_at'])->paginate(100);
        $modules = Module::select(['id', 'module_name'])->get();
        return view('backend.pages.permissions.permission', compact('permissions', 'modules'));
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
    public function store(PermissionStoreUpdateRequest $request)
    {
        //authorize this user to access/give access to admin dashboard
        // Gate::authorize('create-permission');

        Permission::create([
            'module_id' => $request->module_id,
            'permission_name' => $request->permission_name,
            'permission_slug' => Str::slug($request->permission_name),
        ]);

        return redirect()->back()->with('message', 'Permission Created Successfully 🙂');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $permission_slug)
    {
        //authorize this user to access/give access to admin dashboard
        // Gate::authorize('edit-permission');

        $modules = Module::select(['id', 'module_name'])->get();
        $permission = Permission::where('permission_slug', $permission_slug)->first();

        return view('backend.pages.permissions.edit', compact('permission', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionStoreUpdateRequest $request, string $permission_slug)
    {
        //authorize this user to access/give access to admin dashboard
        // Gate::authorize('edit-permission');

        $permission = Permission::where('permission_slug', $permission_slug)->first();
        $permission->update([
            'module_id' => $request->module_id,
            'permission_name' => $request->permission_name,
            'permission_slug' => Str::slug($request->permission_name),
        ]);
        return redirect()->route('permissions.index')->with('message', 'Permission Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $permission_slug)
    {
        //authorize this user to access/give access to admin dashboard
        // Gate::authorize('delete-permission');

        $permission = Permission::where('permission_slug', $permission_slug)->first();
        $permission->delete();

        return redirect()->back()->with('warning', 'Permission Moved to Trash Successfully');
    }
}

