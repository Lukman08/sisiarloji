<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function produk(Request $request){    
        if($request->has('cari')){
            $data = Produk::where('nama_barang', 'LIKE', '%' .$request->cari.'%')->simplePaginate(5);
        }else{
            $data = Produk::orderBy('nama_barang', 'ASC')->simplePaginate(5);
        }
        return view('admin.produk.index', compact('data'));
    }

    public function tambahproduk(){
        return view('admin.produk.tambah');
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
        return view('admin.produk.edit', compact('data'));
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

    public function belanja(Request $request){
        if($request->has('cari')){
            $data = Produk::where('nama_barang', 'LIKE', '%' .$request->cari.'%')->simplePaginate(8);
        }else{
            $data = Produk::orderBy('id', 'DESC')->simplePaginate(8);
        }
        return view('pembeli.belanja.belanja', compact('data'));
    }

    public function detailbelanja($id){
        $data = Produk::find($id);
        return view('pembeli.belanja.detail', compact('data'));
    }
}
