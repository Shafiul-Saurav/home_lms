<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\InstructorWithdrawalRequest;
use App\Models\Teacher;
use App\Services\InstructorWithdrawalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class InstructorWithdrawalController extends Controller
{
    public function __construct(private readonly InstructorWithdrawalService $withdrawalService)
    {
    }

    public function index()
    {
        Gate::authorize('view-earning');

        $user = Auth::user();

        if ($user->role_id == 7) {
            $teacher = Teacher::with('user')->where('user_id', $user->id)->first();

            if (!$teacher) {
                $teacher = Teacher::create([
                    'user_id' => $user->id,
                    'qualification' => 'N/A',
                ]);
            }

            $withdrawals = InstructorWithdrawalRequest::with('teacher.user')
                ->where('teacher_id', $teacher->id)
                ->latest()
                ->paginate(15);

            $withdrawalSummary = $this->withdrawalService->calculateWithdrawalSummary($teacher);

            return view('backend.pages.earnings.my_withdrawals', compact('withdrawals', 'withdrawalSummary', 'teacher'));
        }

        $withdrawals = InstructorWithdrawalRequest::with('teacher.user')
            ->latest()
            ->paginate(30);

        return view('backend.pages.earnings.withdrawals', compact('withdrawals'));
    }

    public function store(Request $request)
    {
        Gate::authorize('index-earning');

        $user = Auth::user();
        if ($user->role_id != 7) {
            return redirect()->back()->with('warning', 'Only instructors can submit withdrawal requests.');
        }

        $teacher = Teacher::firstOrCreate([
            'user_id' => $user->id,
        ], [
            'qualification' => 'N/A',
        ]);

        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'account_name' => ['required', 'string', 'max:255'],
            'account_number' => ['required', 'string', 'max:255'],
            'account_details' => ['required', 'string', 'max:2000'],
            'note' => ['nullable', 'string', 'max:2000'],
        ]);

        $summary = $this->withdrawalService->calculateWithdrawalSummary($teacher);
        $availableBalance = $summary['available_balance'];

        if ($availableBalance <= 0) {
            return redirect()->back()->with('warning', 'No available net earnings to withdraw.');
        }

        $requestedAmount = round((float) $validated['amount'], 2);
        if ($requestedAmount > $availableBalance) {
            return redirect()->back()->with('warning', 'The withdrawal amount cannot be greater than your available balance of ' . number_format($availableBalance, 2) . ' ৳.');
        }

        InstructorWithdrawalRequest::create([
            'teacher_id' => $teacher->id,
            'user_id' => $user->id,
            'amount' => $requestedAmount,
            'account_name' => $validated['account_name'],
            'account_number' => $validated['account_number'],
            'account_details' => $validated['account_details'],
            'status' => InstructorWithdrawalRequest::STATUS_PENDING,
            'requested_at' => now(),
            'note' => $validated['note'] ?? null,
        ]);

        if (abs($requestedAmount - $availableBalance) < 0.01) {
            return redirect()->back()->with('message', 'Withdrawal request submitted for your full available balance. No withdrawable amount remains until new earnings are generated.');
        }

        $remainingBalance = round($availableBalance - $requestedAmount, 2);

        return redirect()->back()->with('message', 'Withdrawal request submitted successfully. Remaining withdrawable balance: ' . number_format($remainingBalance, 2) . ' à§³.');
    }

    public function approve($id)
    {
        Gate::authorize('view-earning');

        $withdrawal = InstructorWithdrawalRequest::findOrFail($id);
        $withdrawal->update([
            'status' => InstructorWithdrawalRequest::STATUS_APPROVED,
            'processed_at' => now(),
        ]);

        return redirect()->back()->with('message', 'Withdrawal request approved.');
    }

    public function reject($id)
    {
        Gate::authorize('view-earning');

        $withdrawal = InstructorWithdrawalRequest::findOrFail($id);
        $withdrawal->update([
            'status' => InstructorWithdrawalRequest::STATUS_REJECTED,
            'processed_at' => now(),
        ]);

        return redirect()->back()->with('warning', 'Withdrawal request rejected.');
    }
}