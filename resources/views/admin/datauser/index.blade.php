@extends('layout.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Data User</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container mb-2">
                <a href="{{ route('tambahuser') }}" class="btn btn-outline-success">
                    <i class="fa fa-plus-circle"></i>
                </a>
            </div>

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Bergabung Pada</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $nom = 1;
                                    @endphp
                                    @foreach ($data as $row)
                                        <tr>
                                            <th scope="row">{{ $nom++ }}</th>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->created_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="btn-group dropleft">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Menu
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('resetpassword', $row->id) }}">Reset Password</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('deleteuser', $row->id) }}">Hapus</a>
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
