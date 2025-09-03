<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartService
{
    private $sessionKey = 'cart_items';

    /**
     * Add product to cart
     */
    public function add($productId, $quantity = 1)
    {
        $product = Product::findOrFail($productId);
        
        // Get current cart items
        $cartItems = $this->getCart();
        
        // Check if product already in cart
        $existingItemKey = null;
        foreach ($cartItems as $key => $item) {
            if ($item['product_id'] == $productId) {
                $existingItemKey = $key;
                break;
            }
        }

        if ($existingItemKey !== null) {
            // Update quantity
            $cartItems[$existingItemKey]['quantity'] += $quantity;
        } else {
            // Create new cart item
            $cartItems[] = [
                'id' => Str::uuid()->toString(), // Generate a unique ID for the cart item
                'product_id' => $productId,
                'product_name' => $product->name,
                'price' => $product->sale_price,
                'quantity' => $quantity
            ];
        }

        // Save cart items to session
        Session::put($this->sessionKey, $cartItems);

        return $cartItems;
    }

    /**
     * Remove item from cart
     */
    public function remove($cartId)
    {
        $cartItems = $this->getCart();
        
        // Filter out the item with the given ID
        $cartItems = array_filter($cartItems, function($item) use ($cartId) {
            return $item['id'] != $cartId;
        });
        
        // Re-index array
        $cartItems = array_values($cartItems);

        // Save cart items to session
        Session::put($this->sessionKey, $cartItems);

        return $cartItems;
    }

    /**
     * Update item quantity
     */
    public function update($cartId, $quantity)
    {
        if ($quantity <= 0) {
            return $this->remove($cartId);
        }

        $cartItems = $this->getCart();
        
        // Find and update the item with the given ID
        foreach ($cartItems as &$item) {
            if ($item['id'] == $cartId) {
                $item['quantity'] = $quantity;
                break;
            }
        }

        // Save cart items to session
        Session::put($this->sessionKey, $cartItems);

        return $cartItems;
    }

    /**
     * Get all cart items
     */
    public function getCart()
    {
        return Session::get($this->sessionKey, []);
    }

    /**
     * Get cart total
     */
    public function getTotal()
    {
        $cartItems = $this->getCart();
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }

    /**
     * Get cart item count
     */
    public function getCount()
    {
        $cartItems = $this->getCart();
        $count = 0;

        foreach ($cartItems as $item) {
            $count += $item['quantity'];
        }

        return $count;
    }

    /**
     * Clear cart
     */
    public function clear()
    {
        Session::forget($this->sessionKey);
    }
}