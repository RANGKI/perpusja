    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Perpusja')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    </head>
    <body class="font-[Poppins] text-sm bg-gray-900">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <nav class="w-[300px] bg-[#3D3BA0] text-white flex flex-col items-center p-5 relative">
        <div class="text-xl mt-1 font-bold">Admin</div>
        <h1 class="text-5xl font-bold mb-16 mt-0 leading-none">Perpus<span class="text-[#3D3BA0] bg-white px-1 rounded">Ja</span>
        </h1>

        <div class="w-full">
            <ul class="space-y-6">
            <li>
                <a href="/admin/data_personal" class="flex items-center bg-white text-black text-xl px-4 py-4 mx-2 rounded-lg shadow hover:bg-blue-300 transition-all">
                <i class="fa-solid fa-user mr-3 text-2xl"></i> Data Personal
                </a>
            </li>
            <li>
                <a href="/admin/data_stock" class="flex items-center bg-white text-black text-xl px-4 py-4 mx-2 rounded-lg shadow hover:bg-blue-300 transition-all">
                <i class="fa-solid fa-store mr-3 text-2xl"></i> Data Stock
                </a>
            </li>
            <li>
                <a href="/admin/data_pinjaman" class="flex items-center bg-white text-black text-xl px-4 py-4 mx-2 rounded-lg shadow hover:bg-blue-300 transition-all">
                <i class="fa-solid fa-lock mr-3 text-2xl"></i> Data Pinjaman
                </a>
            </li>
            <li>
                <a href="/admin/data_admin" class="flex items-center bg-white text-black text-xl px-4 py-4 mx-2 rounded-lg shadow hover:bg-blue-300 transition-all">
                <i class="fa-solid fa-gears mr-3 text-2xl"></i> Admins
                </a>
            </li>
            </ul>
        </div>

<div class="absolute bottom-6 left-6 flex items-center space-x-3">
    <img src="{{ asset('storage/' . session('image_path')) }}" alt="Admin Image" class="w-12 h-12 object-cover rounded-full">
    <span class="text-lg font-semibold">{{ session('username') }}</span>

    <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <button type="submit" title="Logout">
            <i class="fa-solid fa-right-from-bracket text-white text-xl hover:text-red-400"></i>
        </button>
    </form>
</div>

        </nav>

        <!-- Main Content -->
        <main class="flex-grow bg-white px-10 py-8 overflow-y-auto">
        @yield('content')
        </main>
    </div>
    <x-confirm-modal />
    </body>
    </html>
