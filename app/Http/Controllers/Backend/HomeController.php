<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Stuff;
use App\Models\Department;
use App\Models\Servicetwo;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function adminDashboard()
    {
        // Optional: Authorize user to access admin dashboard
        Gate::authorize('access-dashboard');

        // Fetch data for dashboard entities
        $roles = Role::count();
        $departments = Department::count();
        $stuffs = Stuff::count();
        $users = User::where('role_id', 4)->count();
        $totalServiceClicks = Servicetwo::sum('visitor_count');

        // Pass data to the view
        return view('backend.pages.dashboard', compact(
            'roles',
            'departments',
            'stuffs',
            'users',
            'totalServiceClicks',
        ));
    }

    public function serviceClickTracking()
    {
        $services = Servicetwo::with(['category', 'subcategory'])
            ->orderByDesc('visitor_count')
            ->paginate(50);

        return view('backend.pages.service_clicks', compact('services'));
    }

}
