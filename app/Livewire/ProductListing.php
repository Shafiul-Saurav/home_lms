<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class ProductListing extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    // Add a unique key to prevent conflicts
    public function getListeners()
    {
        return [
            'refreshProductListing' => '$refresh',
        ];
    }

    public function render()
    {
        $products = Product::where('is_stock', 1)
            ->latest('id')
            ->paginate(12);

        return view('livewire.product-listing', [
            'products' => $products,
        ])->extends('frontend.layouts.master');
    }
}
