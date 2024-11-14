<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\StoreBannerRequest;
use App\Http\Requests\Banner\UpdateBannerRequest;
use App\Models\Banner;
use App\Services\Banner\BannerService;

class BannerController extends Controller
{
    protected $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index()
    {
        $banners = $this->bannerService->getAllBanners();
        return view('banners.index', compact('banners'));
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(StoreBannerRequest $request)
    {
        $this->bannerService->createBanner($request->validated());
        return redirect()->route('banners.index')->with('success', 'Banner đã được tạo thành công!');
    }

    public function edit(Banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $this->bannerService->updateBanner($banner, $request->validated());
        return redirect()->route('banners.index')->with('success', 'Banner đã được cập nhật thành công!');
    }

    public function destroy(Banner $banner)
    {
        $this->bannerService->deleteBanner($banner);
        return redirect()->route('banners.index')->with('success', 'Banner đã được xóa thành công!');
    }
}
