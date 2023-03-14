<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            "nama" => ["required", "unique:categories"],
            "photo" => ["required", "image", "max:1024", "mimes:jpeg,png,jpg"],
        ]);

        $category = new Category();
        $category->nama = $request->nama;
        $photoPath = $request
            ->file('photo')
            ->store('photo/category', 'public_direct');
        $category->save();
        $category->photo()->updateOrCreate([], ['path' => $photoPath]);
        return redirect()
            ->back()
            ->with(['success' => "Kategori berhasil ditambahkan."]);
    }
}
