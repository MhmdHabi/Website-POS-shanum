<?php

namespace App\Exports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenjualanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Penjualan::select('penjualans.id', 'penjualans.nama_pembeli', 'products.nama_produk', 'penjualans.jumlah_produk', 'penjualans.total_harga', 'penjualans.created_at')
            ->join('products', 'penjualans.produk_id', '=', 'products.id')
            ->get();

        return $query;
    }

    public function headings(): array
    {
        $heading = [
            'ID',
            'Nama Pembeli',
            'Produk',
            'jumlah produk',
            'Total Harga',
            'Tanggal Pembelian',
        ];
        return $heading;
    }
}
