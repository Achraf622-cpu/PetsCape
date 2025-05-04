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
        
        @media (max-width: 768px) {
            .sidebar-open {
                transform: translateX(0);
            }
            
            .sidebar-closed {
                transform: translateX(-100%);
            }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-[#FDFAF6]">
<div class="min-h-screen flex relative">
    <!-- Mobile menu button - visible on small screens -->
    <button id="mobile-menu-button" class="md:hidden fixed top-4 left-4 z-30 p-2 bg-white rounded-full shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#2F2E41]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Sidebar with responsive classes -->
    <div id="sidebar-container" class="transition-transform duration-300 md:translate-x-0 transform -translate-x-full md:relative fixed z-20 h-screen">
        @include('admin.components.adminsidebar')
    </div>

    <!-- Main content with responsive margin -->
    <main id="main-content" class="md:ml-64 ml-0 flex-1 p-4 md:p-8 w-full">
        <header class="flex justify-between items-center mb-8 pt-8 md:pt-0">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-[#2F2E41]">@yield('page-title')</h1>
                <p class="text-sm md:text-base text-gray-600">@yield('page-subtitle')</p>
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

<!-- Add JavaScript for mobile menu toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar-container');
        const mainContent = document.getElementById('main-content');
        
        menuButton.addEventListener('click', function() {
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('translate-x-0');
        });
        
        // Close sidebar when clicking outside on mobile
        mainContent.addEventListener('click', function() {
            if (window.innerWidth < 768 && sidebar.classList.contains('translate-x-0')) {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
            }
        });
    });
</script>

@stack('scripts')
</body>
</html>
