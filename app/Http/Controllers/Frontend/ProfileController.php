<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilePasswordChangeRequest;
use App\Models\BookOrder;
use App\Models\CourseOrder;
use App\Models\CourseModule;
use App\Models\LessonCompletion;
use App\Models\PdfBookOrder;
use App\Models\Profile;
use App\Models\ProfileImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function userDashboard()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', Auth::user()->id)->first();

        // Calculate enrolled courses count
        $enrolledCount = CourseOrder::where('user_id', $user->id)
            ->where('status', 'Enrolled')
            ->where('payment_status', 'Completed')
            ->count();

        // Calculate completed courses count
        $completedCount = 0;
        $enrolledCourses = CourseOrder::where('user_id', $user->id)
            ->where('status', 'Enrolled')
            ->where('payment_status', 'Completed')
            ->get();

        foreach ($enrolledCourses as $order) {
            $courseId = $order->course_id;
            $totalModules = CourseModule::where('course_id', $courseId)->count();
            if ($totalModules > 0) {
                $completedCountForCourse = LessonCompletion::where('user_id', $user->id)
                    ->where('course_id', $courseId)
                    ->count();
                if ($completedCountForCourse >= $totalModules) {
                    $completedCount++;
                }
            }
        }

        // Calculate purchased PDF books count
        $purchasedPdfBooksCount = PdfBookOrder::where('user_id', $user->id)
            ->where('payment_status', 'Completed')
            ->count();

        $recentOrders = CourseOrder::with('course')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(5);

        if ($profile) {
            $profileImage = ProfileImage::where('profile_id', Auth::user()->profile->id)->first();

            return view('frontendone.pages.account.dashboard', compact('user', 'profile', 'profileImage', 'enrolledCount', 'completedCount', 'recentOrders', 'purchasedPdfBooksCount'));
        }

        return view('frontendone.pages.account.dashboard', compact('user', 'profile', 'enrolledCount', 'completedCount', 'recentOrders', 'purchasedPdfBooksCount'));
    }

    public function generalSetting()
    {
        $user = Auth::user();

        return view('frontendone.pages.account.generalsetting', compact('user'));
    }

    public function generalStore(Request $request)
    {
        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:20'],
        ], [
            'phone.required' => 'The phone field is required.',
            'phone.max' => 'The phone number may not be greater than 20 characters.',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->update([
            'phone' => $validated['phone'],
        ]);

        return redirect()->back()->with('message', 'General settings updated successfully.');
    }

    public function personalSetting()
    {
        $user = Auth::user();
        $profile = Profile::firstOrNew([
            'user_id' => Auth::id(),
        ]);

        return view('frontendone.pages.account.personalsetting', compact('user', 'profile'));
    }

    public function personalStore(Request $request)
    {
        $validated = $request->validate([
            'nid_num' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'in:male,female,other'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'twitter' => ['nullable', 'url', 'max:255'],
            'linkedIn' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
        ]);

        $validated['user_id'] = Auth::id();

        $existingProfile = Profile::where('user_id', Auth::id())->first();

        if ($existingProfile) {
            $existingProfile->update($validated);
        } else {
            Profile::create($validated);
        }

        return redirect()->back()->with('message', 'Profile updated successfully.');
    }

    public function updatePassword(ProfilePasswordChangeRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $hashedPassword = $user->password;

        if (!Hash::check($request->old_password, $hashedPassword)) {
            return redirect()->back()->withErrors([
                'old_password' => 'Current password does not match our records.',
            ])->withInput();
        }

        if (Hash::check($request->password, $hashedPassword)) {
            return redirect()->back()->withErrors([
                'password' => 'New password cannot be the same as old password.',
            ])->withInput();
        }

        if ($request->password !== $request->password_confirmation) {
            return redirect()->back()->withErrors([
                'password_confirmation' => 'The new password confirmation does not match.',
            ])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        Auth::logout();

        return redirect()->route('login')->with('message', 'Password updated successfully.');
    }

    public function myCourses(Request $request)
    {
        $user = Auth::user();
        $query = CourseOrder::with(['course.teachers.user', 'course.category'])
            ->where('user_id', $user->id)
            ->where('status', 'Enrolled')
            ->where('payment_status', 'Completed');

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('course', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Status Filter: 1 = Pending (progress < 100), 2 = Completed (progress = 100)
        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status == '1') { // Pending
                $query->where(function($q) use ($user) {
                    $q->whereRaw('(SELECT COUNT(*) FROM lesson_completions WHERE user_id = ? AND course_id = course_orders.course_id) < (SELECT COUNT(*) FROM course_modules WHERE course_id = course_orders.course_id)', [$user->id])
                      ->orWhereRaw('(SELECT COUNT(*) FROM course_modules WHERE course_id = course_orders.course_id) = 0');
                });
            } elseif ($status == '2') { // Completed
                $query->whereRaw('(SELECT COUNT(*) FROM lesson_completions WHERE user_id = ? AND course_id = course_orders.course_id) >= (SELECT COUNT(*) FROM course_modules WHERE course_id = course_orders.course_id)', [$user->id])
                      ->whereRaw('(SELECT COUNT(*) FROM course_modules WHERE course_id = course_orders.course_id) > 0');
            }
        }

        $enrolledCourses = $query->latest('id')->paginate(6);

        foreach ($enrolledCourses as $order) {
            $courseId = $order->course_id;
            $totalModules = CourseModule::where('course_id', $courseId)->count();
            $completedCount = LessonCompletion::where('user_id', $user->id)
                ->where('course_id', $courseId)
                ->count();

            $order->progress = $totalModules > 0 ? round(($completedCount / $totalModules) * 100) : 0;
        }

        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontendone.pages.account.partials.mycourses_list', compact('user', 'enrolledCourses'))->render(),
            ]);
        }

        return view('frontendone.pages.account.mycourses', compact('user', 'enrolledCourses'));
    }

    public function courseOrders()
    {
        $user = Auth::user();
        $orders = CourseOrder::with('course')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('frontendone.pages.account.course_order', compact('user', 'orders'));
    }

    public function courseOrderDetails(CourseOrder $order)
    {
        $user = Auth::user();

        abort_unless($order->user_id === $user->id, 403);

        $order->load('course');

        return view('frontendone.pages.account.course_order_details', compact('order'));
    }

    public function bookOrders()
    {
        $user = Auth::user();
        $orders = BookOrder::with('book')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('frontendone.pages.account.book_order', compact('user', 'orders'));
    }

    public function bookOrderDetails(BookOrder $order)
    {
        $user = Auth::user();

        abort_unless($order->user_id === $user->id, 403);

        $order->load('book');

        return view('frontendone.pages.account.book_order_details', compact('order'));
    }

    public function pdfBookOrders()
    {
        $user = Auth::user();
        $orders = PdfBookOrder::with('pdfBook')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('frontendone.pages.account.pdf_book_order', compact('user', 'orders'));
    }

    public function pdfBookOrderDetails(PdfBookOrder $order)
    {
        $user = Auth::user();

        abort_unless($order->user_id === $user->id, 403);

        $order->load('pdfBook');

        return view('frontendone.pages.account.pdf_book_order_details', compact('order'));
    }
}
