<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Hiển thị form đăng nhập
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        return view('login.login');
    }

    /**
     * Xử lý đăng nhập
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */public function login(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:6'
    ]);

    $remember = $request->has('remember');

    $result = $this->authService->login($validated, $remember);

    if (!$result['success']) {
        return redirect()->back()->withErrors(['email' => $result['message']])->withInput();
    }

    return redirect()->route('home')->with('status', $result['message']);
}


    /**
     * Đăng xuất người dùng
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('status', 'Đăng xuất thành công');
    }
}
