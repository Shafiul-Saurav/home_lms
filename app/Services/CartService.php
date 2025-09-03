<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected $sessionId;

    public function __construct()
    {
        $this->sessionId = Session::getId();
    }

    /**
     * Add product to cart
     */
    public function add($productId, $quantity = 1)
    {
        $product = Product::findOrFail($productId);
        
        // Check if product already in cart
        $cartItem = Cart::where('session_id', $this->sessionId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // Update quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Create new cart item
            Cart::create([
                'session_id' => $this->sessionId,
                'product_id' => $productId,
                'product_name' => $product->name,
                'price' => $product->sale_price,
                'quantity' => $quantity
            ]);
        }

        return $this->getCart();
    }

    /**
     * Remove item from cart
     */
    public function remove($cartId)
    {
        Cart::where('session_id', $this->sessionId)
            ->where('id', $cartId)
            ->delete();

        return $this->getCart();
    }

    /**
     * Update item quantity
     */
    public function update($cartId, $quantity)
    {
        if ($quantity <= 0) {
            return $this->remove($cartId);
        }

        Cart::where('session_id', $this->sessionId)
            ->where('id', $cartId)
            ->update(['quantity' => $quantity]);

        return $this->getCart();
    }

    /**
     * Get all cart items
     */
    public function getCart()
    {
        return Cart::where('session_id', $this->sessionId)
                   ->with('product.productImages')
                   ->get();
    }

    /**
     * Get cart total
     */
    public function getTotal()
    {
        $cartItems = $this->getCart();
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->price * $item->quantity;
        }

        return $total;
    }

    /**
     * Get cart item count
     */
    public function getCount()
    {
        return Cart::where('session_id', $this->sessionId)->sum('quantity');
    }

    /**
     * Clear cart
     */
    public function clear()
    {
        Cart::where('session_id', $this->sessionId)->delete();
    }
}