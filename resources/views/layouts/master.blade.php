<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shanum Bakery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <style>
        .fixed-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 50;
        }

        .active {
            @apply text-blue-600 font-bold;
        }
    </style>
</head>

<body class="bg-gray-100">
    <header>
        @include('component.navbar')
    </header>

    <main class="mt-16 flex justify-center items-center p-4">
        @yield('content')
    </main>
    </div>

    <script>
        // Toggle mobile menu
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
            document.getElementById('menu-toggle').classList.add('hidden');
            document.getElementById('menu-close').classList.remove('hidden');
        });

        // Close mobile menu
        document.getElementById('menu-close').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.add('hidden');
            document.getElementById('menu-toggle').classList.remove('hidden');
            document.getElementById('menu-close').classList.add('hidden');
        });
    </script>
</body>

</html>
