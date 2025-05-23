<aside class="fixed md:relative left-0 top-0 w-64 h-screen bg-white shadow-lg flex flex-col z-20 overflow-y-auto">
    <!-- Mobile close button - only visible on small screens -->
    <button id="close-sidebar" class="md:hidden absolute top-4 right-4 p-2 text-gray-600 hover:text-gray-900">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    
    <div class="flex flex-col h-full justify-between">
        <!-- Top Section -->
        <div>
            <!-- Logo -->
            <div class="p-6 border-b">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#FF6B6B] rounded-full"></div>
                    <span class="font-bold text-xl text-[#2F2E41]">PetsCape</span>
                </a>
            </div>

            <!-- Menu -->
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#FFE3E3] {{ request()->routeIs('admin.dashboard') ? 'bg-[#FFE3E3] text-[#FF6B6B]' : 'text-gray-600' }}">
                            <span class="text-xl">📊</span>
                            <span>Tableau de bord</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.animals') }}"
                           class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#FFE3E3] {{ request()->routeIs('admin.animals') ? 'bg-[#FFE3E3] text-[#FF6B6B]' : 'text-gray-600' }}">
                            <span class="text-xl">🐾</span>
                            <span>Animaux</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.appointments') }}"
                           class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#FFE3E3] {{ request()->routeIs('admin.appointments') ? 'bg-[#FFE3E3] text-[#FF6B6B]' : 'text-gray-600' }}">
                            <span class="text-xl">📅</span>
                            <span>Rendez-vous</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.adoptions') }}"
                           class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#FFE3E3] {{ request()->routeIs('admin.adoptions') ? 'bg-[#FFE3E3] text-[#FF6B6B]' : 'text-gray-600' }}">
                            <span class="text-xl">💝</span>
                            <span>Adoptions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users') }}"
                           class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#FFE3E3] {{ request()->routeIs('admin.users') ? 'bg-[#FFE3E3] text-[#FF6B6B]' : 'text-gray-600' }}">
                            <span class="text-xl">👥</span>
                            <span>Utilisateurs</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reports') }}"
                           class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#FFE3E3] {{ request()->routeIs('admin.reports') ? 'bg-[#FFE3E3] text-[#FF6B6B]' : 'text-gray-600' }}">
                            <span class="text-xl">🚩</span>
                            <span>Signalements</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.donations') }}"
                           class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#FFE3E3] {{ request()->routeIs('admin.donations') ? 'bg-[#FFE3E3] text-[#FF6B6B]' : 'text-gray-600' }}">
                            <span class="text-xl">💰</span>
                            <span>Dons</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Bottom Section -->
        <div class="p-4 border-t">
            <!-- User Info - Simplified -->
            <div class="flex items-center p-2 mb-3">
                <div>
                    <p class="font-semibold text-[#2F2E41]">{{ Auth::user()->name }}</p>
                </div>
            </div>
            
            <!-- Actions -->
            <a href="/" class="flex items-center gap-3 p-2 rounded-xl hover:bg-[#FFE3E3] text-gray-600 mb-3">
                <span class="text-xl">🏠</span>
                <span>Retour au site</span>
            </a>
            
            <!-- Logout Button with enhanced visibility -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 p-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-colors shadow-md border-2 border-[#FF6B6B]">
                    <span class="text-xl">🚪</span>
                    <span class="font-semibold">Déconnexion</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<script>
    // Mobile sidebar close button functionality
    document.addEventListener('DOMContentLoaded', function() {
        const closeButton = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('sidebar-container');
        
        closeButton.addEventListener('click', function() {
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('translate-x-0');
        });
    });
</script>
