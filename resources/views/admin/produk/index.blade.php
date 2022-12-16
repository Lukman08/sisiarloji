@extends('layout.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Produk</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Produk</li>
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
                                    <a href="{{ route('tambahproduk') }}" class="btn btn-outline-success">
                                        <i class="fa fa-plus-circle"></i>
                                    </a>
                                </div>
                                <div class="col-md"></div>
                                <div class="col-md">
                                    <form action="{{ route('produk') }}" method="GET">
                                        <div class="input-group">
                                            <input type="search" class="form-control" placeholder="Cari produk.."
                                                name="cari">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-transparent text-primary">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Nama Barang</th>
                                        <th scope="col" class="text-center">Gambar</th>
                                        <th scope="col"  class="text-center">Harga</th>
                                        <th scope="col" class="text-center">Stok</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $nom = 1;
                                    @endphp
                                    @foreach ($data as $row)
                                        <tr>
                                            <th scope="row"  class="text-center">{{ $nom++ }}</th>
                                            <td>{{ Str::limit($row->nama_barang, 20) }}</td>
                                            <td class="text-center">
                                                <img src="{{ asset('gambar/produk/' . $row->gambar) }}" alt=""
                                                    style="width:40px">
                                            </td>
                                            <td  class="text-center">{{ $row->harga }}</td>
                                            <td  class="text-center">{{ $row->stok }}</td>
                                            <td class="text-center">{{ Str::limit($row->keterangan, 30) }}</td>
                                            <td class="text-center">
                                                <div class="btn-group dropleft">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Menu
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('editproduk', $row->id) }}">Edit</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('deleteproduk', $row->id) }}">Hapus</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row mt-3 text-right">
                                {{ $data->links() }}
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
