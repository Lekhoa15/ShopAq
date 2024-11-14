<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'message' => 'required|string',
            'subject' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên của bạn.',
            'name.string' => 'Tên chỉ có thể chứa các ký tự chữ.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',

            'email.required' => 'Vui lòng nhập email của bạn.',
            'email.email' => 'Định dạng email không hợp lệ.',

            'phone.string' => 'Số điện thoại phải là chuỗi ký tự hợp lệ.',

            'message.required' => 'Vui lòng nhập nội dung tin nhắn.',
            'message.string' => 'Nội dung tin nhắn phải là chuỗi ký tự hợp lệ.',

            'subject.string' => 'Chủ đề phải là chuỗi ký tự hợp lệ.',
            'subject.max' => 'Chủ đề không được vượt quá 255 ký tự.',
        ];
    }
}
