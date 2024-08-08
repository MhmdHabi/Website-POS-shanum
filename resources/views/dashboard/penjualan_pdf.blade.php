<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #b3daff;
            /* Warna biru muda */
        }

        h2 {
            text-align: center;
            /* Teks h2 di tengah */
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Data Penjualan Shanum Bakery</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pembeli</th>
                <th>Produk</th>
                <th>Jumlah Produk</th>
                <th>Total Harga</th>
                <th>Tanggal Penjualan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualans as $key => $penjualan)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $penjualan->nama_pembeli }}</td>
                    <td>{{ $penjualan->product->nama_produk }}</td>
                    <td>{{ $penjualan->jumlah_produk }}</td>
                    <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                    <td class="center">{{ $penjualan->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
