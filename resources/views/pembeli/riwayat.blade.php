@extends('layout.pembeli')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-2">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Riwayat</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('pembeli') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><a href="{{ route('belanja') }}">Belanja</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Riwayat</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
                <table class="table table-bordered">
                    <thread>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Jumlah Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thread>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pesanan as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->tanggal }}</td>
                                <td>
                                    @if ($row->status == 1)
                                    Belum Bayar
                                    @else
                                    Sudah Bayar
                                    @endif
                                </td>
                                <td>Rp. {{ number_format($row->jumlah_harga+$row->kode) }}</td>
                                <td>
                                    <a href="{{url('pembeli/riwayatdetail', $row->id)}}" class="btn
                                        btn-primary"><i class="fa fa-info-circle"></i> Detail </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@endsection
