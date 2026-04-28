<nav class="fixed bottom-4 left-4 right-4 z-[9999]">
    <div class="bg-white border border-gray-200 shadow-2xl rounded-2xl px-6 py-3 flex justify-between items-center">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="flex flex-col items-center gap-1 group transition-all duration-300 {{ request()->routeIs('dashboard') ? 'scale-110' : 'opacity-60' }}">
            <div class="p-2 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-pink-100 text-pink-600 shadow-sm' : 'text-gray-500' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
            <span class="text-[10px] font-bold {{ request()->routeIs('dashboard') ? 'text-pink-600' : 'text-gray-400' }}">Home</span>
        </a>

        <!-- Absensi -->
        <a href="{{ route('absensi_pendampingan.index') }}" 
           class="flex flex-col items-center gap-1 group transition-all duration-300 {{ request()->routeIs('absensi_pendampingan.*') ? 'scale-110' : 'opacity-60' }}">
            <div class="p-2 rounded-xl {{ request()->routeIs('absensi_pendampingan.*') ? 'bg-indigo-100 text-indigo-600 shadow-sm' : 'text-gray-500' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </div>
            <span class="text-[10px] font-bold {{ request()->routeIs('absensi_pendampingan.*') ? 'text-indigo-600' : 'text-gray-400' }}">Absensi</span>
        </a>

        <!-- Kebiasaan -->
        <a href="{{ route('kebiasaan_baik.index') }}" 
           class="flex flex-col items-center gap-1 group transition-all duration-300 {{ request()->routeIs('kebiasaan_baik.*') ? 'scale-110' : 'opacity-60' }}">
            <div class="p-2 rounded-xl {{ request()->routeIs('kebiasaan_baik.*') ? 'bg-orange-100 text-orange-600 shadow-sm' : 'text-gray-500' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <span class="text-[10px] font-bold {{ request()->routeIs('kebiasaan_baik.*') ? 'text-orange-600' : 'text-gray-400' }}">Ceklis</span>
        </a>

        <!-- Rapor -->
        <a href="{{ route('rapor_asuh.index') }}" 
           class="flex flex-col items-center gap-1 group transition-all duration-300 {{ request()->routeIs('rapor_asuh.*') ? 'scale-110' : 'opacity-60' }}">
            <div class="p-2 rounded-xl {{ request()->routeIs('rapor_asuh.*') ? 'bg-green-100 text-green-600 shadow-sm' : 'text-gray-500' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <span class="text-[10px] font-bold {{ request()->routeIs('rapor_asuh.*') ? 'text-green-600' : 'text-gray-400' }}">Rapor</span>
        </a>

        <!-- Profile -->
        <a href="{{ route('profile.edit') }}" 
           class="flex flex-col items-center gap-1 group transition-all duration-300 {{ request()->routeIs('profile.edit') ? 'scale-110' : 'opacity-60' }}">
            <div class="p-2 rounded-xl {{ request()->routeIs('profile.edit') ? 'bg-blue-100 text-blue-600 shadow-sm' : 'text-gray-500' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <span class="text-[10px] font-bold {{ request()->routeIs('profile.edit') ? 'text-blue-600' : 'text-gray-400' }}">Profil</span>
        </a>
    </div>
</nav>
