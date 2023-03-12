<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            "nama" => ["required"],
            "category_id" => ["required", "exists:categories,id"],
            "harga" => ["required", "numeric", "min:0"],
            "stok" => ["required", "numeric", "min:0"],
            "berat" => ["required", "numeric", "min:0"],
            "deskripsi" => ["required"],
            "photo_1" => ["required", "image", "max:1024", "mimes:jpeg,png,jpg"],
            "photo_2" => ["nullable", "image", "max:1024", "mimes:jpeg,png,jpg"],
            "photo_3" => ["nullable", "image", "max:1024", "mimes:jpeg,png,jpg"],
            "photo_4" => ["nullable", "image", "max:1024", "mimes:jpeg,png,jpg"],
        ]);
        $product = new Product();
        $this->checkAndExecuteImage(array($this, 'storeImage'), $product, $request);
        $this->saveProduct($product, $request);
        return redirect()
            ->back()
            ->with(['success' => "Produk berhasil ditambahkan."]);
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            "id" => ["required", "exists:products,id"],
            "nama" => ["required"],
            "category_id" => ["required", "exists:categories,id"],
            "harga" => ["required", "numeric", "min:0"],
            "stok" => ["required", "numeric", "min:0"],
            "berat" => ["required", "numeric", "min:0"],
            "deskripsi" => ["required"],
            "photo_1" => ["nullable", "image", "max:1024", "mimes:jpeg,png,jpg"],
            "photo_2" => ["nullable", "image", "max:1024", "mimes:jpeg,png,jpg"],
            "photo_3" => ["nullable", "image", "max:1024", "mimes:jpeg,png,jpg"],
            "photo_4" => ["nullable", "image", "max:1024", "mimes:jpeg,png,jpg"],
        ]);
        $product = Product::find($request->id);
        if (!isset($product)) {
            return redirect()
                ->back()
                ->with(['error' => "Produk tidak ditemukan."]);
        }
        $this->checkAndExecuteImage(array($this, 'updateImage'), $product, $request);
        $this->saveProduct($product, $request);
        return redirect()
            ->back()
            ->with(['success' => "Produk berhasil diupdate."]);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (!isset($product)) {
            return redirect()
                ->back()
                ->with(['error' => "Produk tidak ditemukan."]);
        }
        $this->checkAndExecuteImage(array($this, 'deleteImage'), $product);
        $product->delete();
        return redirect()
            ->back()
            ->with(['success' => "Produk berhasil dihapus."]);
    }

    private function checkAndExecuteImage($callbackExecute, $product, Request $request = null) {
        if (isset($request->photo_1) || $callbackExecute[1] == "deleteImage") {
            $product->photo_1 = $callbackExecute([
                "request" => $request, "product" => $product, "photoColumn" => "photo_1"]);
        }
        if (isset($request->photo_2) || $callbackExecute[1] == "deleteImage") {
            $product->photo_2 = $callbackExecute([
                "request" => $request, "product" => $product, "photoColumn" => "photo_2"]);
        }
        if (isset($request->photo_3) || $callbackExecute[1] == "deleteImage") {
            $product->photo_3 = $callbackExecute([
                "request" => $request, "product" => $product, "photoColumn" => "photo_3"]);
        }
        if (isset($request->photo_4) || $callbackExecute[1] == "deleteImage") {
            $product->photo_4 = $callbackExecute([
                "request" => $request, "product" => $product, "photoColumn" => "photo_4"]);
        }
    }

    private function storeImage(array $args)
    {
        return $args["request"]->file($args["photoColumn"])->store('photo/product', 'public_direct');;
    }

    private function updateImage(array $args)
    {
        $this->deleteImage($args);
        return $args["request"]->file($args["photoColumn"])->store('photo/product', 'public_direct');
    }

    private function deleteImage(array $args)
    {
        $destination = $args["product"][$args["photoColumn"]];
        if (File::exists($destination)) {
            File::delete($destination);
        }
    }

    private function saveProduct($product, $request)
    {
        $product->nama = $request->nama;
        $product->category_id = $request->category_id;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->berat = $request->berat;
        $product->deskripsi = $request->deskripsi;
        $product->save();
    }

}
