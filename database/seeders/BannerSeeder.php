<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run()
    {
        Banner::create([
            'title' => 'Banner 1',
            'image_path' => 'images/banners/banner1.jpg',
            'is_active' => true,
        ]);

        Banner::create([
            'title' => 'Banner 2',
            'image_path' => 'images/banners/banner2.jpg',
            'is_active' => true,
        ]);
    }
}
