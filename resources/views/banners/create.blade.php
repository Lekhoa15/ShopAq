<link rel="stylesheet" href="{{ asset('css/banner.css') }}">

<div class="container">
    <h1>Thêm Banner</h1>
    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div class="form-group">
            <label for="image">Hình ảnh</label>
            <input type="file" name="image" id="image" required>
        </div>

        <div class="form-group">
            <label for="is_active">
                <input type="checkbox" name="is_active" id="is_active" checked> Hoạt động
            </label>
        </div>

        <button type="submit" class="btn">Lưu</button>
    </form>
</div>
