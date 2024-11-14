<?php

namespace App\Services\Banner;

use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerService
{
    public function getAllBanners()
    {
        return Banner::all();
    }

    public function createBanner(array $data)
    {
        if (isset($data['image'])) {
            $data['image_path'] = $data['image']->store('banners', 'public');
        }

        return Banner::create([
            'title' => $data['title'],
            'image_path' => $data['image_path'],
            'is_active' => $data['is_active'] ?? false,
        ]);
    }

    public function updateBanner(Banner $banner, array $data)
    {
        if (isset($data['image'])) {

            if ($banner->image_path) {
                Storage::disk('public')->delete($banner->image_path);
            }
            $data['image_path'] = $data['image']->store('banners', 'public');
            $banner->image_path = $data['image_path'];
        }

        $banner->title = $data['title'];
        $banner->is_active = $data['is_active'] ?? false;
        $banner->save();

        return $banner;
    }

    public function deleteBanner(Banner $banner)
    {
        if ($banner->image_path) {
            Storage::disk('public')->delete($banner->image_path);
        }

        return $banner->delete();
    }
    public function getActiveBanners()
    {
        return Banner::where('is_active', true)->get();
    }
}
