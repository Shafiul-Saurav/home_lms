<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilePasswordChangeRequest;
use App\Models\BookOrder;
use App\Models\CourseOrder;
use App\Models\CourseModule;
use App\Models\CreateCertificate;
use App\Models\LessonCompletion;
use App\Models\PdfBookOrder;
use App\Models\Profile;
use App\Models\ProfileImage;
use App\Models\User;
use App\Models\Post;
use App\Models\Postcategory;
use Intervention\Image\Facades\Image;
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

        $certificateRequests = CreateCertificate::where('user_id', $user->id)
            ->pluck('status', 'course_id')
            ->toArray();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontendone.pages.account.partials.mycourses_list', compact('user', 'enrolledCourses', 'certificateRequests'))->render(),
            ]);
        }

        return view('frontendone.pages.account.mycourses', compact('user', 'enrolledCourses', 'certificateRequests'));
    }

    public function courseOrders()
    {
        $user = Auth::user();
        $orders = CourseOrder::with('course')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(5);

        return view('frontendone.pages.account.course_order', compact('user', 'orders'));
    }

    public function courseOrderDetails(CourseOrder $order)
    {
        $user = Auth::user();

        abort_unless($order->user_id === $user->id, 403);

        $order->load('course');

        return view('frontendone.pages.account.course_order_details', compact('order'));
    }

    public function myCertificates(Request $request)
    {
        $user = Auth::user();

        $certificates = CreateCertificate::with('course')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(8);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontendone.pages.account.partials.certificates_list', compact('certificates'))->render(),
            ]);
        }

        return view('frontendone.pages.account.certificates', compact('user', 'certificates'));
    }

    public function certificateDetails(CreateCertificate $certificate)
    {
        $user = Auth::user();
        abort_unless($certificate->user_id === $user->id, 403);

        $certificate->load('course');
        return view('frontendone.pages.account.certificate_details', compact('certificate'));
    }

    public function applyCertificate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $courseId = $request->input('course_id');

        $isEnrolled = $user->courseOrders()
            ->where('course_id', $courseId)
            ->where('status', 'Enrolled')
            ->where('payment_status', 'Completed')
            ->exists();

        if (! $isEnrolled) {
            return redirect()->back()->with('error', 'You must be enrolled in the course to request a certificate.');
        }

        $totalModules = CourseModule::where('course_id', $courseId)->count();
        $completedModules = LessonCompletion::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->count();

        if ($totalModules > 0 && $completedModules < $totalModules) {
            return redirect()->back()->with('error', 'You must complete all course modules before applying for a certificate.');
        }

        $existingRequest = CreateCertificate::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('info', 'A certificate request already exists for this course.');
        }

        CreateCertificate::create([
            'user_id' => $user->id,
            'course_id' => $courseId,
            'status' => 'pending',
        ]);

        return redirect()->route('user.certificates')->with('success', 'Certificate request submitted successfully.');
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

    // ─── Blog Post Creation ───────────────────────────────────────────────────

    public function createPost()
    {
        $postCategories = Postcategory::where('is_active', 1)->get();
        return view('frontendone.pages.news.create', compact('postCategories'));
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'category_id'  => ['required', 'exists:postcategories,id'],
            'title'        => ['required', 'string', 'max:255'],
            'description'  => ['required', 'string'],
            'short_des'    => ['required', 'string'],
            'long_des'     => ['required', 'string'],
            'post_image'   => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $post = Post::create([
            'user_id'     => Auth::id(),
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'description' => $request->description,
            'short_des'   => $request->short_des,
            'long_des'    => $request->long_des,
            'is_active'   => 0,  // inactive until admin approves
            'is_home'     => 0,
        ]);

        if ($request->hasFile('post_image')) {
            $photo_location = 'public/uploads/posts/';
            $uploaded_photo = $request->file('post_image');
            $new_photo_name = $post->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(600, 450)->save(base_path($new_photo_location), 80);
            $post->update(['post_image' => $new_photo_name]);
        }

        return redirect()->route('news.search')
            ->with('message', 'Your post has been submitted and is awaiting admin approval.');
    }
}
