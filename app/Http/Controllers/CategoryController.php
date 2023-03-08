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

        $file = $request->file('photo');
        $extension = $file->getClientOriginalExtension();
        $filename = 'category_'.time().'_'.Str::random(5).'.'.$extension;
        $file->move(public_path('photo/category/'), $filename);

        $category = new Category();
        $category->nama = $request->nama;
        $category->photo = $filename;
        $category->save();

        return redirect()
            ->back()
            ->with(['success' => "Kategori berhasil ditambahkan."]);
    }
}
