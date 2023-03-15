<?php

namespace App\Http\Controllers;

use App\Models\AddressOrder;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\ProductStackCart;
use App\Models\ProductStackOrder;
use Illuminate\Http\Request;

class PlaceOrderController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            "nama_penerima" => ["required"],
            "nomor_hp" => ["required", "numeric"],
            "courier_id" => ["required", "exists:couriers,id"],
            "courier_type_id" => ["required", "exists:courier_types,id"],
            "payment_method_id" => ["required", "exists:payment_methods,id"],
            "subtotal" => ["required", "numeric", "min:0"],
            "ongkos_kirim" => ["required", "numeric", "min:0"],
            "total_bayar" => ["required", "numeric", "min:0"],
            "kota" => ["required"],
            "kode_pos" => ["required", "numeric"],
            "alamat" => ["required"]
        ]);
        $cartId = auth()->user()->cart->id;
        $checkedProductStackCarts = ProductStackCart::where('cart_id', $cartId)
            ->with('product')
            ->where('checked', true)
            ->get();

        /* validate $checkedProductStackCarts hash */
        if ($request->checkedProductStackCarts_hash != md5(json_encode($checkedProductStackCarts))) {
            return "Error: terjadi perubahan data ketika melakukan checkout. Silahkan coba lagi.";
        }

        /* clear $checkedProductStackCarts from user cart */
        ProductStackCart::where('cart_id', $cartId)
            ->where('checked', true)
            ->delete();

        /* reduce/update product stock */
        $checkedProductStackCarts->each(function ($productStackCart) {
            $productId = $productStackCart->product->id;
            $orderQty = $productStackCart->kuantitas;

            $product = Product::find($productId);
            $currentStock = $product->stok;
            $product->update(['stok' => $currentStock-$orderQty]);

//            $updatedStock = $product->stok;
//            dd([$productId, $orderQty, $currentStock, $updatedStock]);
        });

        /* create address order */
        $addressOrder = AddressOrder::create($request->all());

        /* create product order */
        $request->request->add(['address_order_id' => $addressOrder->id]);
        $request->request->add(['user_id' => auth()->user()->id]);
        $productOrder = ProductOrder::create($request->all());
//        dd($productOrder);

        /* create product stack order */
        $checkedProductStackCarts->each(function ($productStackCart) use ($productOrder) {
            $productId = $productStackCart->product->id;
            $productNama = $productStackCart->product->nama;
            $productHarga = $productStackCart->product->harga;
            $orderQty = $productStackCart->kuantitas;
            $productStackOrder = ProductStackOrder::create([
                'product_order_id' => $productOrder->id,
                'product_id' => $productId,
                'nama' => $productNama,
                'kuantitas' => $orderQty,
                'harga' => $productHarga
            ]);

            /* add new link to product photo */
            $productPhoto = $productStackCart->product->photo_1;
            if (isset($productPhoto)) {
                $photoPath = $productPhoto->path;
                $productStackOrder->photo()->updateOrCreate([], ['path' => $photoPath]);
            }
        });

//        dd([json_encode($request->all()), md5(json_encode($checkedProductStackCarts))]);
        return "Place order berhasil";
    }
}
