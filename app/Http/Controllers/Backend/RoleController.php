<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //authorize this user to access/give access to admin dashboard
        // Gate::authorize('index-role');

        $roles = Role::with(['permissions:id,permission_name,permission_slug'])
        ->select(['id', 'role_name', 'role_slug', 'role_note', 'is_deletable', 'updated_at'])
        ->paginate(20);

        $modules = Module::with(['permissions:id,module_id,permission_name,permission_slug'])
        ->select('id', 'module_name')->get();

        return view('backend.pages.roles.role', compact('roles', 'modules'));
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
    public function store(RoleStoreRequest $request)
    {
        //authorize this user to access/give access to admin dashboard
        // Gate::authorize('create-role');

        Role::updateOrCreate([
            'role_name' => $request->role_name,
            'role_slug' => Str::slug($request->role_name),
            'role_note' => $request->role_note,
        ])->permissions()->sync($request->input('permissions', []));

        return redirect()->back()->with('message', 'Role Created Successfully 🙂');
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
    public function edit(string $role_slug)
    {
        //authorize this user to access/give access to admin dashboard
        // Gate::authorize('edit-role');

        $role = Role::where('role_slug', $role_slug)->first();
        $modules = Module::with(['permissions:id,module_id,permission_name,permission_slug'])
        ->select('id', 'module_name')->get();

        return view('backend.pages.roles.edit', compact('role', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, string $role_slug)
    {
        //authorize this user to access/give access to admin dashboard
        // Gate::authorize('edit-role');

        // dd($request->all(), $role_slug);
        $role = Role::where('role_slug', $role_slug)->first();
        // $role->update([
        //     'role_name' => $request->role_name,
        //     'role_slug' => Str::slug($request->role_name),
        //     'role_note' => $request->role_note,
        // ]);

        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('roles.index')->with('message', 'Role Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $role_slug)
    {
        //authorize this user to access/give access to admin dashboard
        // Gate::authorize('delete-role');

        $role = Role::where('role_slug', $role_slug)->first();
        if ($role->is_deletable){
            $role->delete();

            return redirect()->back()->with('warning', 'Role Deleted Successfully');
        }else {

            return redirect()->back()->with('error', 'Admin Cannot be Deleted 😡!!');
        }
    }
}
