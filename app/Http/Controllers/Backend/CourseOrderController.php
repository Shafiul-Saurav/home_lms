<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CourseOrderController extends Controller
{
    public function index()
    {
        Gate::authorize('index-course-order');

        $orders = CourseOrder::with(['user', 'course'])->latest('id')->paginate(30);
        return view('backend.pages.orders.course_enrollment.index', compact('orders'));
    }

    public function edit(string $id)
    {
        Gate::authorize('edit-course-order');

        $order = CourseOrder::with(['user', 'course'])->findOrFail($id);
        return view('backend.pages.orders.course_enrollment.edit', compact('order'));
    }

    public function update(Request $request, string $id)
    {
        Gate::authorize('edit-course-order');

        $order = CourseOrder::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,Enrolled',
            'payment_status' => 'required|in:Pending,Completed,Failed,Cancelled',
        ]);

        $order->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('orders.course_enrollment')->with('message', 'Course order updated successfully');
    }

    public function destroy(string $id)
    {
        Gate::authorize('delete-course-order');

        $order = CourseOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.course_enrollment')->with('warning', 'Course order deleted successfully');
    }

    public function manualEnroll()
    {
        Gate::authorize('create-course-order');

        // Students have role_id = 4
        $users = User::with('profile.profileImage')
            ->where('role_id', 4)
            ->orderBy('name', 'asc')
            ->get();
        // Active courses have is_active = 1
        $courses = Course::where('is_active', 1)->orderBy('name', 'asc')->get();

        return view('backend.pages.orders.course_enrollment.manual', compact('users', 'courses'));
    }

    /**
     * Return enrolled course IDs for a given user.
     */
    public function getEnrolledCourses(string $userId)
    {
        Gate::authorize('create-course-order');

        $enrolled = CourseOrder::where('user_id', $userId)
            ->where('status', 'Enrolled')
            ->where('payment_status', 'Completed')
            ->pluck('course_id')
            ->toArray();

        return response()->json(['enrolled' => $enrolled]);
    }

    public function manualEnrollConfirm(Request $request)
    {
        Gate::authorize('create-course-order');

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $user = User::with('profile')->findOrFail($request->user_id);
        $course = Course::findOrFail($request->course_id);

        // Check if student is already enrolled in this course
        $exists = CourseOrder::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('status', 'Enrolled')
            ->where('payment_status', 'Completed')
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'User is already enrolled in this course.');
        }

        $orderNumber = 'MAN-' . strtoupper(substr(md5(uniqid()), 0, 6)) . '-' . date('Ymd');
        $transactionId = 'manual_' . uniqid();

        CourseOrder::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'name' => $user->name,
            'email' => $user->email ?? 'N/A',
            'phone' => $user->phone ?? 'N/A',
            'address' => $user->profile->address ?? 'N/A',
            'order_number' => $orderNumber,
            'transaction_id' => $transactionId,
            'currency' => 'BDT',
            'amount' => $course->price - $course->discount,
            'price' => $course->price,
            'discount_amount' => $course->discount,
            'coupon_name' => null,
            'date' => date('Y-m-d'),
            'agree' => 1,
            'status' => 'Enrolled',
            'payment_status' => 'Completed',
            'payment_method' => 'Manual',
        ]);

        return redirect()->route('orders.course_enrollment')->with('message', 'Student manually enrolled successfully.');
    }
}
