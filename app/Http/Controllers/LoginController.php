<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $this->validate($request, [
            "email" => ["required", "email:dns"],
            "password" => ["required"],
        ]);

        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return redirect('/login')
                ->with(['error' => 'Login gagal.']);
        }
        return redirect('/');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
