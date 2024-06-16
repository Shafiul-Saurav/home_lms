<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function adminDashboard()
    {
        // authorize this user to access/give access to admin dashboard
        // Gate::authorize('access-dashboard');

        return view('backend.pages.dashboard');
    }
}
