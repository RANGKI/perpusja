<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'PerpusJa')</title>

  <!-- Tailwind & Font Awesome -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>

  <style>
    body { font-family: 'Poppins', sans-serif; }
  </style>
</head>
<body class="bg-white text-gray-800">
  @include('layouts.navbar')
  @include('layouts.sidebar_user')

  <main class="pt-20 px-6 md:ml-64 transition-all duration-300 ease-in-out">
    @yield('content')
  </main>

  @include('layouts.footer')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar');
        const hamburgerBtn = document.getElementById('hamburgerBtn');

        hamburgerBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    });
</script>


</body>
</html>
