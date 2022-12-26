@extends('layout.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Transaksi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('transaksi') }}">Transaksi</a></li>
                            <li class="breadcrumb-item active">Detail Transaksi</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md">
                                    <p class="text-left">Tanggal: {{ $pesanan->tanggal }}</p>
                                </div>
                                <div class="col-md"></div>
                                <div class="col-md"></div>
                                <div class="col-md"></div>
                                <div class="col-md text-right">
                                    <a href="{{ route('downloadbuktitf', $pesanan->id) }}" class="btn btn-outline-success mb-3">
                                        <i class="fa fa-download mr-2"></i>Bukti Transfer</a>
                                </div>
                                <div class="col-md text-right">
                                    <a href="{{ route('konfirmasitf', $pesanan->id) }}" class="btn btn-outline-info mb-3">
                                        <i class="fa fa-check mr-2"></i>Bukti Transfer</a>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
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
                                                <img src="{{ asset('gambar/produk/' . $row->produk->gambar) }}"
                                                    alt="" style="width:50px">
                                            </td>
                                            <td>{{ $row->produk->nama_barang }}</td>
                                            <td class="text-center">{{ $row->jumlah }}</td>
                                            <td class="text-center">Rp. {{ number_format($row->produk->harga) }}</td>
                                            <td class="text-center">Rp. {{ number_format($row->jumlah_harga) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" align="right"><strong>Total Transfer :</strong></td>
                                        <td><strong>Rp.
                                                {{ number_format($pesanan->jumlah_harga + $pesanan->kode) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!--/. container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
