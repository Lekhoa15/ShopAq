<!-- resources/views/products/edit.blade.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản Phẩm</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>

<body>
    <a href="{{ route('home') }}" class="btn btn-secondary">Quay lại Trang Chủ</a>

    <div class="container">
        <h2>Sửa Sản Phẩm</h2>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
            </div>
            <div class="form-group">
                <label for="image">Ảnh sản phẩm :</label>
                <div id="image-preview">
                    <img src="{{ asset('images/' . $product->image_path) }}" alt="Current Image" style="max-width: 150px;">
                </div>
                <input type="file" name="image" id="image" class="form-control-file" onchange="previewImage(event)">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
        </form>
    </div>
    <script>
        function previewImage(event) {
        const imagePreview = document.getElementById('image-preview');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" alt="New Image" style="max-width: 150px;">`;
            };
            reader.readAsDataURL(file);
        }
    }
    </script>
</body>

</html>
