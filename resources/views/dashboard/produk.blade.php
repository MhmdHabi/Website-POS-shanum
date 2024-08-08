@extends('layouts.master')

@section('content')
    <div class="container mx-auto mt-2 lg:px-10">
        <h1 class="text-2xl font-bold mb-4 text-center">Daftar Produk</h1>

        <div class="flex justiy-start">
            <a href="{{ route('produk.create') }}"><button
                    class="px-4 py-2 bg-[#0463CA] text-white rounded-md w-full mb-2">Tambah</button></a>
        </div>

        @if (session('success'))
            <div id="successMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849l-4.849-4.849-4.849 4.849-1.414-1.414 4.849-4.849-4.849-4.849 1.414-1.414 4.849 4.849 4.849-4.849 1.414 1.414-4.849 4.849 4.849 4.849z" />
                    </svg>
                </span>
            </div>
        @endif

        {{-- Notifikasi Error --}}
        @if (session('error'))
            <div id="successMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative "
                role="alert">
                {{ session('error') }}
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M14.348 14.849l-4.849-4.849-4.849 4.849-1.414-1.414 4.849-4.849-4.849-4.849 1.414-1.414 4.849 4.849 4.849-4.849 1.414 1.414-4.849 4.849 4.849 4.849z" />
                    </svg>
                </span>
            </div>
        @endif

        <!-- Tabel Produk -->
        <div class="overflow-x-auto mt-2">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">No</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nama Produk</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Harga</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($product as $products)
                            <tr>
                                <td class="text-left py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="text-left py-3 px-4">{{ $products->nama_produk }}</td>
                                <td class="text-left py-3 px-4">Rp
                                    {{ number_format($products->harga, 0, ',', '.') }}</td>
                                <td class="text-left py-3 px-4">
                                    <a href="{{ route('produk.edit', $products->id) }}"><button
                                            class="bg-blue-500 hover:bg-blue-700 text-white w-full font-bold py-2 px-4 rounded mb-2">
                                            Edit
                                        </button></a>
                                    <form action="{{ route('produk.delete', $products->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-500 text-white rounded-md w-full">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
