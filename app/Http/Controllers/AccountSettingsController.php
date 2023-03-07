<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountSettingsController extends Controller
{
    public function edit() {
        return view('account-settings');
    }

    public function update(Request $request) {
        if (isset($request->nama)) {
            $this->validate($request, [
                "nama" => ["required"],
            ]);
            auth()->user()->update(['nama' => $request->nama]);
            return $this->updateSuccess("Nama");
        }

        if (isset($request->email)) {
            $this->validate($request, [
                "email" => ["required", "email:dns", "unique:users"],
            ]);
            auth()->user()->update(['email' => $request->email]);
            return $this->updateSuccess("Email");
        }

        if (isset($request->nomor_hp)) {
            $this->validate($request, [
                "nomor_hp" => ["required", "numeric"],
            ]);
            auth()->user()->update(['nomor_hp' => $request->nomor_hp]);
            return $this->updateSuccess("Nomor HP");
        }

        if (isset($request->alamat)) {
            $this->validate($request, [
                "kota" => ["required"],
                "alamat" => ["required"],
                "kode_pos" => ["required", "numeric"],
            ]);
            auth()->user()->update(['alamat' => $request->alamat]);
            auth()->user()->update(['kota' => $request->kota]);
            auth()->user()->update(['kode_pos' => $request->kode_pos]);
            return $this->updateSuccess("Alamat");
        }

        if (isset($request->password)) {
            $this->validate($request, [
                "password_current" => ["required", "min:6"],
                "password" => ["required", "min:6", "confirmed"],
            ]);
            if (!Hash::check($request->password_current, auth()->user()->password)) {
                return $this->updateFailed("Password lama yang anda masukkan salah.");
            }
            auth()->user()->update(['password' => $request->password]);
            return $this->updateSuccess("Password");
        }
    }

    private function updateSuccess(string $dataName) {
        return redirect()
            ->back()
            ->with(['success' => $dataName." berhasil diubah."]);
    }

    private function updateFailed(string $message) {
        return redirect()
            ->back()
            ->with(['error' => $message]);
    }
}
