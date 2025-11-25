<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index($id = null)
    {
        // If an ID is provided, fetch the specific landing page
        if ($id) {
            $landingPage = LandingPage::with('products', 'whyBuyImages', 'reviewImages')->findOrFail($id);

            // Check if the landing page is active
            if (!$landingPage->is_active) {
                abort(404, 'Landing page not found or not active');
            }

            return view('landingpage.index', compact('landingPage'));
        } else {
            // If no ID provided, you can either redirect or show a default view
            // For now, we'll abort since this controller is specifically for dynamic landing pages
            abort(404, 'Landing page ID is required');
        }
    }
}
