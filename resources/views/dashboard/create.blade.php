@extends('layouts.master')

@section('content')
    <div class="container mx-auto flex flex-col items-center mt-2 lg:px-10">
        <div class="border p-5 rounded-lg bg-gray-300">
            <h1 class="text-2xl font-bold mb-4 text-center">Tambah Produk Baru</h1>

            <!-- Tombol Kembali -->
            <div class="mb-4 text-left">
                <a href="{{ route('dashboard.produk') }}"
                    class="bg-amber-500 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Kembali
                </a>
            </div>

            <!-- Form Tambah Produk -->
            <form action="{{ route('produk.store') }}" method="POST" class="w-full max-w-lg">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label for="nama_produk"
                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nama
                            Produk</label>
                        <input id="nama_produk" type="text" name="nama_produk" value="{{ old('nama_produk') }}"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('nama_produk') border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                        @error('nama_produk')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full px-3 md:mb-0">
                        <label for="harga"
                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Harga</label>
                        <input id="harga" type="number" name="harga" value="{{ old('harga') }}"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('harga') border-red-500 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                        @error('harga')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
