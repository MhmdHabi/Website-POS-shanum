@extends('layouts.master')

@section('content')
    <div class="container flex flex-col items-center mt-2 lg:px-10">
        <div class="border p-5 w-full max-w-lg rounded-lg bg-gray-300">
            <h1 class="text-2xl font-bold mb-4 text-center">Edit Produk</h1>
            <div class="mb-4 text-left">
                <a href="{{ route('dashboard.produk') }}"
                    class="bg-amber-500 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Kembali
                </a>
            </div>

            <form action="{{ route('produk.update', $product->id) }}" method="POST" class="w-full max-w-lg">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" id="nama_produk" name="nama_produk" value="{{ $product->nama_produk }}"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 p-2 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('nama_produk')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" id="harga" name="harga" value="{{ $product->harga }}"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 p-2 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('harga')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-500 text-white w-full rounded-md hover:bg-blue-600">Simpan
                    Perubahan</button>
            </form>
        </div>
    </div>
@endsection
