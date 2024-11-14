<?php

namespace App\Http\Controllers;

use App\Services\Banner\BannerService;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $bannerService;
    protected $productService;

    public function __construct(BannerService $bannerService, ProductService $productService)
    {
        $this->bannerService = $bannerService;
        $this->productService = $productService;
    }

    public function index()
    {
 
        $banners = $this->bannerService->getActiveBanners();


        $userRole = auth()->check() ? auth()->user()->role : null;
        $products = $this->productService->getProductsByRole($userRole);

        return view('shop.index', compact('products', 'banners'));
    }

    public function loadMoreProducts($page)
    {
        $products = $this->productService->getProductsByRole('public', $page);

        return response()->json($products);
    }
}
