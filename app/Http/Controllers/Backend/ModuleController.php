<?php

namespace App\Http\Controllers\Backend;

use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ModuleStoreUpdateRequest;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('index-module');

        $modules = Module::latest('id')->select(['id', 'module_name', 'module_slug', 'updated_at'])->paginate(100);
        return view('backend.pages.modules.module', compact('modules'));
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
    public function store(ModuleStoreUpdateRequest $request)
    {
        // dd($request->all());
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('create-module');

        Module::create([
            'module_name' => $request->module_name,
            'module_slug' => Str::slug($request->module_name),
        ]);

        return redirect()->back()->with('message', 'Module Created Successfully 🙂');
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
    public function edit(string $module_slug)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('edit-module');

        $module = Module::where('module_slug', $module_slug)->first();
        return view('backend.pages.modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ModuleStoreUpdateRequest $request, string $module_slug)
    {
        // dd($request->module_slug);
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('edit-module');

        $module = Module::where('module_slug', $module_slug)->first();

        $module->update([
            'module_name' => $request->module_name,
            'module_slug' => Str::slug($request->module_name),
        ]);

        return redirect()->route('modules.index')->with('message', 'Module Updated Successfully 🙂');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $module_slug)
    {
        //authorize this user to access/give access to admin dashboard
        Gate::authorize('delete-module');

        $module = Module::where('module_slug', $module_slug)->first();
        $module->delete();

        return redirect()->back()->with('warning', 'Module Deleted Successfully');
    }
}
