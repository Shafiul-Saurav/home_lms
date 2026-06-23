<?php

namespace App\Services;

use App\Models\CourseOrder;
use App\Models\InstructorWithdrawalRequest;
use App\Models\Teacher;

class InstructorWithdrawalService
{
    public function calculateNetEarnings(Teacher $teacher): float
    {
        $commissionInfo = $this->getCommissionInfo($teacher);
        $courseIds = $teacher->courses->pluck('id')->toArray();

        $orders = CourseOrder::whereIn('course_id', $courseIds)
            ->where('status', 'Enrolled')
            ->where('payment_status', 'Completed')
            ->get();

        $grossSales = $orders->sum('amount');
        $adminShare = $grossSales * ($commissionInfo['admin_percentage'] / 100);
        $gatewayCharge = $grossSales * ($commissionInfo['gateway_percentage'] / 100);

        return round($grossSales - $adminShare - $gatewayCharge, 2);
    }

    public function calculateWithdrawalSummary(Teacher $teacher): array
    {
        $netEarnings = $this->calculateNetEarnings($teacher);

        $requestedAmount = (float) InstructorWithdrawalRequest::where('teacher_id', $teacher->id)
            ->whereIn('status', [
                InstructorWithdrawalRequest::STATUS_PENDING,
                InstructorWithdrawalRequest::STATUS_APPROVED,
            ])
            ->sum('amount');

        $pendingAmount = (float) InstructorWithdrawalRequest::where('teacher_id', $teacher->id)
            ->where('status', InstructorWithdrawalRequest::STATUS_PENDING)
            ->sum('amount');

        $approvedAmount = (float) InstructorWithdrawalRequest::where('teacher_id', $teacher->id)
            ->where('status', InstructorWithdrawalRequest::STATUS_APPROVED)
            ->sum('amount');

        $availableBalance = round(max(0, $netEarnings - $requestedAmount), 2);

        return [
            'net_earnings' => round($netEarnings, 2),
            'requested_amount' => round($requestedAmount, 2),
            'pending_amount' => round($pendingAmount, 2),
            'approved_amount' => round($approvedAmount, 2),
            'available_balance' => $availableBalance,
        ];
    }

    private function getCommissionInfo(Teacher $teacher): array
    {
        $commission = $teacher->approvedCommission;

        if ($commission) {
            return [
                'admin_percentage' => (float) $commission->admin_percentage,
                'gateway_percentage' => (float) $commission->gateway_percentage,
            ];
        }

        return [
            'admin_percentage' => 30.00,
            'gateway_percentage' => 2.50,
        ];
    }
}
