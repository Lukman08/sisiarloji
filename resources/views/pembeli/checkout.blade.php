@extends('layout.pembeli')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-2">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Belanja</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('pembeli') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><a href="{{ route('belanja') }}">Belanja</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            @if(!empty($pesanan))
                    <table class="table table-bordered">
                    <thread>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thread>
                    <tbody>
                    @php
                    $no = 1;
                    @endphp
                        @foreach($pesanan_details as $pesanan_detail)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $pesanan_detail->produk->nama_barang }}</td>
                            <td>{{ $pesanan_detail->jumlah}}</td>
                            <td align="left">Rp. {{ number_format($pesanan_detail->produk->harga) }}</td>
                            <td>Rp. {{ number_format($pesanan_detail->jumlah_harga) }}</td>
                            <td>
                                <form action="{{ url('checkout') }}/{( $pesanan_detail->id )}" method="post">
                                @csrf
                                {( method_field('DELETE') )}
                                <button type="submit" class="btn btn-danger btn-sm" onclick="
                                    return confirm('Anda yakin akan menghapus data ?');"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" align="right"><strong>Total Harga :</strong></td>
                            <td><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                            <td>
                                <a href="{{ url('konfirmasi_checkout') }}" class="btn btn-succes" 
                                onclick="return confirm('Anda yakin akan melakukan pembayaran ?');"><i class="fa fa-shopping-cart"></i>Bayar</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endif
        </div>
    </div>
@endsection
