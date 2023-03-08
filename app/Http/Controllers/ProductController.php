<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function store(Request $request) {

        $this->validate($request, [
            "nama" => ["required"],
            "category_id" => ["required", "numeric"],
            "harga" => ["required", "numeric"],
            "stok" => ["required", "numeric"],
            "berat" => ["required", "numeric"],
            "deskripsi" => ["required"],
            "photo_1" => ["required", "image", "max:1024", "mimes:jpeg,png,jpg"],
            "photo_2" => ["nullable", "image", "max:1024", "mimes:jpeg,png,jpg"],
            "photo_3" => ["nullable", "image", "max:1024", "mimes:jpeg,png,jpg"],
            "photo_4" => ["nullable", "image", "max:1024", "mimes:jpeg,png,jpg"],
        ]);

        $product = new Product();
        if (isset($request->photo_1)) {
            $product->photo_1 = $this->storeImage($request, 'photo_1');
        }
        if (isset($request->photo_2)) {
            $product->photo_2 = $this->storeImage($request, 'photo_2');
        }
        if (isset($request->photo_3)) {
            $product->photo_3 = $this->storeImage($request, 'photo_3');
        }
        if (isset($request->photo_4)) {
            $product->photo_4 = $this->storeImage($request, 'photo_4');
        }
        $product->nama = $request->nama;
        $product->category_id = $request->category_id;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->berat = $request->berat;
        $product->deskripsi = $request->deskripsi;
        $product->save();

        return redirect()
            ->back()
            ->with(['success' => "Produk berhasil ditambahkan."]);
    }

    private function storeImage(Request $request, $photoColumn) {
        $file = $request->file($photoColumn);
        $extension = $file->getClientOriginalExtension();
        $filename = 'product_'.time().'_'.$photoColumn.'_'.Str::random(5).'.'.$extension;
        $file->move(public_path('photo/product/'), $filename);
        return $filename;
    }

    public function update(Request $request) {

    }

    private function updateImage(Request $request, $photoColumn) {

    }

    public function delete(Request $request) {

    }
}
