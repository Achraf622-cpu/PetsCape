<aside class="w-64 bg-white shadow-sm fixed h-full">
    <div class="p-6">
        {{-- Logo et titre --}}
        <div class="flex items-center gap-3 mb-8">
            <div class="w-8 h-8 bg-[#FF6B6B] rounded-full"></div>
            <span class="font-bold text-xl text-[#2F2E41]">PetsCape</span>
        </div>

        {{-- Navigation --}}
        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-[#FFE3E3] text-[#FF6B6B]' : 'text-gray-600 hover:bg-[#FFE3E3] hover:text-[#FF6B6B]' }}">
                📊 Tableau de bord
            </a>
            <a href="{{ route('admin.animals') }}" class="flex items-center gap-3 p-3 rounded-xl {{ request()->routeIs('admin.animals') ? 'bg-[#FFE3E3] text-[#FF6B6B]' : 'text-gray-600 hover:bg-[#FFE3E3] hover:text-[#FF6B6B]' }}">
                🐾 Animaux
            </a>
            <a href="{{ route('admin.appointments') }}" class="flex items-center gap-3 p-3 rounded-xl {{ request()->routeIs('admin.appointments') ? 'bg-[#FFE3E3] text-[#FF6B6B]' : 'text-gray-600 hover:bg-[#FFE3E3] hover:text-[#FF6B6B]' }}">
                📅 Rendez-vous
            </a>
            <a href="{{ route('admin.adoptions') }}" class="flex items-center gap-3 p-3 rounded-xl {{ request()->routeIs('admin.adoptions') ? 'bg-[#FFE3E3] text-[#FF6B6B]' : 'text-gray-600 hover:bg-[#FFE3E3] hover:text-[#FF6B6B]' }}">
                📝 Adoptions
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center gap-3 p-3 rounded-xl {{ request()->routeIs('admin.users') ? 'bg-[#FFE3E3] text-[#FF6B6B]' : 'text-gray-600 hover:bg-[#FFE3E3] hover:text-[#FF6B6B]' }}">
                👥 Utilisateurs
            </a>
            <a href="{{ route('admin.reports') }}" class="flex items-center gap-3 p-3 rounded-xl {{ request()->routeIs('admin.reports') ? 'bg-[#FFE3E3] text-[#FF6B6B]' : 'text-gray-600 hover:bg-[#FFE3E3] hover:text-[#FF6B6B]' }}">
                🚨 Signalements
            </a>
        </nav>
    </div>
</aside>
