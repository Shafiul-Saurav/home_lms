<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Room;
use App\Models\About;
use App\Models\Service;
use App\Models\Roomtype;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{

    public function home()
    {
        $about = About::latest('id')->first();
        $room_types = Roomtype::get();

        return view('frontend.pages.home', compact('about', 'room_types'));
    }

    public function about()
    {
        $about = About::latest('id')->first();
        $room_types = Roomtype::get();

        return view('frontend.pages.about.about_page', compact('about', 'room_types'));
    }

    public function rooms()
    {
        return view('frontend.pages.rooms.rooms');
    }

    public function services()
    {
        $services = Service::get();
        $room_types = Roomtype::get();
        return view('frontend.pages.services.services', compact('services', 'room_types'));
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
