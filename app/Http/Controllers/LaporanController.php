<?php

namespace App\Http\Controllers;

use App\Exports\PenjualanExport;
use App\Models\Penjualan;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('dashboard.laporan', compact('products'));
    }

    public function store(Request $request)
    {

        // Pastikan data yang diterima ada dan valid sebelum melakukan iterasi
        if (!isset($request->produk_id) || !isset($request->jumlah_produk)) {
            return back()->withInput()->withErrors('Data produk atau jumlah produk tidak ditemukan.');
        }

        try {
            $total_harga = 0;

            // Mulai transaksi database
            DB::beginTransaction();

            foreach ($request->produk_id as $key => $produk_id) {
                $product = Product::findOrFail($produk_id);

                $jumlah_produk = $request->jumlah_produk[$key];

                $harga_produk = $product->harga;

                $subtotal = $jumlah_produk * $harga_produk;

                $total_harga += $subtotal;

                Penjualan::create([
                    'nama_pembeli' => $request->nama_pembeli,
                    'produk_id' => $produk_id,
                    'jumlah_produk' => $jumlah_produk,
                    'total_harga' => $subtotal,
                ]);
            }

            // Commit transaksi database
            DB::commit();

            return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil disimpan.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            return back()->withInput()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function penjualan()
    {
        $penjualans = Penjualan::with('product')->get();
        return view('dashboard.penjualan', compact('penjualans'));
    }

    public function exportPenjualan(Request $request)
    {
        return Excel::download(new PenjualanExport($request), 'Data Penjualan.xlsx');
    }

    public function exportPDF()
    {
        $penjualans = Penjualan::with('product')->get();

        $pdf = Pdf::loadView('dashboard.penjualan_pdf', compact('penjualans'));

        return $pdf->stream('penjualan.pdf');
    }
}
