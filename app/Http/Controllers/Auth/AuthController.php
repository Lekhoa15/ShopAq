<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    protected $authService;

 public function __construct(AuthService $authService)
{
    $this->authService = $authService;
}


    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('login.up');
    }

    public function register(RegisterRequest $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->withErrors(['email' => 'Email này đã được sử dụng.'])->withInput();
        }
        // Sử dụng AuthService để đăng ký người dùng
        $user = $this->authService->registerUser($request->validated());

        // Gửi email xác thực
        $user->sendEmailVerificationNotification();

        // Chuyển hướng đến trang đăng ký với thông báo thành công
        return redirect()->route('register')->with('success', 'Đăng ký thành công! Vui lòng kiểm tra email của bạn để xác thực.');
    }


    // Hiển thị form quên mật khẩu
    public function showForgotPasswordForm()
    {
        return view('login.forgot_passE');
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $this->authService->forgotPassword($request->validated());
        return back()->with('status', 'Link đặt lại mật khẩu đã được gửi');
    }
}
