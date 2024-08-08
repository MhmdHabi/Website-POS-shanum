<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index()
    {
        $product = Product::all();

        return view('dashboard.produk', compact('product'));
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        // Menggunakan DB transaction
        try {
            DB::beginTransaction();

            Product::create([
                'nama_produk' => $request->nama_produk,
                'harga' => $request->harga,
            ]);

            DB::commit();

            return redirect()->route('dashboard.produk')->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollback();

            return redirect()->route('dashboard.produk')->with('error', 'Gagal menambahkan produk. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        // Cari produk berdasarkan ID
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('dashboard.produk')->with('error', 'Produk tidak ditemukan.');
        }

        return view('dashboard.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        // Gunakan DB transaction
        try {
            DB::beginTransaction();

            // Cari produk berdasarkan ID
            $product = Product::find($id);

            if (!$product) {
                return redirect()->route('dashboard.produk')->with('error', 'Produk tidak ditemukan.');
            }

            // Update data produk
            $product->nama_produk = $request->nama_produk;
            $product->harga = $request->harga;
            $product->save();

            DB::commit();

            return redirect()->route('dashboard.produk')->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('dashboard.produk')->with('error', 'Gagal memperbarui produk. Silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        // Cari produk berdasarkan ID
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('dashboard.produk')->with('error', 'Produk tidak ditemukan.');
        }

        // Menggunakan DB transaction
        try {
            DB::beginTransaction();

            // Hapus produk
            $product->delete();

            DB::commit();

            return redirect()->route('dashboard.produk')->with('success', 'Produk berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollback();

            return redirect()->route('dashboard.produk')->with('error', 'Gagal menghapus produk. Silakan coba lagi.');
        }
    }
}
