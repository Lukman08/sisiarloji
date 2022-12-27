<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #6</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>

<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h1 class="text-start">Sisi Arloji</h1>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>ID Invoice: #SA{{ $pesanan->id }}</span> <br>
                    <span>Desa Rambatan Kulon Kecamatan Lohbener Kabupaten Indramayu</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Detail Pesanan</th>
                <th width="50%" colspan="2">Detail Pembeli</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>ID Pesanan:</td>
                <td>{{ $pesanan->id }}</td>

                <td>Nama:</td>
                <td>{{ $pesanan->user->name }}</td>
            </tr>
            <tr>
                <td>Tanggal Transaksi:</td>
                <td>{{ $pesanan->tanggal }}</td>


                <td>Email:</td>
                <td>{{ $pesanan->user->email }}</td>
            </tr>
            <tr>
                <td>Metode Pembayaran:</td>
                <td>
                    @if ($pesanan->pembayaran == 0)
                        Transfer Bank
                    @elseif ($pesanan->pembayaran == 1)
                        Bayar Langsung
                    @endif
                </td>

                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Pesanan
                </th>
            </tr>
            <tr class="bg-blue">
                <th class="text-center">ID</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Qty</th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pesanan_detail as $row)
            <tr>
                <td width="10%" class="text-center">{{ $row->produk->id }}</td>
                <td>
                    {{ $row->produk->nama_barang }}
                </td>
                <td width="15%" class="text-center">Rp. {{ number_format($row->produk->harga) }}</td>
                <td width="10%" class="text-center">{{ $row->jumlah }}</td>
                <td width="20%" class="fw-bold text-center">Rp. {{ number_format($row->jumlah_harga) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" class="total-heading text-center">Total Harga :</td>
                <td colspan="1" class="total-heading text-center">Rp. {{ number_format($pesanan->jumlah_harga) }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <h3 class="text-center">
        Terimakasih telah berbelanja ditoko kami.
    </h3>

</body>

</html>
