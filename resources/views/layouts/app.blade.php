<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset('asuh saja.png') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Playfair+Display:wght@500;600&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            /* Custom Scrollbar for horizontal scrolling areas to be visible on mobile */
            .overflow-x-auto::-webkit-scrollbar {
                -webkit-appearance: none;
                height: 6px;
                background-color: transparent;
            }
            .overflow-x-auto::-webkit-scrollbar-track {
                background: #f1f5f9;
                border-radius: 10px;
            }
            .overflow-x-auto::-webkit-scrollbar-thumb {
                background-color: #cbd5e1;
                border-radius: 10px;
                border: 1px solid #f1f5f9;
            }
            .overflow-x-auto::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
            /* Force scrollbar to be visible in some mobile browsers if possible */
            .overflow-x-auto {
                scrollbar-width: thin;
                scrollbar-color: #cbd5e1 transparent;
                -webkit-overflow-scrolling: touch;
            }
        </style>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased text-gray-900" x-data="{ sidebarOpen: false }">
        <div class="flex min-h-screen bg-gray-50 {{ Auth::check() && Auth::user()->role === 'kakak_asuh' ? 'pb-16 md:pb-0' : '' }}">
            <!-- Sidebar -->
            <div class="{{ Auth::check() && Auth::user()->role === 'kakak_asuh' ? 'hidden md:block' : '' }}">
                @include('layouts.sidebar')
            </div>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0">
                <!-- Navbar -->
                <nav class="bg-white border-b border-gray-200 shadow-sm px-4 sm:px-6 py-3 flex justify-between items-center">
                    <div class="flex items-center">
                        <!-- Mobile Menu Button -->
                        @if(!Auth::check() || Auth::user()->role !== 'kakak_asuh')
                        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700 focus:outline-none md:hidden mr-4">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        @else
                            @if(!request()->routeIs('dashboard'))
                                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-pink-600 focus:outline-none mr-3 flex items-center bg-gray-50 p-2 rounded-full border border-gray-100 transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </a>
                            @endif
                        @endif
                        <h2 class="text-xl font-semibold text-gray-800">
                            {{ $header ?? 'Dashboard' }}
                        </h2>
                    </div>

                    <div class="flex items-center space-x-4">
                        @auth
                        <!-- Profile Dropdown -->
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center space-x-3 group focus:outline-none">
                                    <div class="text-right hidden sm:block">
                                        <p class="text-sm font-semibold text-gray-800 group-hover:text-pink-600 transition-colors">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                                    </div>
                                    <div class="relative">
                                        @php
                                            $avatarPath = null;
                                            if (Auth::user()->kakakAsuh && Auth::user()->kakakAsuh->Foto) {
                                                $avatarPath = Auth::user()->kakakAsuh->Foto;
                                            } elseif (Auth::user()->avatar) {
                                                $avatarPath = Auth::user()->avatar;
                                            }
                                        @endphp

                                        @if($avatarPath)
                                            <img src="{{ asset('storage/' . $avatarPath) }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover border-2 border-pink-100 group-hover:border-pink-300 transition-all shadow-sm">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center border-2 border-pink-50 group-hover:border-pink-200 transition-all shadow-sm">
                                                <span class="text-pink-400 text-sm font-bold uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-2 border-b border-gray-100 sm:hidden">
                                    <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                                </div>
                                
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Lihat Profil') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                        @endauth
                    </div>
                </nav>

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto">
                    <div class="p-4 sm:p-8">
                        <div class="max-w-7xl mx-auto">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- Bottom Navigation for Kakak Asuh on Mobile -->
        @if(Auth::check() && Auth::user()->role === 'kakak_asuh')
        <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50 flex justify-around items-center h-16 px-2 shadow-[0_-4px_15px_rgba(0,0,0,0.05)]" style="padding-bottom: env(safe-area-inset-bottom);">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center w-full h-full text-[10px] {{ request()->routeIs('dashboard') ? 'text-pink-600 font-bold' : 'text-gray-400 hover:text-pink-500' }}">
                <svg class="w-6 h-6 mb-1 {{ request()->routeIs('dashboard') ? 'text-pink-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Home
            </a>
            <a href="{{ route('absensi_pendampingan.index') }}" class="flex flex-col items-center justify-center w-full h-full text-[10px] {{ request()->routeIs('absensi_pendampingan.*') ? 'text-pink-600 font-bold' : 'text-gray-400 hover:text-pink-500' }}">
                <svg class="w-6 h-6 mb-1 {{ request()->routeIs('absensi_pendampingan.*') ? 'text-pink-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Absensi
            </a>
            <!-- Central Action Button (Optional, modern mobile style) -->
            <div class="relative flex flex-col items-center justify-center w-full h-full -mt-5">
                <a href="{{ route('absensi_pendampingan.create') }}" class="bg-gradient-to-r from-pink-500 to-rose-500 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg shadow-pink-500/40 hover:scale-105 transition-transform border-4 border-gray-50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </a>
            </div>
            <a href="{{ route('galeri.index') }}" class="flex flex-col items-center justify-center w-full h-full text-[10px] {{ request()->routeIs('galeri.*') ? 'text-pink-600 font-bold' : 'text-gray-400 hover:text-pink-500' }}">
                <svg class="w-6 h-6 mb-1 {{ request()->routeIs('galeri.*') ? 'text-pink-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Galeri
            </a>
            <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center w-full h-full text-[10px] {{ request()->routeIs('profile.*') ? 'text-pink-600 font-bold' : 'text-gray-400 hover:text-pink-500' }}">
                <svg class="w-6 h-6 mb-1 {{ request()->routeIs('profile.*') ? 'text-pink-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Akun
            </a>
        </div>
        @endif
    </body>
</html>
