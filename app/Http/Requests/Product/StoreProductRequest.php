<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:public,draft',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm.',
            'description.required' => 'Vui lòng nhập mô tả sản phẩm.',
            'price.required' => 'Vui lòng nhập giá sản phẩm.',
            'status.required' => 'Vui lòng chọn trạng thái sản phẩm.',
            'image.image' => 'Tệp tải lên phải là một hình ảnh.',
        ];
    }
}
