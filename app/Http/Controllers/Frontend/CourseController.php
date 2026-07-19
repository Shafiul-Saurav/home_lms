<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\CourseReview;
use App\Models\Exam;
use App\Models\Lesson;
use App\Models\LessonCompletion;
use App\Models\LogoFavicon;
use App\Models\Subcategory;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\WebsiteLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CourseController extends Controller
{
    protected $logo_fav;

    public function __construct()
    {
        // Fetch logo/favicon data and share with all views
        $this->logo_fav = LogoFavicon::first();
        View::share('logo_fav', $this->logo_fav);

        // Fetch website link data and share with all views
        $website_link = WebsiteLink::first();
        View::share('website_link', $website_link);
    }

    protected function renderCourseGrid($courses)
    {
        if ($courses->isEmpty()) {
            return '<div class="alert alert-danger text-center" role="alert"><h3>No Courses Found</h3><p>Sorry, we couldn\'t find any courses matching your filters. Please try adjusting your search criteria.</p></div>';
        }

        $html = '<div class="row g-4 course-grid-area">';

        foreach ($courses as $course) {
            $html .= view('frontendone.pages.courses.partials.course_filter', compact('course'))->render();
        }

        $html .= '</div>';
        $html .= '<div id="pagination-wrapper">';
        $html .= view('frontendone.pages.courses.partials.pagination', compact('courses'))->render();
        $html .= '</div>';

        return $html;
    }

    public function courses(Request $request)
    {
        $categories = Category::where('is_active', 1)->withCount(['courses' => function ($q) {
            $q->where('is_active', 1);
        }])->get();

        $subcategories = Subcategory::where('is_active', 1)->withCount(['courses' => function ($q) {
            $q->where('is_active', 1);
        }])->get();

        $testimonials = Testimonial::with('user')->where('is_active', 1)->get();

        $hasCategoryFilter = $request->filled('category');
        $categoryIds = [];
        if ($hasCategoryFilter) {
            $categoryIds = array_filter(explode(',', $request->input('category')));
        }

        $showNoCourses = ($hasCategoryFilter && in_array('none', $categoryIds));

        $groupedCourses = [];

        if (!$showNoCourses) {
            $categoriesToQuery = $hasCategoryFilter 
                ? $categories->whereIn('id', $categoryIds)
                : $categories;

            foreach ($categoriesToQuery as $category) {
                $coursesQuery = Course::with(['teachers.user', 'category'])
                    ->where('is_active', 1)
                    ->where('category_id', $category->id);

                if ($request->filled('search')) {
                    $search = $request->input('search');
                    $coursesQuery->where(function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%")
                          ->orWhere('description', 'LIKE', "%{$search}%");
                    });
                }

                if ($request->filled('subcategory')) {
                    $subcategoryIds = array_filter(explode(',', $request->input('subcategory')));
                    if (!empty($subcategoryIds)) {
                        $coursesQuery->whereIn('subcategory_id', $subcategoryIds);
                    }
                }

                if ($request->filled('price')) {
                    $priceFilters = explode(',', $request->input('price'));
                    if (in_array('free', $priceFilters) && in_array('paid', $priceFilters)) {
                        // both
                    } elseif (in_array('free', $priceFilters)) {
                        $coursesQuery->where('price', 0);
                    } elseif (in_array('paid', $priceFilters)) {
                        $coursesQuery->where('price', '>', 0);
                    }
                }

                $sortBy = $request->input('sort_by', 'latest');
                switch ($sortBy) {
                    case 'featured':
                        $coursesQuery->orderBy('id', 'desc');
                        break;
                    case 'low_price':
                        $coursesQuery->orderBy('price', 'asc');
                        break;
                    case 'high_price':
                        $coursesQuery->orderBy('price', 'desc');
                        break;
                    case 'latest':
                    default:
                        $coursesQuery->latest('id');
                        break;
                }

                $groupedCourses[$category->id] = $coursesQuery->get();
            }
        }

        $totalCoursesCount = 0;
        foreach ($groupedCourses as $catId => $list) {
            $totalCoursesCount += $list->count();
        }

        $courses = new \Illuminate\Pagination\LengthAwarePaginator(
            collect(),
            $totalCoursesCount,
            $totalCoursesCount > 0 ? $totalCoursesCount : 9,
            1
        );

        $selectedCategory = $request->input('category');
        $selectedSubcategory = $request->input('subcategory');
        $selectedPrice = $request->input('price');
        $selectedSort = $request->input('sort_by', 'latest');

        $logo_fav = LogoFavicon::first();

        if ($request->ajax()) {
            $html = view('frontendone.pages.courses.partials.grouped_course_grid', compact('categories', 'groupedCourses'))->render();
            $topfilter = view('frontendone.pages.courses.partials.course_topfilter', compact('courses'))->render();

            return response()->json([
                'html' => $html,
                'topfilter' => $topfilter,
                'total' => $totalCoursesCount
            ]);
        }

        return view('frontendone.pages.courses.courses', compact(
            'courses',
            'categories',
            'subcategories',
            'logo_fav',
            'selectedCategory',
            'selectedSubcategory',
            'selectedPrice',
            'selectedSort',
            'testimonials',
            'groupedCourses'
        ));
    }
    public function academy(Request $request)
    {
        $query = Course::with(['teachers.user', 'category']);
        $testimonials = Testimonial::with('user')->where('is_active', 1)->get();

        // Course reviews to be shown on the student tab
        $courseReviews = CourseReview::with('user')->where('is_approved', 1)->get();

        // Normalize CourseReview items to match Testimonial shape (use `review` key instead of `comment`)
        $courseReviews = $courseReviews->map(function ($r) {
            return (object) [
                'rating' => data_get($r, 'rating', 0),
                'review' => data_get($r, 'comment', ''),
                'user' => data_get($r, 'user'),
                'short_description' => null,
            ];
        });

        // Customer testimonials: show same testimonials as before
        $customerTestimonials = $testimonials;

        // Student testimonials: use course reviews
        $studentTestimonials = $courseReviews;

        // Filter by active courses only
        $query->where('is_active', 1);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $categoryIds = explode(',', $request->input('category'));
            $query->whereIn('category_id', $categoryIds);
        }

        // Subcategory filter (support multiple subcategory IDs)
        if ($request->filled('subcategory')) {
            $subcategoryIds = array_filter(explode(',', $request->input('subcategory')));
            if (!empty($subcategoryIds)) {
                $query->whereIn('subcategory_id', $subcategoryIds);
            }
        }

        // Price filter
        if ($request->filled('price')) {
            $priceFilters = explode(',', $request->input('price'));
            if (in_array('free', $priceFilters) && in_array('paid', $priceFilters)) {
                // If both are selected, no need to filter by price to show all
            } elseif (in_array('free', $priceFilters)) {
                $query->where('price', 0);
            } elseif (in_array('paid', $priceFilters)) {
                $query->where('price', '>', 0);
            }
        }

        // Sort by
        $sortBy = $request->input('sort_by', 'latest');
        switch ($sortBy) {
            case 'featured':
                $query->orderBy('id', 'desc');
                break;
            case 'low_price':
                $query->orderBy('price', 'asc');
                break;
            case 'high_price':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
            default:
                $query->latest('id');
                break;
        }

        // Paginate results
        $courses = $query->paginate(9);

        // Fetch all categories and subcategories for the filter sidebar
        $categories = Category::where('is_active', 1)->withCount(['courses' => function ($q) {
            $q->where('is_active', 1);
        }])->get();

        $subcategories = Subcategory::where('is_active', 1)->withCount(['courses' => function ($q) {
            $q->where('is_active', 1);
        }])->get();

        // Get selected filters for the view
        $selectedCategory = $request->input('category');
        $selectedSubcategory = $request->input('subcategory');
        $selectedPrice = $request->input('price');
        $selectedSort = $request->input('sort_by', 'latest');

        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        if ($request->ajax()) {
            $html = $this->renderCourseGrid($courses);
            $pagination = view('frontendone.pages.courses.partials.pagination', compact('courses'))->render();
            $topfilter = view('frontendone.pages.courses.partials.course_topfilter', compact('courses'))->render();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
                'topfilter' => $topfilter,
                'total' => $courses->total()
            ]);
        }

        $popularCourses = Course::where('is_active', 1)->latest('id')->limit(8)->get();

        return view('frontendone.pages.courses.academy', compact(
            'courses',
            'categories',
            'subcategories',
            'logo_fav',
            'selectedCategory',
            'selectedSubcategory',
            'selectedPrice',
            'selectedSort',
            'testimonials',
            'studentTestimonials',
            'customerTestimonials',
            'popularCourses'
        ));
    }

    public function courseDetails($id)
    {
        // Fetch course details
        $courseInfo = Course::with(['teachers.user', 'category'])->where('id', $id)->where('is_active', 1)->first();

        if (!$courseInfo) {
            return redirect()->back()->with('error', 'Course not found');
        }

        // Fetch course category
        $category = Category::where('id', $courseInfo->category_id)->first();

        // Fetch lessons with modules
        $lessons = Lesson::with('courseModules')
                        ->where('course_id', $id)
                        ->get();

        $modules = CourseModule::where('course_id', $id)->get();

        // Fetch related courses
        $relatedCourses = Course::with(['teachers.user', 'category'])->where('id', '!=', $id)
                            ->where('is_active', 1)
                            ->where('category_id', $courseInfo->category_id)
                            ->limit(4)
                            ->get();

        // Fetch course exams
        $exams = Exam::where('course_id', $id)->where('is_active', 1)->get();

        $reviews = CourseReview::with('user.profile.profileImage')
            ->where('course_id', $id)
            ->where('is_approved', 1)
            ->latest()
            ->paginate(5);

        // Check if user is logged in and enrolled
        $isLoggedIn = Auth::check();
        $isEnrolled = false;
        $completedModuleIds = [];

        if ($isLoggedIn) {
            /** @var User $user */
            $user = Auth::user();
            $isEnrolled = $user->isEnrolledInCourse($id);
            $completedModuleIds = LessonCompletion::where('user_id', $user->id)
                ->where('course_id', $id)
                ->pluck('module_id')
                ->toArray();
        }

        return view('frontendone.pages.courses.course_details', compact(
            'courseInfo',
            'category',
            'modules',
            'lessons',
            'relatedCourses',
            'exams',
            'reviews',
            'isLoggedIn',
            'isEnrolled',
            'completedModuleIds'
        ));
    }

    public function courseVideo($course_id, $module_id = null)
    {
        $course = Course::with('teachers.user')->where('id', $course_id)->where('is_active', 1)->firstOrFail();

        // Fetch lessons with modules
        $lessons = Lesson::with('courseModules')
                        ->where('course_id', $course_id)
                        ->get();

        $modules = CourseModule::where('course_id', $course_id)->get();

        // Check if user is logged in and enrolled
        $isLoggedIn = Auth::check();
        $isEnrolled = false;
        $completedModuleIds = [];

        if ($isLoggedIn) {
            /** @var User $user */
            $user = Auth::user();
            $isEnrolled = $user->isEnrolledInCourse($course_id);
            $completedModuleIds = LessonCompletion::where('user_id', $user->id)
                ->where('course_id', $course_id)
                ->pluck('module_id')
                ->toArray();
        }

        if ($module_id) {
            $module = $modules->where('id', $module_id)->first();
            if (!$module) {
                abort(404, 'Module not found');
            }
        } else {
            // Get the first module
            $module = $modules->first();
            if (!$module) {
                return redirect()->back()->with('error', 'No modules available for this course');
            }
        }

        // Access check for initial load: flash a toastr notification and redirect back
        if ($module->free_paid != 'free' && !$isEnrolled) {
            return redirect()->back()->with('error', 'Please enroll in this course to access this content');
        }

        return view('frontendone.pages.courses.course_video', compact('course', 'module', 'modules', 'lessons', 'isEnrolled', 'isLoggedIn', 'completedModuleIds'));
    }

    public function inspectLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'redirect' => route('login'),
        ]);
    }

    public function markAsCompleted(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:course_modules,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $user = Auth::user();
        $moduleId = $request->module_id;
        $courseId = $request->course_id;

        // Check if already completed
        $completion = LessonCompletion::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->where('module_id', $moduleId)
            ->first();

        if (!$completion) {
            LessonCompletion::create([
                'user_id' => $user->id,
                'course_id' => $courseId,
                'module_id' => $moduleId,
            ]);
            $status = 'completed';
        } else {
            // Option to unmark if needed, but for now let's just keep it completed
            // $completion->delete();
            // $status = 'unmarked';
            $status = 'already_completed';
        }

        // Calculate new progress
        $totalModules = CourseModule::where('course_id', $courseId)->count();
        $completedCount = LessonCompletion::where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->count();

        $progress = $totalModules > 0 ? round(($completedCount / $totalModules) * 100) : 0;

        return response()->json([
            'success' => true,
            'status' => $status,
            'progress' => $progress,
            'completedModuleIds' => LessonCompletion::where('user_id', $user->id)
                ->where('course_id', $courseId)
                ->pluck('module_id')
                ->toArray()
        ]);
    }

    public function ajaxCourseVideoData($module_id)
    {
        $module = CourseModule::find($module_id);
        if (!$module) {
            return response()->json(['success' => false, 'error' => 'Module not found'], 404);
        }

        $course = Course::find($module->course_id);

        $isEnrolled = false;
        $completedModuleIds = [];
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();
            $isEnrolled = $user->isEnrolledInCourse($course->id);
            $completedModuleIds = LessonCompletion::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->pluck('module_id')
                ->toArray();
        }

        $hasAccess = ($module->free_paid == 'free' || $isEnrolled);

        if (!$hasAccess) {
            return response()->json([
                'success' => false,
                'hasAccess' => false,
                'error' => 'Please enroll in this course to access this content'
            ]);
        }

        $lesson = $module->lesson_id ? Lesson::find($module->lesson_id) : null;

        return response()->json([
            'success' => true,
            'hasAccess' => true,
            'module' => $module,
            'course' => $course,
            'lesson' => $lesson,
            'isEnrolled' => $isEnrolled,
            'completedModuleIds' => $completedModuleIds
        ]);
    }

    public function categoryCourses($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $query = Course::query();

        $query->where('is_active', 1);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            if ($request->input('category') !== 'all') {
                $categoryIds = explode(',', $request->input('category'));
                $query->whereIn('category_id', $categoryIds);
            }
        } else {
            $query->where('category_id', $id);
        }

        if ($request->filled('subcategory')) {
            $query->where('subcategory_id', $request->input('subcategory'));
        }

        if ($request->filled('price')) {
            if ($request->input('price') !== 'all') {
                $priceFilters = explode(',', $request->input('price'));
                if (in_array('free', $priceFilters) && in_array('paid', $priceFilters)) {
                } elseif (in_array('free', $priceFilters)) {
                    $query->where('price', 0);
                } elseif (in_array('paid', $priceFilters)) {
                    $query->where('price', '>', 0);
                }
            }
        }

        $sortBy = $request->input('sort_by', 'latest');
        switch ($sortBy) {
            case 'featured':
                $query->orderBy('id', 'desc');
                break;
            case 'low_price':
                $query->orderBy('price', 'asc');
                break;
            case 'high_price':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
            default:
                $query->latest('id');
                break;
        }

        $courses = $query->paginate(9);

        $categories = Category::where('is_active', 1)->withCount(['courses' => function ($q) {
            $q->where('is_active', 1);
        }])->get();

        $subcategories = Subcategory::where('is_active', 1)->withCount(['courses' => function ($q) {
            $q->where('is_active', 1);
        }])->get();

        $logo_fav = LogoFavicon::first();

        if ($request->ajax()) {
            $html = $this->renderCourseGrid($courses);
            $pagination = view('frontendone.pages.courses.partials.pagination', compact('courses'))->render();
            $topfilter = view('frontendone.pages.courses.partials.course_topfilter', compact('courses'))->render();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
                'topfilter' => $topfilter,
                'total' => $courses->total()
            ]);
        }

        $selectedCategory = $category->id;
        $selectedSubcategory = null;

        return view('frontendone.pages.courses.categories.category_courses', compact(
            'courses',
            'categories',
            'subcategories',
            'logo_fav',
            'category',
            'selectedCategory',
            'selectedSubcategory'
        ));
    }

    public function subcategoryCourses($id, Request $request)
    {
        $subcategory = Subcategory::findOrFail($id);
        $query = Course::query();

        $query->where('is_active', 1);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            if ($request->input('category') !== 'all') {
                $categoryIds = explode(',', $request->input('category'));
                $query->whereIn('category_id', $categoryIds);
            }
        }

        if ($request->filled('subcategory')) {
            if ($request->input('subcategory') !== 'all') {
                $subcategoryIds = explode(',', $request->input('subcategory'));
                $query->whereIn('subcategory_id', $subcategoryIds);
            }
        } else {
            $query->where('subcategory_id', $id);
        }

        if ($request->filled('price')) {
            if ($request->input('price') !== 'all') {
                $priceFilters = explode(',', $request->input('price'));
                if (in_array('free', $priceFilters) && in_array('paid', $priceFilters)) {
                } elseif (in_array('free', $priceFilters)) {
                    $query->where('price', 0);
                } elseif (in_array('paid', $priceFilters)) {
                    $query->where('price', '>', 0);
                }
            }
        }

        $sortBy = $request->input('sort_by', 'latest');
        switch ($sortBy) {
            case 'featured':
                $query->orderBy('id', 'desc');
                break;
            case 'low_price':
                $query->orderBy('price', 'asc');
                break;
            case 'high_price':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
            default:
                $query->latest('id');
                break;
        }

        $courses = $query->paginate(9);

        $categories = Category::where('is_active', 1)->withCount(['courses' => function ($q) {
            $q->where('is_active', 1);
        }])->get();

        $subcategories = Subcategory::where('is_active', 1)->withCount(['courses' => function ($q) {
            $q->where('is_active', 1);
        }])->get();

        $logo_fav = LogoFavicon::first();

        if ($request->ajax()) {
            $html = $this->renderCourseGrid($courses);
            $pagination = view('frontendone.pages.courses.partials.pagination', compact('courses'))->render();
            $topfilter = view('frontendone.pages.courses.partials.course_topfilter', compact('courses'))->render();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
                'topfilter' => $topfilter,
                'total' => $courses->total()
            ]);
        }

        $selectedCategory = $subcategory->category_id;
        $selectedSubcategory = $subcategory->id;

        return view('frontendone.pages.courses.categories.subcategory_courses', compact(
            'courses',
            'categories',
            'subcategories',
            'logo_fav',
            'subcategory',
            'selectedCategory',
            'selectedSubcategory'
        ));
    }

    /**
     * Get live class notifications for the authenticated user
     */
    public function getLiveClassNotifications()
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'liveClasses' => []
            ]);
        }

        $user = Auth::user();
        $now = now();

        // Get enrolled courses
        $enrolledCourses = $user->courseOrders()
            ->where('payment_status', 'Completed')
            ->where('status', 'Enrolled')
            ->pluck('course_id')
            ->toArray();

        if (empty($enrolledCourses)) {
            return response()->json([
                'success' => true,
                'liveClasses' => [],
                'count' => 0
            ]);
        }

        // Get live modules from enrolled courses that are currently active or starting soon
        $liveModules = CourseModule::whereIn('course_id', $enrolledCourses)
            ->where('live_record', 'live')
            ->whereNotNull('date')
            ->whereNotNull('time')
            ->get()
            ->filter(function ($module) use ($now) {
                // Parse module date and time
                $moduleDateTime = $this->parseModuleDateTime($module->date, $module->time);
                if (!$moduleDateTime) {
                    return false;
                }

                // Check if module starts within next 24 hours or is currently live
                $startTime = $moduleDateTime->getTimestamp();
                $endTime = $moduleDateTime->addMonths(3)->getTimestamp();
                $currentTime = $now->getTimestamp();

                return $currentTime >= ($startTime - 86400) && $currentTime < $endTime;
            })
            ->map(function ($module) {
                $course = Course::find($module->course_id);
                $moduleDateTime = $this->parseModuleDateTime($module->date, $module->time);

                return [
                    'id' => $module->id,
                    'title' => $module->title,
                    'course_name' => $course->name ?? 'Course',
                    'course_id' => $course->id,
                    'date' => $module->date,
                    'time' => $module->time,
                    'link' => $module->link,
                    'start_timestamp' => $moduleDateTime ? $moduleDateTime->getTimestamp() : null,
                ];
            });

        return response()->json([
            'success' => true,
            'liveClasses' => $liveModules->values()->toArray(),
            'count' => $liveModules->count()
        ]);
    }

    /**
     * Parse module date and time string
     */
    private function parseModuleDateTime($date, $time)
    {
        $date = trim((string) $date);
        $time = trim((string) $time);

        if (empty($date) || empty($time)) {
            return null;
        }

        // Normalize time like 08.00pm -> 08:00 pm
        $time = preg_replace('/(\d{1,2})\.(\d{2})/i', '$1:$2', $time);
        $time = preg_replace('/\s*(am|pm)\s*$/i', ' $1', $time);

        // Normalize date like 16.10. 2025 -> 16.10.2025
        $date = preg_replace('/\s*\.\s*/', '.', $date);
        $date = preg_replace('/\.+$/', '.', $date);
        $date = preg_replace('/\.{2,}/', '.', $date);

        $candidates = [
            'd.m.Y h:i a',
            'd.m.Y g:i a',
            'd.m.Y h:i A',
            'd.m.Y g:i A',
            'd.m.Y h:iA',
            'd.m.Y g:iA',
            'd.m.Y h:ia',
            'd.m.Y g:ia',
            'd-m-Y h:i a',
            'd/m/Y h:i a',
            'Y-m-d H:i',
            'Y-m-d H:i:s',
            'M d, Y h:i A',
        ];

        foreach ($candidates as $fmt) {
            try {
                return \Carbon\Carbon::createFromFormat($fmt, $date . ' ' . $time);
            } catch (\Exception $e) {
                // Try next format
            }
        }

        return null;
    }
}
