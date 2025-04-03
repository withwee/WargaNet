<aside class="bg-blue-600 text-white w-64 h-full fixed left-0 items-center gap-6 p-6 flex flex-col">
    <div class="text-3xl ">
        <span class="font-extrabold">Warga</span><span class="text-gray-200">Net</span>
    </div>
    <nav class="flex flex-col gap-4">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 py-2 px-4 rounded-xl font-semibold transition 
           {{ request()->routeIs('dashboard') ? 'bg-white text-blue-600' : 'text-gray-200 hover:text-white hover:bg-blue-500' }}">
            <iconify-icon icon="mdi:view-dashboard" class="text-xl"></iconify-icon>
            Dashboard
        </a>
        <a href="{{ route('pengumuman') }}"
           class="flex items-center gap-3 py-2 px-4 rounded-xl transition 
           {{ request()->routeIs('pengumuman') ? 'bg-white text-blue-600' : 'text-gray-200 hover:text-white hover:bg-blue-500' }}">
            <iconify-icon icon="mdi:bullhorn-outline" class="text-xl"></iconify-icon>
            Pengumuman
        </a>
        <a href="{{ route('forum') }}"
           class="flex items-center gap-3 py-2 px-4 rounded-xl transition 
           {{ request()->routeIs('forum') ? 'bg-white text-blue-600' : 'text-gray-200 hover:text-white hover:bg-blue-500' }}">
            <iconify-icon icon="mdi:forum-outline" class="text-xl"></iconify-icon>
            Forum
        </a>
        <a href="{{ route('bayar-iuran') }}"
           class="flex items-center gap-3 py-2 px-4 rounded-xl transition 
           {{ request()->routeIs('bayar-iuran') ? 'bg-white text-blue-600' : 'text-gray-200 hover:text-white hover:bg-blue-500' }}">
            <iconify-icon icon="mdi:cash-multiple" class="text-xl"></iconify-icon>
            Bayar Iuran
        </a>
        <a href="{{ route('kalender') }}"
           class="flex items-center gap-3 py-2 px-4 rounded-xl transition 
           {{ request()->routeIs('kalender') ? 'bg-white text-blue-600' : 'text-gray-200 hover:text-white hover:bg-blue-500' }}">
            <iconify-icon icon="mdi:calendar-month-outline" class="text-xl"></iconify-icon>
            Kalender
        </a>
        
    </nav>
</aside>
