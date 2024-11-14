<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{

    public function getAllProductsForUser($user)
    {
        if ($user && $user->role === 'admin') {
            return Product::orderBy('created_at', 'desc')->get();
        }
        return Product::where('status', 'public')->orderBy('created_at', 'desc')->get();
    }

    public function storeProduct(array $data)
    {
        if (isset($data['image'])) {
            // Save image to storage
            $data['image_path'] = $data['image']->store('images', 'public');
        }

        unset($data['image']);
        return Product::create($data);
    }

    public function updateProduct($product, array $data)
    {
        if (isset($data['image'])) {
            // Save new image to storage
            $data['image_path'] = $data['image']->store('images', 'public');
            Storage::disk('public')->delete($product->image_path); // Delete the old image
        }

        unset($data['image']);
        $product->update($data);


        return $product;
    }


    public function deleteProduct($product)
    {
        Storage::disk('public')->delete($product->image_path); // Delete the image
        return $product->delete();
    }
    public function getProductsByRole($role, $page = 1)
    {
        $query = Product::orderBy('created_at', 'desc');

        if ($role !== 'admin') {
            $query->where('status', 'public');
        }

        return $query->paginate(8, ['*'], 'page', $page);
    }
}
