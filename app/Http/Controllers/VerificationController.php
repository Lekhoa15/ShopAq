<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Kiểm tra hash email
        if (!hash_equals((string) $request->hash, sha1($user->email))) {
            return redirect()->route('login')->with('error', 'Email xác thực không hợp lệ.');
        }

        // Xác thực email
        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('login')->with('success', 'Email xác thực thành công! Bạn có thể đăng nhập.');
    }
}
