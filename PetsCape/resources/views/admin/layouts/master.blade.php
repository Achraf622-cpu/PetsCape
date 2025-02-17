<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - PetsCape Admin</title>

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Comfortaa', cursive;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-[#FDFAF6]">
<div class="min-h-screen flex">
    @include('admin.components.adminsidebar')

    <main class="ml-64 flex-1 p-8">
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-[#2F2E41]">@yield('page-title')</h1>
                <p class="text-gray-600">@yield('page-subtitle')</p>
            </div>

            <div class="flex items-center gap-4">
                <button class="p-2 hover:bg-gray-100 rounded-full">
                    <span class="text-xl">🔔</span>
                </button>
                <button class="p-2 hover:bg-gray-100 rounded-full">
                    <span class="text-xl">⚙️</span>
                </button>
            </div>
        </header>

        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>
