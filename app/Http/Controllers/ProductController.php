<?php

namespace App\Http\Controllers;

use App\Models\Photo;
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
        $this->saveProduct($product, $request);
        $this->checkAndExecuteImage(array($this, 'storeImage'), $product, $request);
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
        Photo::where('photoable_type', Photo::class)
            ->where('photoable_id', $id)
            ->get()->each(function ($photo) {
                $photo->delete();
            });
        $product->delete();
        return redirect()
            ->back()
            ->with(['success' => "Produk berhasil dihapus."]);
    }

    private function checkAndExecuteImage($callbackExecute, $product, Request $request = null) {
        if (isset($request->photo_1) || $callbackExecute[1] == "deleteImage") {
            $photoPath = $callbackExecute(["request" => $request, "product" => $product, "photoColumn" => "photo_1"]);
            if ($callbackExecute[1] != "deleteImage") {
                $photo = Photo::create([
                    'path' => $photoPath,
                    'photoable_id' => $product->id,
                    'photoable_type' => Product::class
                ]);
                $product->photo_id_1 = $photo->id;
            }
        }
        if (isset($request->photo_2) || $callbackExecute[1] == "deleteImage") {
            $photoPath = $callbackExecute(["request" => $request, "product" => $product, "photoColumn" => "photo_2"]);
            if ($callbackExecute[1] != "deleteImage") {
                $photo = Photo::create([
                    'path' => $photoPath,
                    'photoable_id' => $product->id,
                    'photoable_type' => Product::class
                ]);
                $product->photo_id_2 = $photo->id;
            }
        }
        if (isset($request->photo_3) || $callbackExecute[1] == "deleteImage") {
            $photoPath = $callbackExecute(["request" => $request, "product" => $product, "photoColumn" => "photo_3"]);
            if ($callbackExecute[1] != "deleteImage") {
                $photo = Photo::create([
                    'path' => $photoPath,
                    'photoable_id' => $product->id,
                    'photoable_type' => Product::class
                ]);
                $product->photo_id_3 = $photo->id;
            }
        }
        if (isset($request->photo_4) || $callbackExecute[1] == "deleteImage") {
            $photoPath = $callbackExecute(["request" => $request, "product" => $product, "photoColumn" => "photo_4"]);
            if ($callbackExecute[1] != "deleteImage") {
                $photo = Photo::create([
                    'path' => $photoPath,
                    'photoable_id' => $product->id,
                    'photoable_type' => Product::class
                ]);
                $product->photo_id_4 = $photo->id;
            }
        }
        if ($callbackExecute[1] == "storeImage") {
            $product->save();
        }
    }

    private function storeImage(array $args)
    {
        return $args["request"]->file($args["photoColumn"])->store('photo/product', 'public_direct');
    }

    private function updateImage(array $args)
    {
        $this->deleteImage($args);
        return $args["request"]->file($args["photoColumn"])->store('photo/product', 'public_direct');;
    }

    private function deleteImage(array $args)
    {
//        dd([$args["product"][$args["photoColumn"]], $args["product"]->category, $args["product"]->photo_1]);
        $photo = $args["product"][$args["photoColumn"]];
        if (isset($photo) && File::exists($args["product"][$args["photoColumn"]]->path)) {
//            dd($args["product"][$args["photoColumn"]]->id);
            $destination = $args["product"][$args["photoColumn"]]->path;
            $linkedPhoto = Photo::where('path', $destination)->get();
            if (count($linkedPhoto) <= 1) {
                File::delete($destination);
            }

            // TODO: delete record on photo table (parent table)
//            $args["product"][$args["photoColumn"]]->delete();
            $args['product']['photo_id_'.substr($args['photoColumn'], -1)] = null;
            $args['product']->save();
            Photo::find($args["product"][$args["photoColumn"]]->id)->delete();
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
