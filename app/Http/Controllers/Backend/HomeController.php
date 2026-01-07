<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Room;
use App\Models\User;
use App\Models\Stuff;
use App\Models\Booking;
use App\Models\Roomtype;
use Carbon\CarbonPeriod;
use App\Models\Department;
use Illuminate\Http\Request;
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


        // Pass data to the view
        return view('backend.pages.dashboard', compact(
            'roles',
            'departments',
            'stuffs',
            'users',
        ));
    }

}
