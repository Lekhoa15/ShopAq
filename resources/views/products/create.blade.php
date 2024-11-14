<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>

<body>
    <a href="{{ route('home') }}" class="btn btn-secondary">Quay lại Trang Chủ</a>


    <div class="container">
        <h2>Thêm Sản Phẩm</h2>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <label for="image">Ảnh:</label>
            <input type="file" name="image" id="image" onchange="previewImage(event)">
            <div id="image-preview">
            </div>
            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select name="status" id="status" class="form-control">
                    <option value="draft">Nháp</option>
                    <option value="public">Công khai</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-preview');
                output.innerHTML = `<img src="${reader.result}" alt="Ảnh mới" width="100">`;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>


</body>

</html>
