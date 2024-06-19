<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //authorize this user to access/give access to admin dashboard
        // Gate::authorize('index-user');

        $users = User::with(['role:id,role_name,role_slug'])
        ->select(['id', 'role_id', 'name', 'email', 'is_active', 'updated_at'])
        ->paginate(1000);

        $roles = Role::where('is_deletable', 1)->select(['id', 'role_name'])->get();

        return view('backend.pages.users.user', compact('users', 'roles'));
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
        //authorize this user to access/give access to admin dashboard
        // Gate::authorize('create-user');

        // dd($request->all());
        User::create([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('message', 'User Created Successfully 🙂');
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
    public function edit(string $id)
    {
        //authorize this user to access/give access to admin dashboard
        // Gate::authorize('edit-user');

        $user = User::where('id', $id)->first();
        $roles = Role::where('is_deletable', 1)->select(['id', 'role_name'])->get();

        return view('backend.pages.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //authorize this user to access/give access to admin dashboard
        // Gate::authorize('edit-user');

        // dd($request->all(), $id);
        $user = User::where('id', $id)->first();
        $user->update([
            'role_id' => $request->role_id,
            // 'name' => $request->name,
            // 'email' => $request->email,
            // 'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('message', 'User Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //authorize this user to access/give access to admin dashboard
        // Gate::authorize('delete-user');

        // dd($id);
        $user = User::where('id', $id)->first();
        if ($user->email != 'admin@admin.com') {
            $user->delete();

            return redirect()->back()->with('warning', 'User Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Admin Cannot be Deleted 😡!!');
        }


    }

    public function checkActive($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json([
                'type' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        // Toggle the is_active status
        $user->is_active = $user->is_active ? 0 : 1;
        $user->save();

        return response()->json([
            'type' => 'success',
            'message' => 'Status Updated'
        ]);
    }

}
