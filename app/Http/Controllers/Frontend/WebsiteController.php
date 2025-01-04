<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Faq;
use App\Models\Post;
use App\Models\Room;
use App\Models\About;
use App\Models\Service;
use App\Models\Roomtype;
use App\Models\Testimonial;
use App\Models\Photogallery;
use App\Models\Postcategory;
use App\Models\Videogallery;
use Illuminate\Http\Request;
use App\Models\Photocategory;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{

    public function home()
    {
        $about = About::latest('id')->first();
        $room_types = Roomtype::get();
        $testimonials = Testimonial::with('user')->limit(20)->get();
        //->where('rating', 5)

        return view('frontend.pages.home', compact('about', 'room_types', 'testimonials'));
    }

    public function about()
    {
        $about = About::latest('id')->first();
        $room_types = Roomtype::get();
        $testimonials = Testimonial::with('user')->limit(20)->get();
        return view('frontend.pages.about.about_page', compact('about', 'room_types', 'testimonials'));
    }

    public function rooms()
    {
        return view('frontend.pages.rooms.rooms');
    }

    public function roomDetails($id)
    {
        $faqs = Faq::get();
        $room = Room::findOrFail($id);
        return view('frontend.pages.rooms.room_details', compact('room', 'faqs'));
    }

    public function booking($id)
    {
        $room = Room::findOrFail($id);
        return view('frontend.pages.booking.booking', compact('room'));
    }

    public function services()
    {
        $services = Service::where('is_active', 1)->get();
        $room_types = Roomtype::get();
        return view('frontend.pages.services.services', compact('services', 'room_types'));
    }

    public function photoGallery()
    {
        $galleries = Photogallery::where('is_active', 1)->get();
        $categories = Photocategory::get();
        return view('frontend.pages.gallery.photogallery', compact('galleries', 'categories'));
    }

    public function videoGallery()
    {
        $videos = Videogallery::get();
        return view('frontend.pages.gallery.videogallery', compact('videos'));
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

        return view('frontend.pages.news.news', compact('posts', 'popularPosts', 'postCategories'));
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

        return view('frontend.pages.news.news_details', compact('post', 'popularPosts', 'postCategories', 'previousPost', 'nextPost', 'comments'));
    }

    public function faq()
    {
        $faqs = Faq::get();
        return view('frontend.pages.company_policy.faq', compact('faqs'));
    }



}
