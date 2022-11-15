<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function produk(){
        $data = Produk::orderBy('id', 'DESC')->simplePaginate(5);
        // $data = Informasi::all();
        return view('admin/produk', compact('data'));
    }

    public function tambahproduk(){
        return view('admin.tambahproduk');
    }

    public function insertproduk(Request $request)
    {
    $data = Produk::create($request->all());
    if($request->hasFile('gambar')){
        $request->file('gambar')->move('gambar/produk/', $request->file('gambar')->getClientOriginalName());
        $data->gambar = $request->file('gambar')->getClientOriginalName();
        $data->save();
    }
        return redirect()->route('produk')->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function editproduk($id){
        $data = Produk::find($id);
        return view('admin/editproduk', compact('data'));
    }

    public function updateproduk(Request $request, $id){
        $data = Produk::find($id);
        $data->update($request->all());
        if($request->hasFile('gambar')){
            $request->file('gambar')->move('gambar/produk/', $request->file('gambar')->getClientOriginalName());
            $data->gambar = $request->file('gambar')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('produk')->with('update', 'Informasi berhasil diupdate.');
    }

    public function deleteproduk($id) {
        $data = Produk::find($id)->delete();
        return redirect()->route('produk')->with('delete', 'Informasi berhasil dihapus.');
    }

    public function userproduk(){
        $data = Produk::all();
        return view('pembeli/dashboard', compact('data'));
    }
}
