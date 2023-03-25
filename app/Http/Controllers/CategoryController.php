<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.manage-category')
            ->with('categories', Category::all());
    }

    public function store(Request $request)
    {
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

    public function update(Category $category, Request $request)
    {
        // Check if name is unique, but ignore the current category record
        $this->validate($request, [
            "nama" => ["required", Rule::unique('categories')->ignore($category)],
            "photo" => ["image", "max:1024", "mimes:jpeg,png,jpg"],
        ]);

        // delete + updateOrCreate
        if ($request->hasFile('photo')) {
            $oldPhotoPath = $category->photo ? $category->photo->path : null;
            $photoPath = $request->file('photo')->store('photo/category', 'public_direct');
            $category->photo()->updateOrCreate([], ['path' => $photoPath]);
            if ($oldPhotoPath && Storage::disk('public_direct')->exists($oldPhotoPath)) {
                Storage::disk('public_direct')->delete($oldPhotoPath);
            }
        }

        $category->update(['nama' => $request->nama]);

        return redirect()
            ->back()
            ->with(['success' => "Kategori berhasil diperbarui."]);
    }

    public function delete(Category $category)
    {
        // delete category photo
        $categoryPhoto = $category->photo;
        if (isset($categoryPhoto) && File::exists($categoryPhoto->path)) {
            $destination = $categoryPhoto->path;
            File::delete($destination);
        }
        $category->photo()->delete();
        // delete category
        $category->delete();

        return redirect()
            ->back()
            ->with(['success' => "Kategori berhasil dihapus."]);
    }
}
