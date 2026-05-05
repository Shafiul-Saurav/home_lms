<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Faq;
use App\Models\Post;
use App\Models\About;
use App\Models\Course;
use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\LogoFavicon;
use App\Models\Testimonial;
use App\Models\WebsiteLink;
use App\Models\Photogallery;
use App\Models\Postcategory;
use App\Models\Videogallery;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Photocategory;
use App\Models\CourseModule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

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
        $testimonials = Testimonial::with('user')->limit(12)->get();
        //->where('rating', 5)

        $posts = Post::with(['postCategory', 'user'])
        ->where('is_home', 1)
        ->latest('id')->limit(3)->get();

        $categories = Category::where('is_active', 1)->where('is_home', 1)->latest('id')->get();

        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        return view('frontend.pages.home', compact('homeSliders', 'website_link', 'about', 'testimonials', 'posts', 'logo_fav', 'categories'));
    }

    public function about()
    {
        $about = About::latest('id')->first();
        $testimonials = Testimonial::with('user')->limit(20)->get();
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        return view('frontend.pages.about.about_page', compact('about', 'testimonials', 'logo_fav'));
    }

    public function courses(Request $request)
    {
        $query = Course::query();

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

        // Subcategory filter
        if ($request->filled('subcategory')) {
            $query->where('subcategory_id', $request->input('subcategory'));
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
        $selectedSubcategory = $request->input('category');
        $selectedPrice = $request->input('price');
        $selectedSort = $request->input('sort_by', 'latest');

        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        if ($request->ajax()) {
            $html = '';
            foreach ($courses as $course) {
                $html .= view('frontend.pages.courses.course_filter', compact('course'))->render();
            }

            if ($courses->count() == 0) {
                $html .= '<div class="col-12"><div class="alert alert-info text-center" role="alert"><h3>No Courses Found</h3><p>Sorry, we couldn\'t find any courses matching your filters. Please try adjusting your search criteria.</p></div></div>';
            }

            $pagination = view('frontend.pages.courses.partials.pagination', compact('courses'))->render();
            $topfilter = view('frontend.pages.courses.course_topfilter', compact('courses'))->render();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
                'topfilter' => $topfilter,
                'total' => $courses->total()
            ]);
        }

        return view('frontend.pages.courses.courses', compact(
            'courses',
            'categories',
            'subcategories',
            'logo_fav',
            'selectedCategory',
            'selectedSubcategory',
            'selectedPrice',
            'selectedSort'
        ));
    }

    public function courseDetails($id)
    {
        // Fetch course details
        $courseInfo = Course::where('id', $id)->where('is_active', 1)->first();

        if (!$courseInfo) {
            return redirect()->back()->with('error', 'Course not found');
        }

        // Fetch course category
        $category = Category::where('id', $courseInfo->category_id)->first();

        // Fetch course modules
        $modules = CourseModule::where('course_id', $id)->get();

        // Fetch recorded classes (modules where live_record is 'record' or 'recorded')
        $recorded_classes = $modules->filter(function ($module) {
            return isset($module->live_record) && in_array($module->live_record, ['record', 'recorded']);
        });

        // Fetch related courses
        $relatedCourses = Course::where('id', '!=', $id)
                            ->where('is_active', 1)
                            ->where('category_id', $courseInfo->category_id)
                            ->limit(3)
                            ->get();

        // Fetch module PDFs for lecture sheets
        $module_pdfs = CourseModule::where('course_id', $id)
                        ->whereNotNull('pdf_file')
                        ->get();

        // Check if user is logged in and enrolled
        $isLoggedIn = false;
        $isEnrolled = false;

        // Check if user is logged in using cookies
        $userId = Cookie::get('user_id');
        if($userId) {
            $isLoggedIn = true;

            // Check if user is enrolled in this course
            $courseOrder = DB::table('courses_order')
                            ->where('user_id', $userId)
                            ->where('course_id', $id)
                            ->first();
            if($courseOrder) {
                $isEnrolled = true;
            }
        }

        // Fetch testimonials
        $testimonials = Testimonial::limit(10)->get();

        return view('frontend.pages.courses.course_details', compact(
            'courseInfo',
            'category',
            'modules',
            'recorded_classes',
            'relatedCourses',
            'module_pdfs',
            'testimonials',
            'isLoggedIn',
            'isEnrolled'
        ));
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
            $html = '';
            foreach ($courses as $course) {
                $html .= view('frontend.pages.courses.course_filter', compact('course'))->render();
            }

            if ($courses->count() == 0) {
                $html .= '<div class="col-12"><div class="alert alert-info text-center" role="alert"><h3>No Courses Found</h3><p>Sorry, we couldn\'t find any courses matching your filters. Please try adjusting your search criteria.</p></div></div>';
            }

            $pagination = view('frontend.pages.courses.partials.pagination', compact('courses'))->render();
            $topfilter = view('frontend.pages.courses.course_topfilter', compact('courses'))->render();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
                'topfilter' => $topfilter,
                'total' => $courses->total()
            ]);
        }

        return view('frontend.pages.courses.categories.category_courses', compact(
            'courses',
            'categories',
            'subcategories',
            'logo_fav',
            'category'
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
            $html = '';
            foreach ($courses as $course) {
                $html .= view('frontend.pages.courses.course_filter', compact('course'))->render();
            }

            if ($courses->count() == 0) {
                $html .= '<div class="col-12"><div class="alert alert-info text-center" role="alert"><h3>No Courses Found</h3><p>Sorry, we couldn\'t find any courses matching your filters. Please try adjusting your search criteria.</p></div></div>';
            }

            $pagination = view('frontend.pages.courses.partials.pagination', compact('courses'))->render();
            $topfilter = view('frontend.pages.courses.course_topfilter', compact('courses'))->render();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
                'topfilter' => $topfilter,
                'total' => $courses->total()
            ]);
        }

        return view('frontend.pages.courses.categories.subcategory_courses', compact(
            'courses',
            'categories',
            'subcategories',
            'logo_fav',
            'subcategory'
        ));
    }

    public function photoGallery()
    {
        $galleries = Photogallery::where('is_active', 1)->get();
        $categories = Photocategory::get();
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        return view('frontend.pages.gallery.photogallery', compact('galleries', 'categories', 'logo_fav'));
    }

    public function videoGallery()
    {
        $videos = Videogallery::get();
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        return view('frontend.pages.gallery.videogallery', compact('videos', 'logo_fav'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::with(['postCategory', 'user'])
                    ->where('title', 'LIKE', "%{$query}%")
                    ->latest('id')
                    ->paginate(3);

        $popularPosts = Post::latest('id')->limit(5)->get();
        $postCategories = Postcategory::get();

        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        return view('frontend.pages.news.news', compact('posts', 'popularPosts', 'postCategories', 'logo_fav'));
    }

    public function newsDetails($id)
    {
        $post = Post::findOrFail($id);
        $popularPosts = Post::latest('id')->where('id', '!=', $id)->limit(5)->get();
        $postCategories = Postcategory::get();

        // Get the previous post
        $previousPost = Post::where('id', '<', $post->id)->orderBy('id', 'desc')->first();

        // Get the next post
        $nextPost = Post::where('id', '>', $post->id)->orderBy('id', 'asc')->first();

        // Paginate the comments for the post (excluding replies)
        $comments = $post->comments()->whereNull('parent_id')->paginate(5);

        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        return view('frontend.pages.news.news_details', compact('post', 'popularPosts', 'postCategories', 'previousPost', 'nextPost', 'comments', 'logo_fav'));
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
        // $faqs = Faq::get();
        return view('frontend.pages.contact.contact', compact('logo_fav'));
    }

    public function searchResults(Request $request)
    {
        $query = $request->get('q');

        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        return view('frontend.pages.search.results', compact('query', 'logo_fav'));
    }

}
