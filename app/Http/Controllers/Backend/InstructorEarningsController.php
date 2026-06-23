<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CourseOrder;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Services\InstructorWithdrawalService;

class InstructorEarningsController extends Controller
{
    public function index(Request $request, InstructorWithdrawalService $withdrawalService)
    {
        Gate::authorize('index-earning');
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
            $teachers = Teacher::with('user')
                ->get()
                ->filter(function ($t) {
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

        // For admin view, compute aggregated data per instructor
        $instructorsData = collect();
        if (Auth::user()->role_id != 7) {
            $adminTotals = [
                'courses_count' => 0,
                'enrolled_students' => 0,
                'gross_sales' => 0.00,
                'admin_shares' => 0.00,
                'gateway_charges' => 0.00,
                'instructor_earnings' => 0.00,
            ];

            foreach ($teachers as $teacher) {
                // Reset metrics for each teacher
                $teacherTotals = [
                    'courses_count' => 0,
                    'enrolled_students' => 0,
                    'gross_sales' => 0.00,
                    'admin_shares' => 0.00,
                    'gateway_charges' => 0.00,
                    'instructor_earnings' => 0.00,
                ];

                // Load commission for this teacher
                $teacherCommission = $teacher->approvedCommission;
                $tCommissionInfo = $commissionInfo; // default
                if ($teacherCommission) {
                    $tCommissionInfo = [
                        'admin_percentage' => (float) $teacherCommission->admin_percentage,
                        'gateway_percentage' => (float) $teacherCommission->gateway_percentage,
                        'status' => 'approved',
                    ];
                }

                $teacherCourses = $teacher->courses;
                $teacherTotals['courses_count'] = $teacherCourses->count();
                $tCourseIds = $teacherCourses->pluck('id')->toArray();
                $tOrders = CourseOrder::whereIn('course_id', $tCourseIds)
                    ->where('status', 'Enrolled')
                    ->where('payment_status', 'Completed')
                    ->get();

                foreach ($teacherCourses as $course) {
                    $cOrders = $tOrders->where('course_id', $course->id);
                    $enrollmentCount = $cOrders->count();
                    $grossSales = $cOrders->sum('amount');

                    $adminPct = $tCommissionInfo['admin_percentage'] / 100;
                    $gatewayPct = $tCommissionInfo['gateway_percentage'] / 100;
                    $adminShare = $grossSales * $adminPct;
                    $gatewayCharge = $grossSales * $gatewayPct;
                    $instructorShare = $grossSales - $adminShare - $gatewayCharge;

                    $teacherTotals['enrolled_students'] += $enrollmentCount;
                    $teacherTotals['gross_sales'] += $grossSales;
                    $teacherTotals['admin_shares'] += $adminShare;
                    $teacherTotals['gateway_charges'] += $gatewayCharge;
                    $teacherTotals['instructor_earnings'] += $instructorShare;
                }

                // Accumulate admin-wide totals
                $adminTotals['courses_count'] += $teacherTotals['courses_count'];
                $adminTotals['enrolled_students'] += $teacherTotals['enrolled_students'];
                $adminTotals['gross_sales'] += $teacherTotals['gross_sales'];
                $adminTotals['admin_shares'] += $teacherTotals['admin_shares'];
                $adminTotals['gateway_charges'] += $teacherTotals['gateway_charges'];
                $adminTotals['instructor_earnings'] += $teacherTotals['instructor_earnings'];

                // Round per teacher totals
                $teacherTotals['gross_sales'] = round($teacherTotals['gross_sales'], 2);
                $teacherTotals['admin_shares'] = round($teacherTotals['admin_shares'], 2);
                $teacherTotals['gateway_charges'] = round($teacherTotals['gateway_charges'], 2);
                $teacherTotals['instructor_earnings'] = round($teacherTotals['instructor_earnings'], 2);

                $instructorsData->push([
                    'teacher' => $teacher,
                    'totals' => $teacherTotals,
                ]);
            }

            // Round admin-wide totals and use them for dashboard summary cards
            $adminTotals['gross_sales'] = round($adminTotals['gross_sales'], 2);
            $adminTotals['admin_shares'] = round($adminTotals['admin_shares'], 2);
            $adminTotals['gateway_charges'] = round($adminTotals['gateway_charges'], 2);
            $adminTotals['instructor_earnings'] = round($adminTotals['instructor_earnings'], 2);

            $totals = [
                'enrolled_students' => $adminTotals['enrolled_students'],
                'gross_sales' => $adminTotals['gross_sales'],
                'admin_shares' => $adminTotals['admin_shares'],
                'gateway_charges' => $adminTotals['gateway_charges'],
                'instructor_earnings' => $adminTotals['instructor_earnings'],
            ];
        }

        $withdrawalSummary = null;
        if ($selectedTeacher) {
            $withdrawalSummary = $withdrawalService->calculateWithdrawalSummary($selectedTeacher);
        }

        return view('backend.pages.earnings.index', compact(
            'teachers',
            'selectedTeacher',
            'coursesData',
            'totals',
            'commissionInfo',
            'instructorsData',
            'withdrawalSummary'
        ));
    }

    /**
     * Show details for a specific instructor (admin view)
     */
    public function show($teacher_id)
    {
        Gate::authorize('view-earning');
        $teacher = Teacher::with('user')->findOrFail($teacher_id);

        // Determine commission info for the teacher
        $commissionInfo = [
            'admin_percentage' => 30.00,
            'gateway_percentage' => 2.50,
            'status' => 'default',
        ];
        $commission = $teacher->approvedCommission;
        if ($commission) {
            $commissionInfo = [
                'admin_percentage' => (float) $commission->admin_percentage,
                'gateway_percentage' => (float) $commission->gateway_percentage,
                'status' => 'approved',
            ];
        } else {
            $anyCommission = $teacher->commission;
            if ($anyCommission) {
                $commissionInfo['status'] = $anyCommission->status;
            }
        }

        // Load teacher's courses
        $courses = $teacher->courses;
        $courseIds = $courses->pluck('id')->toArray();

        // Get successful course orders for these courses
        $orders = CourseOrder::whereIn('course_id', $courseIds)
            ->where('status', 'Enrolled')
            ->where('payment_status', 'Completed')
            ->get();

        $coursesData = collect();
        $totals = [
            'enrolled_students' => 0,
            'gross_sales' => 0.00,
            'admin_shares' => 0.00,
            'gateway_charges' => 0.00,
            'instructor_earnings' => 0.00,
        ];

        foreach ($courses as $course) {
            $courseOrders = $orders->where('course_id', $course->id);
            $enrollmentCount = $courseOrders->count();
            $grossSales = $courseOrders->sum('amount');

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

        // Round final totals
        $totals['gross_sales'] = round($totals['gross_sales'], 2);
        $totals['admin_shares'] = round($totals['admin_shares'], 2);
        $totals['gateway_charges'] = round($totals['gateway_charges'], 2);
        $totals['instructor_earnings'] = round($totals['instructor_earnings'], 2);

        return view('backend.pages.earnings.details', compact('teacher', 'coursesData', 'totals', 'commissionInfo'));
    }
}
