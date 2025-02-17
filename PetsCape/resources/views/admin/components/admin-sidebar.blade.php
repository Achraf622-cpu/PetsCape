<aside class="fixed left-0 top-0 w-64 h-screen bg-white shadow-lg">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="p-6 border-b">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <img src="/images/logo.png" alt="PetsCape" class="w-10 h-10">
                <span class="font-bold text-xl text-[#2F2E41]">PetsCape</span>
            </a>
        </div>

        <!-- Menu -->
        <nav class="flex-1 p-4">
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
                        <span class="text-xl">📊</span>
                        <span>Rapports</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Profil -->
        <div class="p-4 border-t">
            <div class="flex items-center gap-3 p-3">
                <img src="{{ Auth::user()->avatar ?? '/images/default-avatar.png' }}"
                     alt="Profile"
                     class="w-10 h-10 rounded-full">
                <div>
                    <p class="font-semibold text-[#2F2E41]">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-600">Administrateur</p>
                </div>
            </div>
        </div>
    </div>
</aside>
