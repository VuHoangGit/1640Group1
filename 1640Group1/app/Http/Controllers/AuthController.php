<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Gọi Model User
use Illuminate\Support\Facades\Hash; // Gọi thư viện mã hóa mật khẩu

class AuthController extends Controller
{
    public function showSignUpForm()
    {
        return view('signup');
    }

public function register(Request $request)
    {
        // 1. Kiểm tra dữ liệu (Validation)
        $validatedData = $request->validate([
            'username' => 'required|string|min:3|max:255',
            'phone'    => 'required|string|max:15',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:Staff,QACoordinator,QAManagement'
        ]);

        // 2. Lưu vào Database
        User::create([
            'username'     => $validatedData['username'],
            'phone'        => $validatedData['phone'],
            'email'        => $validatedData['email'],
            'passwordHash' => Hash::make($validatedData['password']),
            'role'         => $validatedData['role'],
        ]);

            // 3. TỰ ĐỘNG CHUYỂN HƯỚNG VỀ TRANG LOGIN
            // Hàm with() giúp mang theo một lời nhắn ngầm để hiển thị bên trang đăng nhập
            return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công! Vui lòng đăng nhập.');
        }
    }
