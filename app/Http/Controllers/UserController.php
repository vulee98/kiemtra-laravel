<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getLogin(){
        return view('admin.login');
    }

    public function postLogin(Request $req)
    {
        // Validate the incoming request data
        $validatedData = $req->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20'
            ],
            [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Không đúng định dạng email',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự',
                'password.max' => 'Mật khẩu không quá 20 ký tự'
            ]
        );

        $credentials = $req->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('admin/category/danhsach')->with(['flag' => 'success', 'message' => 'Đăng nhập thành công']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công']);
        }
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.getLogin');
    }
}
