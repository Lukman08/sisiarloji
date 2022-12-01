<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\Auth;

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

    public function belanja(){
        $data = Produk::orderBy('id', 'DESC')->simplePaginate(8);
        return view('pembeli/belanja', compact('data'));
    }

    public function detailbelanja($id){
        $data = Produk::find($id);
        return view('pembeli/detail', compact('data'));
    }

    public function pesan(Request $request, $id){
        $data = Produk::where('id', $id)->first();
        $tanggal = Carbon::now();

        //validasi apakah melebihi stok
        if($request->jumlah_pesan > $data->stok)
        {
            return redirect()->route('belanja');
        }

        //cek validasi
        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        //simpan ke database pesanan
        if(empty($cek_pesanan))
        {
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->kode = mt_rand(100, 999);
            $pesanan->save();
        }

        //simpan ke database pesanan detail
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //cek pesanan detail
        $cek_pesanan_detail = PesananDetail::where('produk_id', $data->id)->where('pesanan_id', $pesanan_baru->id)->first();
        if(empty($cek_pesanan))
        {
            $pesanan_detail =new PesananDetail;
            $pesanan_detail->produk_id = $data->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $data->harga*$request->jumlah_pesan;
            $pesanan_detail->save();
        } else{
            $pesanan_detail = PesananDetail::where('produk_id', $data->id)->where('pesanan_id', $pesanan_baru->id)->first();
            $pesanan_detail->jumlah = $pesanan_detail->jumlah+$request->jumlah_pesan;

            //harga sekarang
            $harga_pesanan_detail_baru = $data->harga*$request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga + $harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }

        //jumlah total
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga+$data->harga*$request->jumlah_pesan;
        $pesanan->update();
        
        return redirect()->route('belanja');
    }

    public function checkout()
    {
        $data = Produk::all();
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if(!empty($pesanan))
        {
            $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        }

        return view('pembeli/checkout', compact('pesanan', 'pesanan_details'));
    }
}
