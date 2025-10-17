<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CartService;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;

class BuyNowButton extends Component
{
    public $productId;
    public $productName;
    public $price;

    public function mount($productId, $productName = null, $price = null)
    {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->price = $price;
    }

    public function buyNow()
    {
        try {
            // Validate that the product exists
            $product = Product::findOrFail($this->productId);
            
            // Add product to cart
            $cartService = new CartService();
            $cartService->add($this->productId, 1);
            
            // Redirect to checkout page
            return redirect()->route('checkout.index');
        } catch (\Exception $e) {
            $this->dispatch('error', 'Failed to add product to cart: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.buy-now-button');
    }
}