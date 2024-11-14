<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Services\Cart\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        return view('cart.index', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $cartCount = $this->cartService->addToCart($request->id);

        return response()->json([
            'success' => 'Đã thêm vào giỏ hàng',
            'cartCount' => $cartCount
        ]);
    }

    public function update(Request $request)
    {
        $cart = $this->cartService->updateCartItem($request->id, $request->quantity);

        return response()->json([
            'success' => 'Đã cập nhật giỏ hàng',
            'cart' => $cart
        ]);
    }

    public function getCartCount()
    {
        $cartCount = $this->cartService->getCartCount();
        return response()->json(['cart_count' => $cartCount]);
    }

    public function remove(Request $request)
    {
        $this->cartService->removeCartItem($request->id);

        return response()->json(['success' => 'Sản phẩm đã được xóa khỏi giỏ hàng']);
    }
}
