<x-app-layout>
    <x-slot name="header">Overview</x-slot>

    <div class="mb-8 bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden relative">
            <div class="p-6 sm:p-10 relative z-10 flex flex-col sm:flex-row items-center justify-between">
                <div class="text-center sm:text-left mb-4 sm:mb-0 flex-1">
                <h2
                    class="text-2xl sm:text-4xl font-extrabold mb-3 text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-green-500">
                    Selamat Datang, {{ Auth::user()->name }}!
                </h2>
                <p class="text-gray-600 text-sm sm:text-base">Mulai harimu dengan senyuman dan terus berikan yang
                    terbaik.</p>
            </div>
            <div class="hidden sm:block flex-shrink-0 ml-6">
                <img src="{{ asset('asuh.png') }}"
                    class="h-32 object-contain hover:scale-105 transition-transform duration-300">
            </div>
        </div>
    </div>

    @if(Auth::user()->role === 'kakak_asuh')
    <!-- Akses Cepat (Quick Menus) untuk Kakak Asuh -->
    <div class="mb-8">
        <h3 class="text-xs sm:text-sm font-bold text-gray-800 uppercase tracking-wider mb-4">Akses Cepat</h3>
        <div class="flex gap-2 sm:gap-6 justify-between">
            <!-- Absensi -->
            <a href="{{ route('absensi_pendampingan.index') }}" class="bg-white rounded-2xl py-4 px-1 flex-1 flex flex-col items-center justify-center text-gray-600 border border-gray-100 shadow-sm hover:shadow-md hover:border-pink-200 hover:-translate-y-1 transition-all group">
                <div class="p-2 sm:p-3 bg-pink-50 rounded-full mb-2 group-hover:bg-pink-100 transition-colors">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-[9px] sm:text-xs font-bold text-center tracking-wide leading-tight truncate w-full group-hover:text-pink-600 transition-colors">Absensi</span>
            </a>
            <!-- Kebiasaan -->
            <a href="{{ route('kebiasaan_baik.index') }}" class="bg-white rounded-2xl py-4 px-1 flex-1 flex flex-col items-center justify-center text-gray-600 border border-gray-100 shadow-sm hover:shadow-md hover:border-pink-200 hover:-translate-y-1 transition-all group">
                <div class="p-2 sm:p-3 bg-pink-50 rounded-full mb-2 group-hover:bg-pink-100 transition-colors">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
                <span class="text-[9px] sm:text-xs font-bold text-center tracking-wide leading-tight truncate w-full group-hover:text-pink-600 transition-colors">Kebiasaan</span>
            </a>
            <!-- Rapor -->
            <a href="{{ route('rapor_asuh.index') }}" class="bg-white rounded-2xl py-4 px-1 flex-1 flex flex-col items-center justify-center text-gray-600 border border-gray-100 shadow-sm hover:shadow-md hover:border-pink-200 hover:-translate-y-1 transition-all group">
                <div class="p-2 sm:p-3 bg-pink-50 rounded-full mb-2 group-hover:bg-pink-100 transition-colors">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <span class="text-[9px] sm:text-xs font-bold text-center tracking-wide leading-tight truncate w-full group-hover:text-pink-600 transition-colors">Rapor</span>
            </a>
            <!-- Program -->
            <a href="{{ route('rencana-program.index') }}" class="bg-white rounded-2xl py-4 px-1 flex-1 flex flex-col items-center justify-center text-gray-600 border border-gray-100 shadow-sm hover:shadow-md hover:border-pink-200 hover:-translate-y-1 transition-all group">
                <div class="p-2 sm:p-3 bg-pink-50 rounded-full mb-2 group-hover:bg-pink-100 transition-colors">
                    <svg class="w-5 h-5 sm:w-7 sm:h-7 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <span class="text-[9px] sm:text-xs font-bold text-center tracking-wide leading-tight truncate w-full group-hover:text-pink-600 transition-colors">Program</span>
            </a>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-2 {{ Auth::user()->role === 'kakak_asuh' ? 'lg:grid-cols-4 gap-3 sm:gap-6' : 'sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6' }}">
        <div class="bg-white p-4 sm:p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <h3 class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Anak Asuh</h3>
                <p class="text-xl sm:text-2xl font-black text-gray-800">{{ $totalAnak }}</p>
            </div>
            <div class="p-2 sm:p-3 bg-pink-50 text-pink-500 rounded-lg">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                    </path>
                </svg>
            </div>
        </div>

        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin')
            <a href="{{ route('admin.rekrutmen.pendaftar.index') }}"
                class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-green-500 flex items-center justify-between hover:shadow-md transition-all group">
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Pelamar Baru</h3>
                    <p class="text-2xl font-black text-gray-800">{{ $pendingRekrutmen ?? 0 }}</p>
                </div>
                <div class="p-3 bg-green-50 text-green-500 rounded-lg group-hover:scale-110">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
            </a>
            <a href="{{ route('rencana-program.index', ['status' => 'Menunggu']) }}"
                class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-yellow-400 flex items-center justify-between hover:shadow-md transition-all group">
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Persetujuan Program</h3>
                    <p class="text-2xl font-black text-gray-800">{{ $pendingProgram ?? 0 }}</p>
                </div>
                <div class="p-3 bg-yellow-50 text-yellow-600 rounded-lg group-hover:scale-110">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                        </path>
                    </svg>
                </div>
            </a>
            <div
                class="bg-white p-5 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-blue-500 flex items-center justify-between">
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Validasi Logbook</h3>
                    <p class="text-2xl font-black text-gray-800">{{ $pendingLogbook ?? 0 }}</p>
                </div>
                <div class="p-3 bg-blue-50 text-blue-500 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </div>
            </div>
        @else
            <a href="{{ route('absensi_pendampingan.index') }}"
                class="bg-white p-4 sm:p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-all group">
                <div>
                    <h3 class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Absensi</h3>
                    <p class="text-xl sm:text-2xl font-black text-gray-800">{{ $absensiBulanIni }}</p>
                </div>
                <div class="p-2 sm:p-3 bg-green-50 text-green-500 rounded-lg group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </a>
            <a href="{{ route('rencana-program.index') }}"
                class="bg-white p-4 sm:p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-all group">
                <div>
                    <h3 class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Program</h3>
                    <p class="text-xl sm:text-2xl font-black text-gray-800">{{ $programAktif ?? 0 }}</p>
                </div>
                <div class="p-2 sm:p-3 bg-blue-50 text-blue-500 rounded-lg group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </a>
            <div class="bg-white p-4 sm:p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Logbook</h3>
                    <p class="text-xl sm:text-2xl font-black text-gray-800">{{ $logbookPending ?? 0 }}</p>
                </div>
                <div class="p-2 sm:p-3 bg-yellow-50 text-yellow-600 rounded-lg">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
            </div>
        @endif

        <div
            class="bg-gradient-to-br from-pink-500 to-rose-600 p-4 sm:p-5 rounded-xl shadow-lg flex items-center justify-between text-white col-span-2 sm:col-span-1">
            <div>
                <h3 class="text-[10px] sm:text-xs font-bold text-pink-100 uppercase tracking-wider mb-1">Keanggotaan</h3>
                <p class="text-lg sm:text-xl font-black capitalize">{{ Auth::user()->role }}</p>
            </div>
            <div class="p-2 sm:p-3 bg-white bg-opacity-20 rounded-lg">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                    </path>
                </svg>
            </div>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
        @if(isset($chartAnakData))
            <!-- Chart: Anak Asuh per Tahun -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Pertumbuhan Anak Asuh</h3>
                        <p class="text-xs text-gray-500">Jumlah pendaftaran anak asuh baru per tahun</p>
                    </div>
                    <div class="p-2 bg-pink-50 text-pink-500 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
                <div class="h-[300px]">
                    <canvas id="chartAnakAsuh"></canvas>
                </div>
            </div>

            <!-- Chart: Penyaluran Dana per Bulan -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Rekap Penyaluran Dana
                            {{ date('Y') }}</h3>
                        <p class="text-xs text-gray-500">Total nominal penyaluran dana (Rp) per bulan</p>
                    </div>
                    <div class="p-2 bg-green-50 text-green-500 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="h-[300px]">
                    <canvas id="chartPenyaluran"></canvas>
                </div>
            </div>
        @endif
    </div>

    @if(isset($chartAnakData))
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Chart Anak Asuh
                const ctxAnak = document.getElementById('chartAnakAsuh').getContext('2d');
                new Chart(ctxAnak, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($chartAnakLabels) !!},
                        datasets: [{
                            label: 'Jumlah Anak Asuh',
                            data: {!! json_encode($chartAnakData) !!},
                            backgroundColor: 'rgba(236, 72, 153, 0.2)',
                            borderColor: 'rgb(236, 72, 153)',
                            borderWidth: 2,
                            borderRadius: 5,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { stepSize: 1 }
                            }
                        }
                    }
                });

                // Chart Penyaluran
                const ctxPenyaluran = document.getElementById('chartPenyaluran').getContext('2d');
                new Chart(ctxPenyaluran, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($chartPenyaluranLabels) !!},
                        datasets: [{
                            label: 'Total Dana (Rp)',
                            data: {!! json_encode($chartPenyaluranData) !!},
                            backgroundColor: 'rgba(34, 197, 94, 0.2)',
                            borderColor: 'rgb(34, 197, 94)',
                            borderWidth: 2,
                            borderRadius: 5,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        return 'Total: Rp' + new Intl.NumberFormat('id-ID').format(context.raw);
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function (value) {
                                        if (value >= 1000000) return 'Rp' + (value / 1000000) + 'jt';
                                        return 'Rp' + new Intl.NumberFormat('id-ID').format(value);
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endif
</x-app-layout>