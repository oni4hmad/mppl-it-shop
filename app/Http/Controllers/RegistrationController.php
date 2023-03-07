<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function create() {
        return view('auth.register');
    }

    public function store(Request $request) {

        $this->validate($request, [
            "email" => ["required", "email:dns", "unique:users"],
            "password" => ["required", "min:6", "confirmed"],
            "nomor_hp" => ["required", "numeric"],
            "nama" => ["required"],
            "kota" => ["required"],
            "kode_pos" => ["required", "numeric"],
            "alamat" => ["required"]
        ]);

        User::create(\request(['email', 'password', 'nomor_hp', 'nama', 'kota', 'kode_pos', 'alamat']));

        return view('auth.register')
            ->with('registration_success', true);
    }
}
