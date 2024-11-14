<?php

namespace App\Services\Cart;

use App\Models\Product;

class CartService
{
    public function getCart()
    {
        return session()->get('cart', []);
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => 1,
                "image" => $product->image_path
            ];
        }

        session()->put('cart', $cart);

        return count($cart);
    }

    public function updateCartItem($productId, $quantity)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
        return $cart;
    }

    public function removeCartItem($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
    }

    public function getCartCount()
    {
        return count(session()->get('cart', []));
    }
}
