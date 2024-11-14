<link rel="stylesheet" href="{{ asset('css/banner.css') }}">

<div class="container">
    <h1>Chỉnh sửa Banner</h1>
    <form action="{{ route('banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" name="title" id="title" value="{{ $banner->title }}" required>
        </div>

        <div class="form-group">
            <label for="image">Hình ảnh</label>
            <input type="file" name="image" id="image">
            <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}" class="banner-preview">
        </div>

        <div class="form-group">
            <label for="is_active">
                <input type="checkbox" name="is_active" id="is_active" {{ $banner->is_active ? 'checked' : '' }}> Hoạt động
            </label>
        </div>

        <button type="submit" class="btn">Cập nhật</button>
    </form>
</div>
