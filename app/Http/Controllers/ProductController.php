<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function addProduct()
    {
        return view('add-product');
    }

    public function storeProduct(Request $request)
    {
        $product = new Product;
        $product->name = $request->input('name');
        $product->kategori = $request->input('kategori');
        $product->harga = $request->input('harga');
        $product->stok = $request->input('stok');
        $product->berat = $request->input('berat');
        $product->deskripsi = $request->input('deskripsi');
        if($request->hasFile('foto1'))
        {
            $file1 = $request->file('foto1');
            $extension1 = $file1->getClientOriginalExtension();
            $filename1 = 'foto1'.time().'.'.$extension1;
            $file1->move(public_path('images'),$filename1);
            $product->foto1 = $filename1;
        }
        if($request->hasFile('foto2'))
        {
            $file2 = $request->file('foto2');
            $extension2 = $file2->getClientOriginalExtension();
            $filename2 = 'foto2'.time().'.'.$extension2;
            $file2->move(public_path('images'),$filename2);
            $product->foto2 = $filename2;
        }
        if($request->hasFile('foto3'))
        {
            $file3 = $request->file('foto3');
            $extension3 = $file3->getClientOriginalExtension();
            $filename3 = 'foto3'.time().'.'.$extension3;
            $file3->move(public_path('images'),$filename3);
            $product->foto3 = $filename3;
        }
        if($request->hasFile('foto4'))
        {
            $file4 = $request->file('foto4');
            $extension4 = $file4->getClientOriginalExtension();
            $filename4 = 'foto4'.time().'.'.$extension4;
            $file4->move(public_path('images'),$filename4);
            $product->foto4 = $filename4;
        }
        $product->save();
        return redirect('/manage-product')->with('product_added','Produk Berhasil ditambahkan');
        // $name = $request->name;
        // $kategori = $request->kategori;
        // $harga = $request->harga;
        // $stok = $request->stok;
        // $berat = $request->berat;
        // $deskripsi = $request->deskripsi;
        // $foto1 = $request->file('foto1');
        // $imageName1 = 'foto1'.time().'.'.$foto1->extension();
        // $foto1->move(public_path('images'),$imageName1);
        // $foto2 = $request->file('foto2');
        // $imageName2 = 'foto2'.time().'.'.$foto2->extension();
        // $foto2->move(public_path('images'),$imageName2);
        // $foto3 = $request->file('foto3');
        // $imageName3 = 'foto3'.time().'.'.$foto3->extension();
        // $foto3->move(public_path('images'),$imageName3);
        // $foto4 = $request->file('foto4');
        // $imageName4 = 'foto4'.time().'.'.$foto4->extension();
        // $foto4->move(public_path('images'),$imageName4);

        // $product = new Product();
        // $product->name = $name;
        // $product->kategori = $kategori;
        // $product->harga = $harga;
        // $product->stok = $stok;
        // $product->berat = $berat;
        // $product->deskripsi = $deskripsi;
        // $product->foto1 = $imageName1;
        // $product->foto2 = $imageName2;
        // $product->foto3 = $imageName3;
        // $product->foto4 = $imageName4;
        // $product->save();
        // return back()->with('product_added','Produk Berhasil ditambahkan');
    }

    public function products()
    {
        $products = Product::paginate(10);
        return view('admin.manage-product',compact('products'));
    }

    public function userProducts()
    {
        $products = Product::paginate(30);
        return view('search', compact('products'));
    }
    public function productDetail($id)
    {
        $product = Product::find($id);
        return view('product', compact('product'));
    }

    public function editProduct($id)
    {
        $product = Product::find($id);
        return view('edit-product',compact('product'));
    }

    public function updateProduct(Request $request)
    {
        $product = Product::find($request->id);
        $product->name = $request->input('name');
        $product->kategori = $request->input('kategori');
        $product->harga = $request->input('harga');
        $product->stok = $request->input('stok');
        $product->berat = $request->input('berat');
        $product->deskripsi = $request->input('deskripsi');
        if($request->hasFile('foto1'))
        {
            $destination1 = public_path('images').$product->foto1;
            if(File::exists($destination1))
            {
                File::delete($destination1);
            }
            $file1 = $request->file('foto1');
            $extension1 = $file1->getClientOriginalExtension();
            $filename1 = 'foto1'.time().'.'.$extension1;
            $file1->move(public_path('images'),$filename1);
            $product->foto1 = $filename1;
        }
        if($request->hasFile('foto2'))
        {
            $destination2 = public_path('images').$product->foto2;
            if(File::exists($destination2))
            {
                File::delete($destination2);
            }
            $file2 = $request->file('foto2');
            $extension2 = $file2->getClientOriginalExtension();
            $filename2 = 'foto2'.time().'.'.$extension2;
            $file2->move(public_path('images'),$filename2);
            $product->foto2 = $filename2;
        }
        if($request->hasFile('foto3'))
        {
            $destination3 = public_path('images').$product->foto3;
            if(File::exists($destination3))
            {
                File::delete($destination3);
            }
            $file3 = $request->file('foto3');
            $extension3 = $file3->getClientOriginalExtension();
            $filename3 = 'foto3'.time().'.'.$extension3;
            $file3->move(public_path('images'),$filename3);
            $product->foto3 = $filename3;
        }
        if($request->hasFile('foto4'))
        {
            $destination4 = public_path('images').$product->foto4;
            if(File::exists($destination4))
            {
                File::delete($destination4);
            }
            $file4 = $request->file('foto4');
            $extension4 = $file4->getClientOriginalExtension();
            $filename4 = 'foto4'.time().'.'.$extension4;
            $file4->move(public_path('images'),$filename4);
            $product->foto4 = $filename4;
        }
        $product->update();
        return redirect('/manage-product')->with('product_updated','Produk Berhasil diubah');
        // $name = $request->name;
        // $kategori = $request->kategori;
        // $harga = $request->harga;
        // $stok = $request->stok;
        // $berat = $request->berat;
        // $deskripsi = $request->deskripsi;
        // $foto1 = $request->file('foto1');
        // $imageName1 = 'foto1'.time().'.'.$foto1->extension();
        // $foto1->move(public_path('images'),$imageName1);
        // $foto2 = $request->file('foto2');
        // $imageName2 = 'foto2'.time().'.'.$foto2->extension();
        // $foto2->move(public_path('images'),$imageName2);
        // $foto3 = $request->file('foto3');
        // $imageName3 = 'foto3'.time().'.'.$foto3->extension();
        // $foto3->move(public_path('images'),$imageName3);
        // $foto4 = $request->file('foto4');
        // $imageName4 = 'foto4'.time().'.'.$foto4->extension();
        // $foto4->move(public_path('images'),$imageName4);

        // $product = Product::find($request->id);
        // $product->name = $name;
        // $product->kategori = $kategori;
        // $product->harga = $harga;
        // $product->stok = $stok;
        // $product->berat = $berat;
        // $product->deskripsi = $deskripsi;
        // $product->foto1 = $imageName1;
        // $product->foto2 = $imageName2;
        // $product->foto3 = $imageName3;
        // $product->foto4 = $imageName4;
        // $product->save();
        // return back()->with('product_updated','Produk Berhasil diubah');
    }

    public function deleteProduct(Request $request)
    {
        $product = Product::find($request->id);
        if($request->hasFile('foto1'))
        {
            unlink(public_path('images').'/'.$product->foto1);
        }
        if($request->hasFile('foto2'))
        {
            unlink(public_path('images').'/'.$product->foto2);
        }        
        if($request->hasFile('foto3'))
        {
            unlink(public_path('images').'/'.$product->foto3);
        }
        if($request->hasFile('foto4'))
        {
            unlink(public_path('images').'/'.$product->foto4);
        }
        $product->delete();
        return back()->with('product_deleted','Produk Berhasil Dihapus');
    }
}
