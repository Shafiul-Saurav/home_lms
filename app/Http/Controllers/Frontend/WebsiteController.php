<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Book;
use App\Models\Category;
use App\Models\Course;
use App\Models\Faq;
use App\Models\HomeSlider;
use App\Models\LogoFavicon;
use App\Models\Photocategory;
use App\Models\Photogallery;
use App\Models\Post;
use App\Models\Postcategory;
use App\Models\Testimonial;
use App\Models\Videogallery;
use App\Models\WebsiteLink;
use App\Models\CourseOrder;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Award;
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
            ->latest('id')->limit(3)->get();

        $categories = Category::where('is_active', 1)->where('is_home', 1)
            ->with(['courses' => function($q) {
                $q->where('is_active', 1)->limit(4);
            }])->latest('id')->get();

        $popularCourses = Course::where('is_active', 1)->latest('id')->limit(6)->get();
        $popularBooks = Book::where('is_active', 1)->latest('id')->limit(6)->get();

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

        return view('frontend.pages.home', compact(
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
            'awardsCounter'
        ));
    }

    public function about()
    {
        $about = About::latest('id')->first();
        $testimonials = Testimonial::with('user')->where('is_active', 1)->get();
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        return view('frontend.pages.about.about_page', compact('about', 'testimonials', 'logo_fav'));
    }

    public function photoGallery()
    {
        $galleries = Photogallery::where('is_active', 1)->get();
        $categories = Photocategory::get();
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        return view('frontend.pages.gallery.photo.photogallery', compact('galleries', 'categories', 'logo_fav'));
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

        return view('frontend.pages.news.posts', compact('posts', 'popularPosts', 'postCategories', 'logo_fav'));
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
