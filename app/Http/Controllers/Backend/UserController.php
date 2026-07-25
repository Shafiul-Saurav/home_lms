<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use App\Models\BlockedEntity;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('index-user');

        $users = User::with(['role:id,role_name,role_slug'])
        ->select(['id', 'role_id', 'name', 'email', 'is_active', 'updated_at'])
        ->orderBy('id', 'desc')
        ->whereNotIn('role_id', [1, 2, 3])
        ->paginate(1000);

        $roles = Role::where('is_deletable', 1)->select(['id', 'role_name'])->get();

        return view('backend.pages.users.user', compact('users', 'roles'));
    }

    /**
     * Display a listing of the resource for system owner.
     */
    public function systemOwner()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('index-user');

        $users = User::with(['role:id,role_name,role_slug'])
        ->select(['id', 'role_id', 'name', 'email', 'is_active', 'updated_at'])
        ->whereIn('role_id', [1, 2, 3])
        ->paginate(1000);

        $roles = Role::where('is_deletable', 1)->select(['id', 'role_name'])->get();

        return view('backend.pages.users.system-owner', compact('users', 'roles'));
    }

    /**
    * Display a listing of the resource for students.
    */

    public function student()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('index-user');
        $users = User::with(['role:id,role_name,role_slug', 'profile.profileImage', 'courseOrders.course:id,name'])
        ->select(['id', 'role_id', 'name', 'email', 'phone', 'is_active', 'updated_at', 'profile_photo_path'])
        ->whereIn('role_id', [4])
        ->paginate(1000);

        $roles = Role::where('is_deletable', 1)->select(['id', 'role_name'])->get();

        return view('backend.pages.users.student', compact('users', 'roles'));
    }

    /**
     * Display a listing of the resource for teachers.
     */

    public function teacher()
    {
         //authorize this user to access/give access to admin dashboard
        Gate::authorize('index-user');
        $users = User::with(['role:id,role_name,role_slug', 'teacher'])
        ->select(['id', 'role_id', 'name', 'email', 'phone', 'is_active', 'updated_at'])
        ->whereIn('role_id', [7])
        ->paginate(1000);

        $roles = Role::where('is_deletable', 1)->select(['id', 'role_name'])->get();

        return view('backend.pages.users.teacher', compact('users', 'roles'));
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
    public function store(UserStoreRequest $request)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('create-user');

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
        Gate::authorize('edit-user');

        $user = User::where('id', $id)->first();
        $roles = Role::where('is_deletable', 1)->select(['id', 'role_name'])->get();

        return view('backend.pages.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('edit-user');

        $user = User::findOrFail($id);
        $oldRoleId = $user->role_id;

        $user->update([
            'role_id' => $request->role_id,
            // 'name' => $request->name,
            // 'email' => $request->email,
            // 'password' => Hash::make($request->password),
        ]);

        // If the user was an instructor and is now changed to a non-instructor role,
        // clear the old approved instructor request so the dashboard does not continue
        // showing a stale "Request Approved" state.
        if ($oldRoleId == 7 && $request->role_id != 7) {
            if ($user->instructorRequest) {
                $user->instructorRequest()->delete();
            }
        }

        return redirect()->route('users.index')->with('message', 'User Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('delete-user');

        // dd($id);
        $user = User::where('id', $id)->first();
        if ($user->email != 'admin@admin.com') {
            $user->delete();

            return redirect()->back()->with('warning', 'User Moved to Trash Successfully');
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

    /**
     * Display a listing of blocked users / entities.
     */
    public function blockedUsers()
    {
        Gate::authorize('index-user');

        $blockedEntities = BlockedEntity::orderBy('id', 'desc')->get();

        foreach ($blockedEntities as $entity) {
            if ($entity->type === 'email') {
                $entity->user = User::where('email', $entity->value)->first();
            } else {
                $entity->user = null;
            }
        }

        return view('backend.pages.users.blocked', compact('blockedEntities'));
    }

    /**
     * Unblock a blocked user / entity.
     */
    public function unblockUser($id)
    {
        Gate::authorize('index-user');

        $blockedEntity = BlockedEntity::findOrFail($id);
        $value = $blockedEntity->value;

        // Clear cache keys for both email and IP
        Cache::forget("login_blocked_until_email_{$value}");
        Cache::forget("login_blocked_until_ip_{$value}");
        Cache::forget("login_fails_email_{$value}");
        Cache::forget("login_fails_ip_{$value}");

        $blockedEntity->delete();

        return redirect()->back()->with('message', "Entity '{$value}' has been successfully unblocked 🙂");
    }

    /**
     * Manually block an email or IP address.
     */
    public function blockManual(Request $request)
    {
        Gate::authorize('index-user');

        $request->validate([
            'type' => 'required|in:email,ip',
            'value' => 'required|string|max:191',
        ]);

        $val = trim($request->value);

        BlockedEntity::firstOrCreate([
            'type' => $request->type,
            'value' => $val,
        ]);

        return redirect()->back()->with('message', "{$request->type} '{$val}' has been manually blocked.");
    }

}
