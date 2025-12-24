<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-[#FEFAE0] leading-tight">
            👥 Personel & Akun
        </h2>
    </x-slot>

    <div class="pb-24 pt-4 px-2 max-w-xl mx-auto md:max-w-5xl relative min-h-screen">

        <div class="fixed bottom-0 left-0 p-10 pointer-events-none opacity-5 z-0">
            <img src="{{ asset('logo.jpeg') }}" class="w-96 h-96 object-contain grayscale" alt="Watermark">
        </div>

        <div class="relative z-10">

            <button onclick="openModal()" class="w-full bg-gradient-to-r from-gambus-primary to-[#6D5440] text-white rounded-2xl p-4 shadow-lg flex items-center justify-between mb-6 active:scale-95 transition hover:shadow-xl hover:scale-[1.01] border border-gambus-primary">
                <div class="flex items-center gap-3">
                    <div class="bg-white/10 p-2 rounded-full border border-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    </div>
                    <div class="text-left">
                        <h3 class="font-bold text-lg leading-tight text-[#FEFAE0]">Tambah Anggota</h3>
                        <p class="text-xs text-gambus-secondary">Buat akun login & data baru</p>
                    </div>
                </div>
                <div class="bg-white/10 p-2 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#FEFAE0]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </div>
            </button>

            <div class="flex justify-between items-center mb-3 px-1">
                <h3 class="font-bold text-gambus-primary text-base">Daftar Tim ({{ $members->count() }})</h3>
                <span class="text-[10px] text-gambus-secondary font-bold bg-[#FEFAE0] border border-gambus-secondary/30 px-2 py-1 rounded">Pass Default: 12345678</span>
            </div>

            <div class="space-y-2.5">
                @forelse($members as $member)
                <div class="bg-white p-3.5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3 hover:bg-[#FEFAE0] hover:border-gambus-secondary/30 transition relative overflow-hidden group">
                    
                    <div class="absolute left-0 top-0 bottom-0 w-1 {{ $member->status == 'active' ? 'bg-gambus-primary' : 'bg-gray-300' }}"></div>

                    <div class="w-11 h-11 rounded-full flex-shrink-0 flex items-center justify-center font-bold text-lg shadow-sm border border-gambus-secondary/20
                        {{ $loop->even ? 'bg-[#FEFAE0] text-gambus-primary' : 'bg-gambus-secondary/20 text-gambus-primary' }}">
                        {{ substr($member->full_name, 0, 1) }}
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-gambus-text truncate text-sm group-hover:text-gambus-primary transition">{{ $member->full_name }}</h4>
                            <span class="text-[10px] uppercase font-bold px-2 py-0.5 rounded-full bg-white text-gambus-secondary border border-gambus-secondary/30 ml-2">
                                {{ $member->position }}
                            </span>
                        </div>
                        <p class="text-[11px] text-gray-400 truncate">{{ $member->user->email ?? 'No Email' }}</p>
                        <p class="text-[11px] text-gambus-secondary font-medium mt-0.5">{{ $member->phone }}</p>
                    </div>

                    <div class="flex flex-col gap-1.5">
                        <a href="https://wa.me/{{ str_replace(['+','-',' '], '', $member->phone) }}" target="_blank" class="bg-[#FEFAE0] text-gambus-primary border border-gambus-secondary/30 p-1.5 rounded-full hover:bg-gambus-secondary hover:text-white transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.592 2.654-.696c1.029.575 1.956.883 3.037.883 3.185 0 5.771-2.586 5.772-5.766.001-3.181-2.586-5.767-5.773-5.767zm12 5.799c0 6.627-5.373 12-12 12s-12-5.373-12-12 5.373-12 12-12 12 5.373 12 12zm-4.384 1.258c-.529-.265-3.132-1.543-3.616-1.72-.486-.176-.84-.265-1.196.265-.353.529-1.368 1.72-1.676 2.074-.31.353-.618.397-1.148.132-2.697-1.36-4.473-3.794-5.068-4.81-.309-.529-.033-.815.231-1.079.24-.24.53-.618.795-.926.265-.309.353-.53.53-.882.176-.353.088-.662-.045-.926-.132-.265-1.196-2.882-1.637-3.946-.429-1.034-.87-1.005-1.196-1.005-.31 0-.665.006-1.02.006-.353 0-.927.132-1.412.662-.485.53-1.854 1.809-1.854 4.412 0 2.603 1.897 5.118 2.162 5.47.265.353 3.736 5.706 9.052 7.995 3.65 1.572 4.385 1.261 5.223 1.184.912-.083 2.924-1.196 3.337-2.35.411-1.155.411-2.144.288-2.35-.123-.206-.442-.324-.971-.589z"/></svg>
                        </a>
                        
                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Hapus anggota ini? Akun login juga akan hilang.')">
                            @csrf @method('DELETE')
                            <button class="bg-red-50 text-red-400 p-1.5 rounded-full hover:bg-red-100 hover:text-red-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <div class="bg-[#FEFAE0] rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-3 border border-gambus-secondary/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gambus-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <p class="text-gambus-primary text-sm">Belum ada anggota tim.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div id="memberModal" class="fixed inset-0 z-[60] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-[#2C1810] bg-opacity-80 transition-opacity backdrop-blur-sm" onclick="closeModal()"></div>

        <div class="flex items-end sm:items-center justify-center min-h-screen p-0 sm:p-4">
            <div class="bg-white rounded-t-3xl sm:rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all relative h-[85vh] sm:h-auto flex flex-col border-t-8 border-gambus-primary">
                
                <div class="bg-white px-6 py-4 border-b border-gray-100 flex justify-between items-center flex-shrink-0">
                    <div>
                        <h3 class="font-bold text-gambus-primary text-lg">Anggota Baru</h3>
                        <p class="text-[10px] text-gray-500 uppercase tracking-wide">Otomatis buat akun login</p>
                    </div>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 bg-gray-50 border border-gray-200 rounded-full p-2 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto flex-1 bg-[#FEFAE0]/20">
                    <form action="{{ route('members.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block text-[10px] font-bold text-gambus-primary mb-1 uppercase">Nama Lengkap</label>
                            <input type="text" name="full_name" class="w-full rounded-xl border-gray-200 text-sm focus:border-gambus-secondary focus:ring-gambus-secondary bg-white py-3" placeholder="Contoh: Ahmad Fulan" required>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gambus-primary mb-1 uppercase">Email (Untuk Login)</label>
                            <input type="email" name="email" class="w-full rounded-xl border-gray-200 text-sm focus:border-gambus-secondary focus:ring-gambus-secondary bg-white py-3" placeholder="email@contoh.com" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gambus-primary mb-1 uppercase">Posisi</label>
                                <select name="position" class="w-full rounded-xl border-gray-200 text-sm focus:border-gambus-secondary focus:ring-gambus-secondary bg-white py-3">
                                    <option value="Vokal">Vokal</option>
                                    <option value="Keyboard">Keyboard</option>
                                    <option value="Oud">Oud (Gambus)</option>
                                    <option value="Biola">Biola</option>
                                    <option value="Marawis">Marawis</option>
                                    <option value="Darbuka">Darbuka</option>
                                    <option value="Crew">Crew</option>
                                    <option value="MC">MC</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gambus-primary mb-1 uppercase">WhatsApp</label>
                                <input type="number" name="phone" class="w-full rounded-xl border-gray-200 text-sm focus:border-gambus-secondary focus:ring-gambus-secondary bg-white py-3" placeholder="0812..." required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gambus-primary mb-1 uppercase">Alamat Domisili</label>
                            <textarea name="address" rows="2" class="w-full rounded-xl border-gray-200 text-sm focus:border-gambus-secondary focus:ring-gambus-secondary bg-white py-3" placeholder="Jalan..."></textarea>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-gambus-primary text-white py-4 rounded-xl font-bold shadow-lg hover:bg-[#3E2D20] active:scale-95 transition-transform text-sm uppercase tracking-wide border border-gambus-primary">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('memberModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('memberModal').classList.add('hidden');
        }
    </script>
</x-app-layout>