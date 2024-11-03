<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Room;
use App\Models\About;
use App\Models\Service;
use App\Models\Roomtype;
use App\Models\Photogallery;
use App\Models\Videogallery;
use Illuminate\Http\Request;
use App\Models\Photocategory;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;

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

    public function roomDetails($id)
    {
        $room = Room::findOrFail($id);
        return view('frontend.pages.rooms.room_details', compact('room'));
    }

    public function booking($id)
    {
        $room = Room::findOrFail($id);
        return view('frontend.pages.booking.booking', compact('room'));
    }
}
