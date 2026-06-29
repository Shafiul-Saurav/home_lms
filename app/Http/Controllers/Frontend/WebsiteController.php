<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Award;
use App\Models\Book;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseOrder;
use App\Models\Faq;
use App\Models\HomeSlider;
use App\Models\LogoFavicon;
use App\Models\Partner;
use App\Models\Photocategory;
use App\Models\Photogallery;
use App\Models\Post;
use App\Models\Postcategory;
use App\Models\Servicetwocategory;
use App\Models\Servicetwosubcategory;
use App\Models\Teacher;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Videogallery;
use App\Models\WebsiteLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class WebsiteController extends Controller
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

    public function home()
    {
        $homeSliders = HomeSlider::latest('id')->get();
        $website_link = WebsiteLink::first();
        $about = About::latest('id')->first();
        $testimonials = Testimonial::with('user')->where('is_active', 1)->get();

        $posts = Post::with(['postCategory', 'user'])
            ->where('is_home', 1)
            ->where('is_active', 1)
            ->latest('id')->limit(6)->get();

        $categories = Category::where('is_active', 1)->where('is_home', 1)
            ->with(['courses' => function($q) {
                $q->where('is_active', 1)->limit(4);
            }])->latest('id')->get();

        $popularCourses = Course::where('is_active', 1)->latest('id')->limit(6)->get();
        $popularBooks = Book::where('is_active', 1)->latest('id')->limit(6)->get();

        $photoGalleries = Photogallery::with('photoCategory')
            ->where('is_home', 1)
            ->where('is_active', 1)
            ->latest('id')
            ->limit(5)
            ->get();

        $heroStudentCount = CourseOrder::where('status', 'Enrolled')
            ->where('payment_status', 'Completed')
            ->distinct()
            ->count('user_id');

        $heroStudentCountLabel = $heroStudentCount > 0
            ? ($heroStudentCount >= 1000 ? number_format($heroStudentCount / 1000, 0) . 'k+' : $heroStudentCount . '+')
            : '250k+';

        $heroCourseCount = Course::where('is_active', 1)->count();
        $heroCourseCountLabel = $heroCourseCount > 0 ? $heroCourseCount . '+' : '160+';
        // Dynamic counters: format numbers for display animation (value + unit)
        $formatCounter = function ($n) {
            if ($n >= 1000000) {
                return ['value' => round($n / 1000000), 'unit' => 'M'];
            }
            if ($n >= 1000) {
                return ['value' => round($n / 1000), 'unit' => 'k'];
            }
            return ['value' => $n, 'unit' => ''];
        };

        $studentsCounter = $formatCounter($heroStudentCount);
        $coursesCounter = $formatCounter($heroCourseCount);

        // Count teachers (expert tutors)
        $tutorsCount = Teacher::count();
        $tutorsCounter = $formatCounter($tutorsCount);

        // Awards: count active awards from database
        $awardsCount = Award::where('is_active', 1)->count();
        $awardsCounter = $formatCounter($awardsCount);

        // Fetch teachers where the related user has role_id == 7 (limit to 4 for homepage)
        // eager-load user profile image to avoid N+1 queries
        $teachers = Teacher::with(['user.profile.profileImage'])->whereHas('user', function($q) {
            $q->where('role_id', 7);
        })->withCount('courses')->latest('id')->get();

        $heroAvatars = User::whereHas('profile.profileImage')
            ->with('profile.profileImage')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($user) {
                return asset($user->profile->profileImage->profile_image);
            })->toArray();

        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        // Fetch dynamic service categories and their respective services
        $serviceCategories = Servicetwocategory::where('is_active', 1)
            ->with(['servicetwos' => function($q) {
                $q->where('is_active', 1);
            }])->latest('id')->get();

        $partners = Partner::where('is_active', 1)->get();
        return view('frontendone.pages.home', compact(
            'homeSliders',
            'website_link',
            'about',
            'testimonials',
            'posts',
            'logo_fav',
            'categories',
            'popularCourses',
            'popularBooks',
            'heroStudentCountLabel',
            'heroCourseCountLabel',
            'heroAvatars',
            'studentsCounter',
            'coursesCounter',
            'tutorsCounter',
            'awardsCounter',
            'teachers',
            'serviceCategories',
            'photoGalleries',
            'partners'
        ));
    }

    public function about()
    {
        $about = About::latest('id')->first();
        $testimonials = Testimonial::with('user')->where('is_active', 1)->get();
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        $heroStudentCount = CourseOrder::where('status', 'Enrolled')
            ->where('payment_status', 'Completed')
            ->distinct()
            ->count('user_id');

        $heroStudentCountLabel = $heroStudentCount > 0
            ? ($heroStudentCount >= 1000 ? number_format($heroStudentCount / 1000, 0) . 'k+' : $heroStudentCount . '+')
            : '250k+';

        $heroCourseCount = Course::where('is_active', 1)->count();
        $heroCourseCountLabel = $heroCourseCount > 0 ? $heroCourseCount . '+' : '160+';
        // Dynamic counters: format numbers for display animation (value + unit)
        $formatCounter = function ($n) {
            if ($n >= 1000000) {
                return ['value' => round($n / 1000000), 'unit' => 'M'];
            }
            if ($n >= 1000) {
                return ['value' => round($n / 1000), 'unit' => 'k'];
            }
            return ['value' => $n, 'unit' => ''];
        };

        $studentsCounter = $formatCounter($heroStudentCount);
        $coursesCounter = $formatCounter($heroCourseCount);

        // Count teachers (expert tutors)
        $tutorsCount = Teacher::count();
        $tutorsCounter = $formatCounter($tutorsCount);

        // Awards: count active awards from database
        $awardsCount = Award::where('is_active', 1)->count();
        $awardsCounter = $formatCounter($awardsCount);
        return view('frontendone.pages.about.about_page', compact('about', 'testimonials', 'logo_fav', 'studentsCounter', 'coursesCounter', 'tutorsCounter', 'awardsCounter'));
    }

    public function photoGallery()
    {
        $galleries = Photogallery::where('is_active', 1)->get();
        $categories = Photocategory::get();
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        return view('frontendone.pages.gallery.photo.photogallery', compact('galleries', 'categories', 'logo_fav'));
    }

    public function videoGallery()
    {
        $videos = Videogallery::get();
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        return view('frontend.pages.gallery.video.videogallery', compact('videos', 'logo_fav'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category');

        $postsQuery = Post::with(['postCategory', 'user']);

        if ($query) {
            $postsQuery->where('title', 'LIKE', "%{$query}%");
        }

        if ($categoryId) {
            $postsQuery->where('category_id', $categoryId);
        }

        $posts = $postsQuery->latest('id')->paginate(3);

        $popularPosts = Post::latest('id')->limit(5)->get();
        $postCategories = Postcategory::withCount('posts')->get();

        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        return view('frontendone.pages.news.posts', compact('posts', 'popularPosts', 'postCategories', 'logo_fav'));
    }

    public function newsDetails($id)
    {
        $post = Post::findOrFail($id);
        $popularPosts = Post::latest('id')->where('id', '!=', $id)->limit(5)->get();
        $postCategories = Postcategory::withCount('posts')->get();

        // Get the previous post
        $previousPost = Post::where('id', '<', $post->id)->orderBy('id', 'desc')->first();

        // Get the next post
        $nextPost = Post::where('id', '>', $post->id)->orderBy('id', 'asc')->first();

        // Paginate the comments for the post (excluding replies)
        $comments = $post->comments()->whereNull('parent_id')->paginate(5);

        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        return view('frontend.pages.news.post_deatils', compact('post', 'popularPosts', 'postCategories', 'previousPost', 'nextPost', 'comments', 'logo_fav'));
    }

    public function faq()
    {
        $faqs = Faq::get();
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        return view('frontend.pages.company_policy.faq', compact('faqs', 'logo_fav'));
    }

    public function contact()
    {
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        return view('frontendone.pages.contact.contact_page', compact('logo_fav'));
    }

    public function mentors()
    {
        $teachers = Teacher::with(['user.profile.profileImage'])
            ->whereHas('user', function ($q) {
                $q->where('role_id', 7);
            })
            ->withCount('courses')
            ->latest('id')
            ->get();

        $logo_fav = LogoFavicon::first();

        return view('frontendone.pages.mentors.mentors', compact('teachers', 'logo_fav'));
    }
    public function searchResults(Request $request)
    {
        $query = $request->get('q');

        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        return view('frontend.pages.search.results', compact('query', 'logo_fav'));
    }

    /**
     * Display a listing of all teachers (frontend)
     */
    public function teachers(Request $request)
    {
        // Build base query and eager-load relations
        $query = Teacher::with(['user.profile.profileImage', 'courses'])
            ->whereHas('user', function($q) {
                $q->where('role_id', 7);
            });

        // Search by teacher qualification or user name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('qualification', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function ($q2) use ($search) {
                      $q2->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }

        // Filter by course category (teachers who teach courses in these categories)
        if ($request->filled('category')) {
            $categoryIds = explode(',', $request->input('category'));
            $query->whereHas('courses', function ($q) use ($categoryIds) {
                $q->whereIn('category_id', $categoryIds)->where('courses.is_active', 1);
            });
        }

        // Filter by specific course(s)
        if ($request->filled('course')) {
            $courseIds = explode(',', $request->input('course'));
            $query->whereHas('courses', function ($q) use ($courseIds) {
                $q->whereIn('courses.id', $courseIds)->where('courses.is_active', 1);
            });
        }

        // Sorting
        $selectedSort = $request->input('sort_by', 'featured');

        // Sorting: support ascending/descending via `sort_order` param
        $selectedOrder = $request->input('sort_order', 'desc');
        $order = in_array(strtolower($selectedOrder), ['asc', 'desc']) ? strtolower($selectedOrder) : 'desc';

        // Add courses count for sorting and display
        $query = $query->withCount('courses');

        // For now we only support sorting by number of courses (featured)
        $query->orderBy('courses_count', $order);

        // Paginate results
        $teachers = $query->paginate(12);

        // Fetch categories and count unique instructors for each using Course model
        $teacherCounts = Course::join('course_teachers', 'courses.id', '=', 'course_teachers.course_id')
            ->join('teachers', 'course_teachers.teacher_id', '=', 'teachers.id')
            ->join('users', 'teachers.user_id', '=', 'users.id')
            ->whereNull('users.deleted_at')
            ->where('courses.is_active', 1)
            ->where('users.role_id', 7)
            ->groupBy('courses.category_id')
            ->selectRaw('courses.category_id, count(distinct teachers.id) as count')
            ->pluck('count', 'category_id');

        $categories = Category::where('is_active', 1)->get();
        foreach ($categories as $category) {
            $category->instructors_count = $teacherCounts->get($category->id, 0);
        }

        // Calculate total unique instructors across all active categories/courses
        $totalInstructorsCount = Teacher::whereHas('courses', function ($q) {
            $q->where('courses.is_active', 1);
        })->whereHas('user', function ($q) {
            $q->where('role_id', 7);
        })->count();

        $courses = Course::where('is_active', 1)->get();

        $selectedCategory = $request->input('category');
        $selectedCourse = $request->input('course');
        $selectedSearch = $request->input('search');
        $selectedSort = $selectedSort;

        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        if ($request->ajax()) {
            $html = $this->renderTeacherGrid($teachers);
            $pagination = view('frontend.pages.teachers.partials.pagination', compact('teachers'))->render();
            $topfilter = view('frontend.pages.teachers.teacher_topfilter', compact('teachers', 'selectedSort', 'selectedOrder'))->render();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
                'topfilter' => $topfilter,
                'total' => $teachers->total()
            ]);
        }

        return view('frontend.pages.teachers.index', compact(
            'teachers',
            'logo_fav',
            'categories',
            'courses',
            'selectedCategory',
            'selectedCourse',
            'selectedSearch',
            'selectedSort',
            'selectedOrder',
            'totalInstructorsCount'
        ));
    }

    /**
     * Display a single teacher's details (frontend)
     */
    public function teacherDetails($id)
    {
        $teacher = Teacher::with(['user.profile.profileImage', 'courses' => function($q) {
            $q->where('courses.is_active', 1);
        }])->where('id', $id)->firstOrFail();

        // Fetch related courses
        $courses = $teacher->courses()->where('courses.is_active', 1)->get();

        // Simple stats
        $averageRating = $teacher->averageRating();
        $reviewCount = $teacher->reviewCount();

        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        return view('frontend.pages.teachers.show', compact('teacher', 'courses', 'averageRating', 'reviewCount', 'logo_fav'));
    }

    protected function renderTeacherGrid($teachers)
    {
        if ($teachers->isEmpty()) {
            return '<div class="alert alert-danger text-center" role="alert"><h3>No Instructors Found</h3><p>Sorry, we couldn\'t find any instructors matching your filters. Please try adjusting your search criteria.</p></div>';
        }

        $html = '<div class="row">';

        foreach ($teachers as $teacher) {
            $html .= view('frontend.pages.teachers.teacher_filter', compact('teacher'))->render();
        }

        $html .= '</div>';
        $html .= '<div id="pagination-wrapper">';
        $html .= view('frontend.pages.teachers.partials.pagination', compact('teachers'))->render();
        $html .= '</div>';

        return $html;
    }

    /**
     * Display services by category
     */
    public function serviceCategory($id)
    {
        $category = Servicetwocategory::with(['servicetwos' => function($q) {
            $q->where('is_active', 1);
        }])->findOrFail($id);

        $logo_fav = LogoFavicon::first();

        return view('frontendone.pages.services.category', compact('category', 'logo_fav'));
    }

    /**
     * Display services by subcategory
     */
    public function serviceSubcategory($subcategoryId)
    {
        $subcategory = Servicetwosubcategory::with(['category'])->findOrFail($subcategoryId);

        // Get services for this subcategory
        $services = $subcategory->category->servicetwos()
            ->where('servicetwosubcategory_id', $subcategoryId)
            ->where('is_active', 1)
            ->get();

        $logo_fav = LogoFavicon::first();

        return view('frontendone.pages.services.subcategory', compact('subcategory', 'services', 'logo_fav'));
    }
}


