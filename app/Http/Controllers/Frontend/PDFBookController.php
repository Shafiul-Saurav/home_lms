<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PdfBook;
use App\Models\PdfBookCategory;
use App\Models\PdfBookSubcategory;
use App\Models\PdfBookOrder;
use App\Models\LogoFavicon;
use App\Models\WebsiteLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PDFBookController extends Controller
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

    public function pdfBooks(Request $request)
    {
        $query = PdfBook::with(['pdfBookCategory']);

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
            $query->whereIn('pdf_book_category_id', $categoryIds);
        }

        // Price filter
        if ($request->filled('price')) {
            $priceFilters = explode(',', $request->input('price'));
            if (in_array('free', $priceFilters) && in_array('paid', $priceFilters)) {
                // All
            } elseif (in_array('free', $priceFilters)) {
                $query->where('price', 0);
            } elseif (in_array('paid', $priceFilters)) {
                $query->where('price', '>', 0);
            }
        }

        // Sort by
        $sortBy = $request->input('sort_by', 'latest');
        switch ($sortBy) {
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
        $pdf_books = $query->paginate(9);

        // Fetch all categories for the filter sidebar
        $categories = PdfBookCategory::withCount(['pdfBooks'])->get();

        // Get purchased book IDs if logged in
        $purchasedBookIds = [];
        if (Auth::check()) {
            $purchasedBookIds = PdfBookOrder::where('user_id', Auth::id())
                ->where('payment_status', 'Completed')
                ->pluck('pdf_book_id')
                ->toArray();
        }

        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontend.pages.pdf_books.pdf_book_filter_list', compact('pdf_books', 'purchasedBookIds'))->render(),
                'topfilter' => view('frontend.pages.pdf_books.pdf_book_topfilter', compact('pdf_books'))->render(),
            ]);
        }

        return view('frontend.pages.pdf_books.pdf_books', compact('pdf_books', 'categories', 'purchasedBookIds'));
    }

    public function pdfBookCategory($slug)
    {
        $category = PdfBookCategory::where('slug', $slug)->firstOrFail();
        $pdf_books = PdfBook::where('pdf_book_category_id', $category->id)->latest()->paginate(9);
        $categories = PdfBookCategory::withCount(['pdfBooks'])->get();

        // Get purchased book IDs if logged in
        $purchasedBookIds = [];
        if (Auth::check()) {
            $purchasedBookIds = PdfBookOrder::where('user_id', Auth::id())
                ->where('payment_status', 'Completed')
                ->pluck('pdf_book_id')
                ->toArray();
        }

        return view('frontend.pages.pdf_books.categories.category_pdf_books', compact('pdf_books', 'categories', 'category', 'purchasedBookIds'));
    }

    public function pdfBookSubcategory($slug)
    {
        $subcategory = PdfBookSubcategory::where('slug', $slug)->firstOrFail();
        $pdf_books = PdfBook::where('pdf_book_subcategory_id', $subcategory->id)->latest()->paginate(9);
        $categories = PdfBookCategory::withCount(['pdfBooks'])->get();

        // Get purchased book IDs if logged in
        $purchasedBookIds = [];
        if (Auth::check()) {
            $purchasedBookIds = PdfBookOrder::where('user_id', Auth::id())
                ->where('payment_status', 'Completed')
                ->pluck('pdf_book_id')
                ->toArray();
        }

        return view('frontend.pages.pdf_books.categories.subcategory_pdf_books', compact('pdf_books', 'categories', 'subcategory', 'purchasedBookIds'));
    }

    public function pdfBookDetails($id)
    {
        $bookInfo = PdfBook::with(['pdfBookCategory', 'pdfBookSubcategory'])->where('is_active', 1)->findOrFail($id);
        $relatedBooks = PdfBook::where('pdf_book_category_id', $bookInfo->pdf_book_category_id)
                            ->where('id', '!=', $id)
                            ->take(5)
                            ->get();

        $isLoggedIn = Auth::check();
        $isPurchased = false;

        if ($isLoggedIn) {
            /** @var User $user */
            $user = Auth::user();
            $isPurchased = $user->isPurchasedPdfBook($id);
        }

        return view('frontend.pages.pdf_books.pdf_book_details', compact('bookInfo', 'relatedBooks', 'isLoggedIn', 'isPurchased'));
    }
}
