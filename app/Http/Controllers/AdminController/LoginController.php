<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],
        [
            'required' => 'Trường này không được bỏ trống!',
            'email' => 'Không đúng định dạng emal!'
        ]);

        $checkLogin = Auth::guard('admin')->attempt($request->only('email', 'password'));
        if($checkLogin){
            $href = route('dashboard.index');
            return response()->json([
                'success' => ['href' => "$href"]
            ]);
        }else{
            return response()->json([
                'errors' => ['login' => 'Tài khoản hoặc mật khẩu không chính xác!']
            ]);
        }
    }


    

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
