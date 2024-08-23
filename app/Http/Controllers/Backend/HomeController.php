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
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function adminDashboard()
    {
        // Optional: Authorize user to access admin dashboard
        // Gate::authorize('access-dashboard');

        // Fetch data for dashboard entities
        $roles = Role::count();
        $roomTypes = Roomtype::count();
        $rooms = Room::count();
        $departments = Department::count();
        $stuffs = Stuff::count();
        $users = User::where('role_id', 4)->count();

        // Fetch bookings data for the current week
        $bookings = Booking::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        // Prepare data for the weekly chart
        $start = Carbon::now()->startOfWeek();
        $end = Carbon::now()->endOfWeek();

        // Create a period from the start to the end of the week
        $period = CarbonPeriod::create($start, $end);

        $dateLabels = [];
        $dateMonYear = [];
        $bookingCounts = [];

        // Loop through each day in the period
        foreach ($period as $date) {
            $formattedDate = $date->toDateString();
            $dateLabels[] = $date->format('D, M j'); // Date format for labels
            $dateMonYear[] = $date->format('M, Y'); // Date format for headings
            $bookingCounts[] = $bookings[$formattedDate] ?? 0; // Get booking count or 0 if none
        }

        // Prepare data for the yearly chart
        $year = Carbon::now()->year;
        $bookingsByMonth = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')  // Add this to order the data by month
            ->pluck('count', 'month')
            ->toArray();

        $months = range(1, 12); // Array of months
        $monthLabels = [];
        $bookingCountsByMonth = [];

        foreach ($months as $month) {
            $monthLabels[] = Carbon::createFromDate(null, $month)->format('F'); // Month name
            $bookingCountsByMonth[] = $bookingsByMonth[$month] ?? 0; // Use 0 if no data for that month
        }

        // Total bookings
        $totalBookings = Booking::count();

        // Pass data to the view
        return view('backend.pages.dashboard', compact(
            'roles',
            'roomTypes',
            'rooms',
            'departments',
            'stuffs',
            'users',
            'dateLabels',
            'dateMonYear',
            'bookingCounts',
            'monthLabels',
            'bookingCountsByMonth',
            'totalBookings'
        ));
    }

}
