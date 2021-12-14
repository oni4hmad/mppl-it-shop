<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;


class UpdateProfileInformationController extends Controller
{
    public function edit()
    {
        return view('account-settings');
    }

    public function updateName(Request $request)
    {
        auth()->user()->update(['name' => $request->name]);
        return back()->with('name_updated', 'Nama berhasil diubah');
    }
    public function updateEmail(Request $request)
    {
        auth()->user()->update(['email' => $request->email]);
        return back()->with('email_updated', 'Email Berhasil diubah, silahkan cek untuk melakukan verifikasi');
    }
    public function updateNoHp(Request $request)
    {
        auth()->user()->update(['no_hp' => $request->no_hp]);
        return back()->with('no_hp_updated', 'Nomor Hp berhasil diubah');
    }
    public function updateAlamat(Request $request)
    {
        auth()->user()->update([
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'alamat' => $request->alamat,
        ]);
        return back()->with('alamat_updated', 'alamat berhasil diubah');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        if(Hash::check($request->current_password, auth()->user()->password))
        {
            auth()->user()->update(['password' => Hash::make($request->password)]);
            return back()->with('password_updated', 'Password Berhasil diubah');
        }
        return back()->with('password_wrong', 'Password salah');
    }
    public function updateImage(Request $request)
    {
        if($request->hasFile('profile_pic'))
        {
            $destination = public_path('profile_pic').auth()->user()->profile_pic;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('profile_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move(public_path('profile_pic'),$filename);
            auth()->user()->profile_pic = $filename;
            auth()->user()->update();
        }
        return back()->with('image_updated', 'Gambar profile berhasil diubah');
    }
}
