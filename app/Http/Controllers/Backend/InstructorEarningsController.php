<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseOrder;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorEarningsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $teachers = collect();
        $selectedTeacher = null;

        // If the user is an Instructor (role_id == 7)
        if ($user->role_id == 7) {
            $selectedTeacher = Teacher::with('user')->where('user_id', $user->id)->first();
            if (!$selectedTeacher) {
                // Auto-create teacher profile if it doesn't exist
                $selectedTeacher = Teacher::create([
                    'user_id' => $user->id,
                    'qualification' => 'N/A',
                ]);
            }
        } else {
            // Admin or Super Admin (can view all teachers)
            $teachers = Teacher::with('user')->get()->filter(function ($t) {
                return $t->user !== null;
            });

            $teacherId = $request->query('teacher_id');
            if ($teacherId) {
                $selectedTeacher = Teacher::with('user')->find($teacherId);
            } else {
                $selectedTeacher = $teachers->first();
            }
        }

        $coursesData = collect();
        $totals = [
            'enrolled_students' => 0,
            'gross_sales' => 0.00,
            'admin_shares' => 0.00,
            'gateway_charges' => 0.00,
            'instructor_earnings' => 0.00,
        ];

        $commissionInfo = [
            'admin_percentage' => 30.00,
            'gateway_percentage' => 2.50,
            'status' => 'default',
        ];

        if ($selectedTeacher) {
            // Load their approved commission or fall back to defaults
            $commission = $selectedTeacher->approvedCommission;
            if ($commission) {
                $commissionInfo = [
                    'admin_percentage' => (float) $commission->admin_percentage,
                    'gateway_percentage' => (float) $commission->gateway_percentage,
                    'status' => 'approved',
                ];
            } else {
                // If there's any commission record but not approved, we show it as pending/rejected but fall back to defaults
                $anyCommission = $selectedTeacher->commission;
                if ($anyCommission) {
                    $commissionInfo['status'] = $anyCommission->status;
                }
            }

            // Get teacher's courses
            $courses = $selectedTeacher->courses;
            $courseIds = $courses->pluck('id')->toArray();

            // Get successful course orders for these courses
            $orders = CourseOrder::whereIn('course_id', $courseIds)
                ->where('status', 'Enrolled')
                ->where('payment_status', 'Completed')
                ->get();

            // Calculate metrics per course
            foreach ($courses as $course) {
                $courseOrders = $orders->where('course_id', $course->id);
                $enrollmentCount = $courseOrders->count();
                $grossSales = $courseOrders->sum('amount'); // amount paid by students after discounts

                $adminPct = $commissionInfo['admin_percentage'] / 100;
                $gatewayPct = $commissionInfo['gateway_percentage'] / 100;

                $adminShare = $grossSales * $adminPct;
                $gatewayCharge = $grossSales * $gatewayPct;
                $instructorShare = $grossSales - $adminShare - $gatewayCharge;

                $coursesData->push([
                    'course' => $course,
                    'enrollment_count' => $enrollmentCount,
                    'gross_sales' => round($grossSales, 2),
                    'admin_share' => round($adminShare, 2),
                    'gateway_charge' => round($gatewayCharge, 2),
                    'instructor_earnings' => round($instructorShare, 2),
                ]);

                $totals['enrolled_students'] += $enrollmentCount;
                $totals['gross_sales'] += $grossSales;
                $totals['admin_shares'] += $adminShare;
                $totals['gateway_charges'] += $gatewayCharge;
                $totals['instructor_earnings'] += $instructorShare;
            }
        }

        // Round final totals
        $totals['gross_sales'] = round($totals['gross_sales'], 2);
        $totals['admin_shares'] = round($totals['admin_shares'], 2);
        $totals['gateway_charges'] = round($totals['gateway_charges'], 2);
        $totals['instructor_earnings'] = round($totals['instructor_earnings'], 2);

        return view('backend.pages.earnings.index', compact(
            'teachers',
            'selectedTeacher',
            'coursesData',
            'totals',
            'commissionInfo'
        ));
    }
}
