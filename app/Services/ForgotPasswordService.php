<?php
namespace App\Services;

use App\Mail\ResetPasswordCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ForgotPasswordService
{
 public function sendResetCode(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $email = $request->email;
    $user = User::where('email', $email)->first();

    // Tạo mã xác nhận ngẫu nhiên và lưu vào cache với thời gian hết hạn
    $resetCode = rand(100000, 999999);
    Cache::put('reset_code_' . $email, $resetCode, now()->addMinutes(10));

    // Gửi email mã xác nhận
    Mail::to($user->email)->send(new \App\Mail\ResetPasswordCode($resetCode));

    // Gửi thông báo và chuyển hướng
    return redirect()->route('password.reset.form')
                     ->with('message', 'Mã xác nhận đã được gửi qua email.');
}


public function resetPassword($data)
{
    $resetCode = (string) Cache::get('reset_code_' . $data['email']);
    Log::info('Reset code from cache:', ['reset_code' => $resetCode]);

    // Lấy mã xác nhận do người dùng cung cấp và ép kiểu thành string
    $userProvidedCode = (string) $data['verification_code'];
    Log::info('User provided verification code:', ['verification_code' => $userProvidedCode]);

    // So sánh mã xác nhận sau khi đã ép kiểu
    if ($resetCode !== $userProvidedCode) {
        Log::warning('Verification code does not match');
        return ['error' => 'Mã xác nhận không chính xác hoặc đã hết hạn.'];
    }

    // Tìm user theo email
    $user = User::where('email', $data['email'])->first();
    Log::info('User found:', ['user' => $user]);

    if (!$user) {
        Log::warning('User not found for the provided email.');
        return ['error' => 'Người dùng không tồn tại.'];
    }

    // Cập nhật mật khẩu mới và thời gian thay đổi mật khẩu
    $user->password = Hash::make($data['new_password']);
    $user->password_changed_at = Carbon::now();
    Log::info('New password hash:', ['password' => $user->password]);
    $user->save();

    // Kiểm tra xem có lỗi trong quá trình lưu mật khẩu hay không
    if (!$user->wasChanged('password')) {
        Log::warning('Password was not updated in the database.');
        return ['error' => 'Không thể đổi mật khẩu, vui lòng thử lại.'];
    }

    // Xóa mã xác nhận khỏi cache sau khi sử dụng
    Cache::forget('reset_code_' . $data['email']);
    Log::info('Reset code cleared from cache for email:', ['email' => $data['email']]);

    // Trả về thông điệp thành công
    return ['message' => 'Đổi mật khẩu thành công.'];
}


}
