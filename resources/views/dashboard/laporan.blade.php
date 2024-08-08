@extends('layouts.master')

@section('content')
    <div class="container mx-auto flex flex-col items-center mt-2 lg:mt-5 lg:px-10">
        <h1 class="text-2xl font-bold mb-4">Tambah Penjualan Baru</h1>

        <form action="{{ route('penjualan.store') }}" method="POST" class="w-full max-w-lg">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label for="nama_pembeli" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nama
                        Pembeli</label>
                    <input id="nama_pembeli" type="text" name="nama_pembeli" value="{{ old('nama_pembeli') }}"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('nama_pembeli') border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                    @error('nama_pembeli')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Dinamis input produk -->
            <div id="produk-form">
                <div class="flex flex-wrap -mx-3 mb-6 produk-item">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="produk_id[]"
                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Produk</label>
                        <select id="produk_id[]" name="produk_id[]"
                            class="produk-select appearance-none block w-full bg-gray-200 text-gray-700 border @error('produk_id.*') border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                            <option value="">Pilih Produk</option>
                            @foreach ($products as $item)
                                <option value="{{ $item->id }}" data-harga="{{ $item->harga }}"
                                    {{ old('produk_id.0') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_produk }} - Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('produk_id.*')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                        <label for="jumlah_produk[]"
                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Jumlah Produk</label>
                        <input id="jumlah_produk[]" type="number" name="jumlah_produk[]"
                            value="{{ old('jumlah_produk.0') }}"
                            class="jumlah-produk appearance-none block w-full bg-gray-200 text-gray-700 border @error('jumlah_produk.*') border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                        @error('jumlah_produk.*')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                        <button type="button"
                            class="py-3 px-4 bg-red-500 text-white rounded-md mt-6 remove-produk">Hapus</button>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mt-4">
                <button type="button" class="py-3 px-4 bg-blue-500 text-white rounded-md add-produk">Tambah Produk</button>
                <button type="submit" class="py-3 px-4 bg-blue-500 text-white rounded-md">Simpan</button>
            </div>

            <!-- Menampilkan total harga -->
            <div class="mt-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Total Harga</label>
                <input id="total_harga" type="text" name="total_harga" value="{{ old('total_harga') }}"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    disabled>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const produkForm = document.getElementById('produk-form');
            const totalHargaInput = document.getElementById('total_harga');

            // Fungsi untuk menghitung total harga
            function hitungTotalHarga() {
                let totalHarga = 0;

                // Loop melalui setiap item produk yang ditambahkan
                const produkItems = produkForm.querySelectorAll('.produk-item');
                produkItems.forEach(item => {
                    const produkSelect = item.querySelector('.produk-select');
                    const jumlahProdukInput = item.querySelector('.jumlah-produk');

                    const hargaProduk = produkSelect.options[produkSelect.selectedIndex].getAttribute(
                        'data-harga');
                    const jumlahProduk = jumlahProdukInput.value;

                    if (hargaProduk && jumlahProduk) {
                        totalHarga += parseInt(hargaProduk) * parseInt(jumlahProduk);
                    }
                });

                // Update nilai total harga pada input
                totalHargaInput.value = totalHarga.toLocaleString('id-ID');
            }

            // Panggil fungsi hitungTotalHarga saat ada perubahan pada produk atau jumlah produk
            produkForm.addEventListener('change', hitungTotalHarga);
            produkForm.addEventListener('input', hitungTotalHarga);

            // Tombol untuk menambahkan produk
            const addProdukButton = document.querySelector('.add-produk');
            let produkCounter = 1;

            addProdukButton.addEventListener('click', function() {
                produkCounter++;

                const produkItem = `
            <div class="flex flex-wrap -mx-3 mb-6 produk-item">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label for="produk_id[]" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Produk</label>
                    <select id="produk_id[]" name="produk_id[]" class="produk-select appearance-none block w-full bg-gray-200 text-gray-700 border @error('produk_id.*') border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                        <option value="">Pilih Produk</option>
                        @foreach ($products as $item)
                            <option value="{{ $item->id }}" data-harga="{{ $item->harga }}">
                                {{ $item->nama_produk }} - Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label for="jumlah_produk[]" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Jumlah Produk</label>
                    <input id="jumlah_produk[]" type="number" name="jumlah_produk[]" class="jumlah-produk appearance-none block w-full bg-gray-200 text-gray-700 border @error('jumlah_produk.*') border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                </div>
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <button type="button" class="py-3 px-4 bg-red-500 text-white rounded-md mt-8 remove-produk">Hapus</button>
                </div>
            </div>
        `;

                // Tambahkan elemen baru ke dalam form
                produkForm.insertAdjacentHTML('beforeend', produkItem);

                // Panggil fungsi hitungTotalHarga saat menambahkan produk baru
                hitungTotalHarga();
            });

            // Tombol untuk menghapus produk
            produkForm.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-produk')) {
                    event.target.closest('.produk-item').remove();
                    hitungTotalHarga();
                }
            });

            // Panggil hitungTotalHarga saat halaman dimuat
            hitungTotalHarga();
        });
    </script>
@endsection
