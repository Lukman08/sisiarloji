<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function pesanlangsung(Request $request, $id){
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
            $pesanan = new Pesanan();
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
        if(empty($cek_pesanan_detail))
        {
            $pesanan_detail = new PesananDetail();
            $pesanan_detail->produk_id = $data->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = '1';
            $pesanan_detail->jumlah_harga = $data->harga*1;
            $pesanan_detail->save();
        } else{
            $pesanan_detail = PesananDetail::where('produk_id', $data->id)->where('pesanan_id', $pesanan_baru->id)->first();
            $pesanan_detail->jumlah = $pesanan_detail->jumlah+1;

            //harga sekarang
            $harga_pesanan_detail_baru = $data->harga*1;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga + $harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }

        //jumlah total
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga+$data->harga*1;
        $pesanan->update();
        
        return redirect()->route('belanja');
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
            $pesanan = new Pesanan();
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
        if(empty($cek_pesanan_detail))
        {
            $pesanan_detail = new PesananDetail();
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
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if(!empty($pesanan))
        {
            $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
            return view('pembeli/checkout', compact('pesanan', 'pesanan_details'));
        }

        if(empty($pesanan))
        {
            return view('pembeli/checkout');
        }
    }

    public function deleteco($id)
    {
        $pesanan_detail = PesananDetail::where('id', $id)->first();

        $pesanan_cek = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan_cek->jumlah_harga = $pesanan_cek->jumlah_harga - $pesanan_detail->jumlah_harga;
        $pesanan_cek->update();

        $pesanan_detail->delete();

        return redirect()->route('checkout');
    }

    public function konfirmasi()
    {
        // $user = User::where('id', Auth::user()->id)->where('status', 0)->first();

        // if(!empty($user->alamat))
        // {
        //     Alert::error('Identitas Harap Dilengkapi', 'Error');
        //     return redirect('profile');
        // }

        // if(!empty($user->nohp))
        // {
        //     Alert::error('Identitas Harap Dilengkapi', 'Hapus');
        //     return redirect('profile');
        // }

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->update();

        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();
        foreach($pesanan_details as $pesanan_detail) {
            $produk = Produk::where('id', $pesanan_detail->produk_id)->first();
            $produk->stok = $produk->stok-$pesanan_detail->jumlah;
            $produk->update();
        }
        return redirect()->route('checkout');
    }
}
