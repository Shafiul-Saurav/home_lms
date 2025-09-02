<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Faq;
use App\Models\Post;
use App\Models\Room;
use App\Models\About;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Roomtype;
use App\Models\HomeSlider;
use App\Models\Testimonial;
use App\Models\WebsiteLink;
use App\Models\Photogallery;
use App\Models\Postcategory;
use App\Models\Videogallery;
use Illuminate\Http\Request;
use App\Models\Photocategory;
use App\Models\LogoFavicon;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $room_types = Roomtype::get();
        $testimonials = Testimonial::with('user')->limit(20)->get();
        //->where('rating', 5)

        $posts = Post::with(['postCategory', 'user'])
        ->where('is_home', 1)
        ->latest('id')->limit(3)->get();

        // Fetch products
        $products = \App\Models\Product::where('is_active', 1)->where('is_stock', 1)->latest('id')->get();

        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        return view('frontend.pages.home', compact('homeSliders', 'website_link', 'about', 'room_types', 'testimonials', 'posts', 'products', 'logo_fav'));
    }

    public function about()
    {
        $about = About::latest('id')->first();
        $room_types = Roomtype::get();
        $testimonials = Testimonial::with('user')->limit(20)->get();
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        return view('frontend.pages.about.about_page', compact('about', 'room_types', 'testimonials', 'logo_fav'));
    }

    public function rooms()
    {
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        return view('frontend.pages.rooms.rooms', compact('logo_fav'));
    }

    public function roomDetails($id)
    {
        $faqs = Faq::get();
        $room = Room::findOrFail($id);
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        return view('frontend.pages.rooms.room_details', compact('room', 'faqs', 'logo_fav'));
    }

    public function booking($id)
    {
        $room = Room::findOrFail($id);
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        return view('frontend.pages.booking.booking', compact('room', 'logo_fav'));
    }

    public function services()
    {
        $services = Service::where('is_active', 1)->get();
        $room_types = Roomtype::get();
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        return view('frontend.pages.services.services', compact('services', 'room_types', 'logo_fav'));
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

    public function bookingSuccess($id)
    {
        $booking = Booking::findOrFail($id);
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        if (Auth::user()->id == $booking->user_id) {
            return view('frontend.pages.success.booking_success', compact('booking', 'logo_fav'));
        } else {
            return redirect()->route('booking.history')->with('error', 'You have no permission to perform this actions!');
        }

    }

    public function productDetails($id)
    {
        $product = Product::with('productImages')->findOrFail($id);
        
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        return view('frontend.pages.product.details', compact('product', 'logo_fav'));
    }

    public function contact()
    {
        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();
        // $faqs = Faq::get();
        return view('frontend.pages.contact.contact', compact('logo_fav'));
    }





}
