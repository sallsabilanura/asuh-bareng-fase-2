<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-2">
                    <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Galeri Asuh
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kumpulan momen pendampingan dari kakak asuh.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($galeri as $item)
                    <div x-data="{ openModal: false }" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300 flex flex-col group cursor-pointer" @click="openModal = true">
                        <div class="relative overflow-hidden aspect-[4/3] bg-gray-50">
                            <img src="{{ Storage::url($item->FotoBukti) }}" alt="Foto Pendampingan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-3 left-3 right-3 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <p class="text-xs font-medium bg-pink-500/90 inline-block px-2 py-1 rounded-md mb-1">{{ \Carbon\Carbon::parse($item->Tanggal)->translatedFormat('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="p-4 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="bg-pink-50 rounded-full p-1.5 text-pink-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                </div>
                                <div class="text-xs">
                                    <p class="font-semibold text-gray-800">{{ $item->anakAsuh->NamaLengkap ?? 'Anonim' }}</p>
                                    <p class="text-gray-500">Bersama: {{ $item->kakakAsuh->user->name ?? 'Anonim' }}</p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 line-clamp-3 leading-relaxed mt-auto">{{ $item->DeskripsiPerkembangan }}</p>
                        </div>
                        
                        <!-- Modal -->
                        <div x-show="openModal" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4 cursor-default" style="display: none;" @click.stop>
                            <div @click.outside="openModal = false" class="relative w-full max-w-4xl mx-auto flex justify-center">
                                <button @click="openModal = false" class="absolute -top-12 right-0 text-white/70 hover:text-white transition">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                                <img src="{{ Storage::url($item->FotoBukti) }}" class="w-auto h-auto max-h-[85vh] rounded shadow-2xl object-contain bg-white">
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                            <div class="mx-auto w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">Belum Ada Galeri</h3>
                            <p class="text-gray-500">Foto bukti dari absensi pendampingan akan muncul di sini.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            
            @if($galeri->hasPages())
                <div class="mt-8">
                    {{ $galeri->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
