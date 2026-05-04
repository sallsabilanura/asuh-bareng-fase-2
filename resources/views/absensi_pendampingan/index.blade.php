<x-app-layout>
    <x-slot name="header">
        Daftar Absensi Pendampingan
    </x-slot>

    <x-index-header 
        title="Riwayat Absensi Pendampingan" 
        subtitle="Pantau daftar riwayat absensi dan perkembangan pelaksanaan aktivitas pendampingan." 
    />

    <!-- Filter Section (Ultra Compact Mobile) -->
    <div class="bg-white p-3 sm:p-5 rounded-2xl shadow-sm border border-gray-100 mb-6 border-l-4 border-l-pink-500 overflow-hidden" x-data="{ openFilter: false }">
        <form action="{{ route('absensi_pendampingan.index') }}" method="GET" class="space-y-3">
            <!-- Main Row: Search + Filter Toggle -->
            <div class="flex items-center gap-2">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-3.5 w-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama anak..." class="pl-8 w-full rounded-xl border-gray-100 bg-gray-50/50 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-xs py-2">
                </div>
                
                <button type="button" @click="openFilter = !openFilter" :class="openFilter ? 'bg-pink-600 text-white' : 'bg-pink-50 text-pink-600 border border-pink-100'" class="p-2 rounded-xl transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                </button>

                <button type="submit" class="bg-gray-900 text-white p-2 rounded-xl hover:bg-gray-800 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>

            <!-- Advanced Filters (Collapsible) -->
            <div x-show="openFilter" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="pt-3 border-t border-gray-50 space-y-3" style="display: none;">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                    @if(Auth::user()->role === 'admin')
                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Kakak Asuh</label>
                        <select name="kakak_asuh_id" class="w-full rounded-xl border-gray-100 bg-gray-50/50 text-xs py-2 focus:border-pink-500 focus:ring-pink-500">
                            <option value="">Semua Kakak</option>
                            @foreach($kakakAsuhs as $kakak)
                                <option value="{{ $kakak->KakakAsuhID }}" {{ request('kakak_asuh_id') == $kakak->KakakAsuhID ? 'selected' : '' }}>
                                    {{ $kakak->NamaLengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div>
                        <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Anak Asuh</label>
                        <select name="anak_asuh_id" class="w-full rounded-xl border-gray-100 bg-gray-50/50 text-xs py-2 focus:border-pink-500 focus:ring-pink-500">
                            <option value="">Semua Anak</option>
                            @foreach($anakAsuhs as $anak)
                                <option value="{{ $anak->id }}" {{ request('anak_asuh_id') == $anak->id ? 'selected' : '' }}>
                                    {{ $anak->NamaLengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Bulan</label>
                            <select name="bulan" class="w-full rounded-xl border-gray-100 bg-gray-50/50 text-xs py-2 focus:border-pink-500 focus:ring-pink-500">
                                <option value="">Bulan</option>
                                @foreach(range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1">Tahun</label>
                            <select name="tahun" class="w-full rounded-xl border-gray-100 bg-gray-50/50 text-xs py-2 focus:border-pink-500 focus:ring-pink-500">
                                <option value="">Tahun</option>
                                @foreach(range(date('Y') - 2, date('Y') + 2) as $y)
                                    <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @if(request()->anyFilled(['search', 'kakak_asuh_id', 'anak_asuh_id', 'bulan', 'tahun']))
                <div class="flex justify-end">
                    <a href="{{ route('absensi_pendampingan.index') }}" class="text-[10px] text-gray-400 hover:text-pink-600 font-bold uppercase tracking-widest flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Reset Filter
                    </a>
                </div>
                @endif
            </div>

            <!-- Stats & Quick Actions Row -->
            <div class="flex flex-wrap items-center justify-between gap-3 pt-2">
                @if($totalSessions !== null)
                <div class="flex gap-2">
                    <div class="flex items-center gap-2 bg-pink-50/50 px-3 py-1.5 rounded-xl border border-pink-100">
                        <p class="text-[10px] font-black text-pink-600 leading-none">{{ $totalSessions }} <span class="text-[8px] font-bold text-pink-400 uppercase">Sesi</span></p>
                    </div>
                    @if(Auth::user()->role === 'admin')
                    <div class="flex items-center gap-2 bg-green-50/50 px-3 py-1.5 rounded-xl border border-green-100">
                        <p class="text-[10px] font-black text-green-600 leading-none">Rp{{ number_format($totalKafalah, 0, ',', '.') }}</p>
                    </div>
                    @endif
                </div>
                @endif

                <div class="flex items-center gap-2 ml-auto">
                    @if(Auth::user()->role !== 'admin')
                    <a href="{{ route('absensi_pendampingan.create') }}" class="bg-pink-600 hover:bg-pink-700 text-white text-[10px] font-bold py-2 px-4 rounded-xl flex items-center gap-1.5 transition-all shadow-sm shadow-pink-200">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        TAMBAH
                    </a>
                    @endif
                    <a href="{{ route('absensi_pendampingan.export_pdf', request()->query()) }}" class="bg-gray-100 text-gray-600 p-2 rounded-xl hover:bg-gray-200 transition-colors" title="Export PDF">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    </a>
                </div>
            </div>
        </form>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anak Asuh</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kakak Asuh</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                        @if(Auth::user()->role === 'admin')
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kafalah</th>
                        @endif
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($absensis as $index => $absensi)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $absensis->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $absensi->anakAsuh->NamaLengkap ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $absensi->kakakAsuh->NamaLengkap ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $absensi->JenisPendampingan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $absensi->Tanggal }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $absensi->WaktuMulai }} - {{ $absensi->WaktuSelesai }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $absensi->NilaiPendampingan }} ({{ $absensi->NilaiHuruf }})</td>
                            @if(Auth::user()->role === 'admin')
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">Rp{{ number_format($absensi->kafalah, 0, ',', '.') }}</td>
                            @endif
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('absensi_pendampingan.show', $absensi->AbsensiID) }}" class="text-pink-600 hover:text-pink-900 mr-3">Detail</a>
                                <a href="{{ route('absensi_pendampingan.export_pdf', ['anak_asuh_id' => $absensi->AnakAsuhID]) }}" class="text-red-600 hover:text-red-900 mr-3">Cetak</a>
                                <a href="{{ route('absensi_pendampingan.edit', $absensi->AbsensiID) }}" class="text-pink-600 hover:text-pink-900 mr-3">Edit</a>
                                <form action="{{ route('absensi_pendampingan.destroy', $absensi->AbsensiID) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $absensis->links() }}
        </div>
    </div>
</x-app-layout>
