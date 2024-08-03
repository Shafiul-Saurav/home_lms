<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{

    public function home()
    {
        return view('frontend.pages.home');
    }

    public function rooms()
    {
        return view('frontend.pages.rooms.rooms');
    }

    public function roomDetails($id)
    {
        $room = Room::findOrFail($id);
        return view('frontend.pages.rooms.room_details', compact('room'));
    }
}
