<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //untuk melihat semua
    public function index()
    {
        //buat lihat semua
        $products = Product::all();

        return Response()->json([
            "Message" => "Berhasil",
            "code" => 200,
            "data" => $products
        ]);
    }

    //untuk melihat salah satu
    public function show($id)
    {
        $products = Product::find($id);
        return Response()->json([
            "Message" => "Berhasil",
            "code" => 200,
            "data" => $products
        ]);
    }

    //untuk tambah data
    public function add(Request $request)
    {
        $data = $request->validate([
            //required artinya harus diisi
            "nama" => "required",
            "desc" => "required ",
            // max:2048 artinya max 2mb
            "foto" => "image|max:2048",
            "harga" => "required|numeric"
        ]);

        if ($request->hasFile('foto')) {
            //artinya jika kita punya foto
            //kita akan membuat variabel image
            $image  = $request->file('foto');
            //membuat nama foto
            $imageName = time() . '-' . $image->getClientOriginalExtension();
            //menyimpan file foto di public dan membuaat folder images
            $image->move(public_path('images'), $imageName);
            //buat masukin nama file foto
            $data['foto'] = $imageName;
        }

        $products = Product::create($data);
        return Response()->json([
            "Message" => "Berhasil",
            "code" => 200,
            "data" => $products
        ]);
    }

    public function edit(Request $request, $id)
    {
        $data = $request->validate([
            //required artinya harus diisi
            "nama" => "required",
            "desc" => "required ",
            // max:2048 artinya max 2mb
            "foto" => "image|max:2048",
            "harga" => "required|numeric"
        ]);

        if ($request->hasFile('foto')) {
            //artinya jika kita punya foto
            //kita akan membuat variabel image
            $image  = $request->file('foto');
            //membuat nama foto
            $imageName = time() . '-' . $image->getClientOriginalExtension();
            //menyimpan file foto di public dan membuaat folder images
            $image->move(public_path('images'), $imageName);
            //buat masukin nama file foto
            $data['foto'] = $imageName;
        }
        //cari data
        $products = Product::findOrFail($data);
        
        //edit baru risa
        //lalu di update
        $products->update($data);

        return Response()->json([
            "Message" => "Berhasil",
            "code" => 200,
            "data" => $products
        ]);
    }

    public function delete($id)
    {
        $products = Product::find($id);
        $products->delete();

        return Response()->json([
            "Message" => "Berhasil",
            "code" => 200,
            "data" => $products
        ]);
    }
}
