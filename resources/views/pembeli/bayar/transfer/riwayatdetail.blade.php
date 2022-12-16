@extends('layout.pembeli')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-2">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Detail</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('pembeli') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><a href="{{ route('belanja') }}">Belanja</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><a href="{{ route('riwayat') }}">Riwayat</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Detail</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Shop Start -->
    
    @if ($pesanan->pembayaran == 0)
    <div class="container-fluid pt-5">
        <div class="card mb-3">
            <div class="card-body">
                <h5>Berhasil Checkout</h5>
                <h6>Untuk pembayaran silahkan transfer sebesar: <strong>Rp.
                        {{ number_format($pesanan->jumlah_harga + $pesanan->kode) }}</strong></h6>
                <h6>Ke Rekening Bank BRI:<strong> 12345678</strong> a/n <strong>Nama</strong></h6>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="container text-right">
                <p>Tanggal Pesan: {{ $pesanan->tanggal }}</p>
            </div>
            <table class="table table-bordered">
                <thread>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Gambar</th>
                        <th class="text-center">Nama Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Total Harga</th>
                    </tr>
                </thread>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($pesanan_detail as $row)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">
                                <img src="{{ asset('gambar/produk/' . $row->produk->gambar) }}" alt=""
                                    style="width:50px">
                            </td>
                            <td>{{ $row->produk->nama_barang }}</td>
                            <td class="text-center">{{ $row->jumlah }}</td>
                            <td class="text-center">Rp. {{ number_format($row->produk->harga) }}</td>
                            <td class="text-center">Rp. {{ number_format($row->jumlah_harga) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" align="right"><strong>Total Harga :</strong></td>
                        <td><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right"><strong>Kode Unik :</strong></td>
                        <td><strong>Rp. {{ number_format($pesanan->kode) }}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right"><strong>Total Transfer :</strong></td>
                        <td><strong>Rp. {{ number_format($pesanan->jumlah_harga + $pesanan->kode) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @elseif($pesanan->pembayaran == 1)
    <div class="container-fluid pt-5">
        <div class="card mb-3">
            <div class="card-body">
                <h5>Berhasil Checkout</h5>
                <h6>Untuk pembayaran silahkan langsung sebesar: <strong>Rp.
                        {{ number_format($pesanan->jumlah_harga) }}</strong></h6>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="container text-right">
                <p>Tanggal Pesan: {{ $pesanan->tanggal }}</p>
            </div>
            <table class="table table-bordered">
                <thread>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Gambar</th>
                        <th class="text-center">Nama Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Total Harga</th>
                    </tr>
                </thread>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($pesanan_detail as $row)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td class="text-center">
                                <img src="{{ asset('gambar/produk/' . $row->produk->gambar) }}" alt=""
                                    style="width:50px">
                            </td>
                            <td>{{ $row->produk->nama_barang }}</td>
                            <td class="text-center">{{ $row->jumlah }}</td>
                            <td class="text-center">Rp. {{ number_format($row->produk->harga) }}</td>
                            <td class="text-center">Rp. {{ number_format($row->jumlah_harga) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" align="right"><strong>Total Harga :</strong></td>
                        <td><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif
@endsection
