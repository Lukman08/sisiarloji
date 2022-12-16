@extends('layout.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Produk</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('produk') }}">Produk</a></li>
                            <li class="breadcrumb-item active"> Edit Produk</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-16">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <!-- form start -->
                            <form action="{{ route('updateproduk', $data->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Produk</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            placeholder="Masukan nama produk" name="nama_barang" value="{{ $data->nama_barang }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Gambar</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input class="form-control" type="file" id="exampleInputEmail1"
                                                    name="gambar" value="{{ $data->gambar }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Harga</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1"
                                            placeholder="Masukan harga produk" name="harga" value="{{ $data->harga }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Stok</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1"
                                            placeholder="Masukan stok produk" name="stok" value="{{ $data->stok }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Keterangan</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            placeholder="Masukan keterangan produk" name="keterangan" value="{{ $data->keterangan }}">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('produk') }}" class="btn btn-secondary">Kembali</a>
                                </div>
                                <div class="card-footer">
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
