<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProductsForUser(Auth::user());
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $this->productService->storeProduct($request->validated());
        session()->flash('success', 'Sản phẩm đã được thêm thành công!');
        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {

        $product = Product::findOrFail($id);


        return view('products.edit', compact('product'));
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productService->updateProduct($product, $request->validated());
        session()->flash('success', 'Sản phẩm đã được cập nhật thành công!');
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);
        session()->flash('success', 'Sản phẩm đã được xóa thành công!');
        return redirect()->route('products.index');
    }
}
