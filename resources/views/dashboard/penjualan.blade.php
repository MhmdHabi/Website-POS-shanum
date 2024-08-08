@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-2 lg:px-10">
        <div class="py-3 lg:py-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 bg-gray-200 border-b border-gray-300">
                    <h2 class="text-lg font-semibold text-gray-800 text-center">Data Penjualan</h2>
                </div>
                <div class="px-6 py-4">
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    <div class="flex gap-3">
                        <a href="{{ route('penjualan.pdf') }}">
                            <button class="px-4 py-2 bg-[#0463CA] text-white rounded-md mb-2"><i
                                    class="fa-solid fa-file-pdf mr-2 text-white"></i>Cetak Pdf</button>
                        </a>
                        <a href="{{ route('export.penjualan') }}"><button
                                class="px-4 py-2 bg-amber-500 text-white rounded-md w-full mb-2"><i
                                    class="fa-solid fa-print mr-2 text-white"></i>Export Excel</button></a>
                    </div>
                    <div class="flex justify-between gap-1 lg:gap-0 mb-4 mt-1">
                        <input type="text" id="search"
                            class="border w-40 lg:w-60 border-gray-300 rounded-md py-1 px-2 lg:p-2"
                            placeholder=" Search...">
                        <select id="entries" class="border border-gray-300 rounded-md py-1 lg:p-2">
                            <option value="5">5 entries</option>
                            <option value="10">10 entries</option>
                            <option value="25">25 entries</option>
                            <option value="50">50 entries</option>
                            <option value="100">100 entries</option>
                        </select>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-300" id="datatable">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2 sortable" data-sort="id">#</th>
                                    <th class="px-4 py-2 sortable" data-sort="nama_pembeli">Nama Pembeli</th>
                                    <th class="px-4 py-2 sortable" data-sort="nama_produk">Produk</th>
                                    <th class="px-4 py-2 sortable" data-sort="harga">Harga Produk</th>
                                    <th class="px-4 py-2 sortable" data-sort="jumlah_produk">Jumlah Produk</th>
                                    <th class="px-4 py-2 sortable" data-sort="total_harga">Total Harga</th>
                                    <th class="px-4 py-2 sortable" data-sort="created_at">Tanggal Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penjualans as $key => $penjualan)
                                    <tr class="text-center">
                                        <td class="border px-4 py-2">{{ $key + 1 }}</td>
                                        <td class="border px-4 py-2">{{ $penjualan->nama_pembeli }}</td>
                                        <td class="border px-4 py-2">{{ $penjualan->product->nama_produk }}</td>
                                        <td class="border px-4 py-2">Rp
                                            {{ number_format($penjualan->product->harga, 0, ',', '.') }}</td>
                                        <td class="border px-4 py-2">{{ $penjualan->jumlah_produk }}</td>
                                        <td class="border px-4 py-2">Rp
                                            {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                                        <td class="border px-4 py-2">
                                            {{ $penjualan->created_at->format('d-m-Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-between mt-4">
                        <div id="info" class="text-gray-600"></div>
                        <div id="pagination" class="flex space-x-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Manual DataTables Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.querySelector('#datatable');
            const searchInput = document.querySelector('#search');
            const entriesSelect = document.querySelector('#entries');
            const info = document.querySelector('#info');
            const pagination = document.querySelector('#pagination');

            let currentPage = 1;
            let rowsPerPage = parseInt(entriesSelect.value);
            let rows = Array.from(table.querySelector('tbody').rows);

            function renderTable() {
                const filteredRows = rows.filter(row => {
                    return Array.from(row.cells).some(cell => {
                        return cell.textContent.toLowerCase().includes(searchInput.value
                            .toLowerCase());
                    });
                });

                const start = (currentPage - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                const paginatedRows = filteredRows.slice(start, end);

                table.querySelector('tbody').innerHTML = '';
                paginatedRows.forEach(row => table.querySelector('tbody').appendChild(row));

                updateInfo(filteredRows.length);
                renderPagination(filteredRows.length);
            }

            function updateInfo(totalRows) {
                const start = (currentPage - 1) * rowsPerPage + 1;
                const end = Math.min(currentPage * rowsPerPage, totalRows);
                info.textContent = `Showing ${start} to ${end} of ${totalRows} entries`;
            }

            function renderPagination(totalRows) {
                pagination.innerHTML = '';
                const totalPages = Math.ceil(totalRows / rowsPerPage);
                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement('button');
                    button.textContent = i;
                    button.classList.add('px-2', 'py-1', 'border', 'rounded', i === currentPage ? 'bg-blue-500' :
                        'bg-gray-200');
                    button.addEventListener('click', () => {
                        currentPage = i;
                        renderTable();
                    });
                    pagination.appendChild(button);
                }
            }

            searchInput.addEventListener('input', renderTable);
            entriesSelect.addEventListener('change', () => {
                rowsPerPage = parseInt(entriesSelect.value);
                currentPage = 1;
                renderTable();
            });

            table.querySelectorAll('.sortable').forEach(header => {
                header.addEventListener('click', () => {
                    const sortKey = header.dataset.sort;
                    const order = header.dataset.order === 'asc' ? 'desc' : 'asc';
                    header.dataset.order = order;

                    rows.sort((a, b) => {
                        const cellA = a.querySelector(
                            `td:nth-child(${header.cellIndex + 1})`).textContent.trim();
                        const cellB = b.querySelector(
                            `td:nth-child(${header.cellIndex + 1})`).textContent.trim();

                        if (sortKey === 'harga' || sortKey === 'total_harga') {
                            return order === 'asc' ? cellA - cellB : cellB - cellA;
                        }

                        if (sortKey === 'created_at') {
                            return order === 'asc' ? new Date(cellA) - new Date(cellB) :
                                new Date(cellB) - new Date(cellA);
                        }

                        return order === 'asc' ? cellA.localeCompare(cellB) : cellB
                            .localeCompare(cellA);
                    });

                    renderTable();
                });
            });

            renderTable();
        });
    </script>
@endsection
