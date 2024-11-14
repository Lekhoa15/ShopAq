<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
class AuthService
{
    /**
     * Xử lý đăng nhập
     *
     * @param array $credentials
     * @return array
     */
    public function login(array $credentials, $remember = false)
{
    // Kiểm tra email
    $user = User::where('email', $credentials['email'])->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        return ['success' => false, 'message' => 'Email hoặc mật khẩu không đúng'];
    }

    // Kiểm tra trạng thái người dùng
    if (!$user->active) {
        return ['success' => false, 'message' => 'Tài khoản bị khóa'];
    }

    // Đăng nhập thành công
    Auth::login($user, $remember); // Truyền thêm tham số $remember vào

    $user->update([
        'last_login_at' => now(),
        'last_login_ip' => request()->ip()
    ]);

    return [
        'success' => true,
        'message' => 'Đăng nhập thành công',
        'user' => $user
    ];
}

    public function registerUser(array $data)
    {
        // Tạo người dùng mới
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        Log::info($data);
        // Gửi email xác thực
        Mail::to($user->email)->send(new VerifyEmail($user));

        return $user;
    }
    public function forgotPassword(array $data)
    {
        Password::sendResetLink($data);
    }
}

