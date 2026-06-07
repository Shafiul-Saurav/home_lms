<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookSubcategory;
use App\Models\LogoFavicon;
use App\Models\WebsiteLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PhysicalBookController extends Controller
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

    public function books(Request $request)
    {
        $query = Book::with(['bookCategory']);

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
            $query->whereIn('book_category_id', $categoryIds);
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
        $books = $query->paginate(9);

        // Fetch all categories for the filter sidebar
        $categories = BookCategory::withCount(['books'])->get();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontend.pages.books.book_filter_list', compact('books'))->render(),
                'topfilter' => view('frontend.pages.books.book_topfilter', compact('books'))->render(),
            ]);
        }

        return view('frontend.pages.books.books', compact('books', 'categories'));
    }

    public function bookCategory($slug)
    {
        $category = BookCategory::where('slug', $slug)->firstOrFail();
        $books = Book::where('book_category_id', $category->id)->latest()->paginate(9);
        $categories = BookCategory::withCount(['books'])->get();

        return view('frontend.pages.books.categories.category_books', compact('books', 'categories', 'category'));
    }

    public function bookSubcategory($slug)
    {
        $subcategory = BookSubcategory::where('slug', $slug)->firstOrFail();
        $books = Book::where('book_subcategory_id', $subcategory->id)->latest()->paginate(9);
        $categories = BookCategory::withCount(['books'])->get();

        return view('frontend.pages.books.categories.subcategory_books', compact('books', 'categories', 'subcategory'));
    }

    public function bookDetails($id)
    {
        // Fetch book details
        $bookInfo = Book::with(['bookCategory', 'bookSubcategory'])->where('id', $id)->where('is_active', 1)->firstOrFail();

        // Fetch related books
        $relatedBooks = Book::with(['bookCategory'])
                            ->where('id', '!=', $id)
                            ->where('is_active', 1)
                            ->where('book_category_id', $bookInfo->book_category_id)
                            ->limit(4)
                            ->get();

        // Fetch logo/favicon data
        $logo_fav = LogoFavicon::first();

        return view('frontend.pages.books.book_details', compact('bookInfo', 'relatedBooks', 'logo_fav'));
    }
}
