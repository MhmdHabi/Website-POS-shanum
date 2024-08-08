<nav class="bg-white shadow-lg py-2 px-4 lg:px-14 fixed-navbar">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-black text-2xl font-bold">Shanum Bakery</a>

        <!-- Mobile menu button -->
        <div class="block lg:hidden">
            <button id="menu-toggle"
                class="text-black focus:outline-none focus:text-black focus:bg-gray-700 px-2 py-1 rounded">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            <button id="menu-close"
                class="text-black hidden focus:outline-none focus:text-black focus:bg-gray-700 px-2 py-1 rounded">
                <i class="fas fa-times fa-lg"></i>
            </button>
        </div>

        <!-- Desktop menu -->
        <div class="hidden lg:block">
            <a href="{{ route('dashboard') }}" class="text-black mx-2">Home</a>
            <a href="{{ route('dashboard.produk') }}" class="text-black mx-2">Produk</a>
            <a href="{{ route('dashboard.laporan') }}" class="text-black mx-2">Pembeli</a>
            <a href="{{ route('penjualan.index') }}" class="text-black mx-2">Data Penjualan</a>
        </div>

        <!-- Image for desktop -->
        <img id="profile-picture" src="{{ asset('asset/bakery_logo.png') }}" alt="Profile Picture"
            class="hidden lg:block w-56 lg:w-20 object-cover p-0">
    </div>


    <!-- Mobile menu items -->
    <div id="mobile-menu"
        class="lg:hidden bg-gray-200 mt-2 p-2 text-black rounded-md shadow-lg absolute w-48 right-4 top-16 hidden">
        <a href="{{ route('dashboard') }}" class="block py-2 px-4 hover:bg-blue-600">Home</a>
        <a href="{{ route('dashboard.produk') }}" class="block py-2 px-4 hover:bg-blue-600">Produk</a>
        <a href="{{ route('dashboard.laporan') }}" class="block py-2 px-4 hover:bg-blue-600">Pembeli</a>
        <a href="{{ route('penjualan.index') }}" class="block py-2 px-4 hover:bg-blue-600">Data Penjualan</a>
    </div>
</nav>
