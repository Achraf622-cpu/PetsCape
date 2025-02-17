<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - PetsCape Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-[#FDFAF6]">
<div class="min-h-screen flex">
    @include('admin.components.adminsidebar')

    <!-- Contenu principal -->
    <main class="ml-64 flex-1 p-8">
        <!-- En-tête -->
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-[#2F2E41]">@yield('page-title')</h1>
                <p class="text-gray-600">@yield('page-subtitle')</p>
            </div>

            <!-- Profil Admin -->
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="font-bold text-[#2F2E41]">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                </div>
                <img src="{{ Auth::user()->avatar }}" alt="Admin" class="w-10 h-10 rounded-full">
            </div>
        </header>

        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>
