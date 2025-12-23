<x-app-layout>
    <div class="-mt-4 -mx-4 bg-gray-50 min-h-screen pb-24">
        
        <div class="bg-gradient-to-br from-emerald-900 to-teal-800 pt-10 pb-24 rounded-b-[40px] shadow-lg relative overflow-hidden text-center">
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-20">
                <div class="absolute -top-20 -left-20 w-60 h-60 bg-emerald-400 rounded-full blur-3xl"></div>
                <div class="absolute top-20 -right-20 w-40 h-40 bg-white rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10">
                <div class="mx-auto w-24 h-24 bg-white p-1 rounded-full shadow-xl mb-3">
                    <div class="w-full h-full bg-gray-100 rounded-full flex items-center justify-center overflow-hidden">
                        <span class="text-3xl font-bold text-gray-400">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </span>
                    </div>
                </div>
                <h2 class="text-xl font-bold text-white tracking-wide">{{ Auth::user()->name }}</h2>
                <p class="text-emerald-200 text-sm">{{ Auth::user()->email }}</p>
                <div class="mt-2 inline-block px-3 py-1 bg-white/10 backdrop-blur-md rounded-full border border-white/20">
                    <span class="text-xs font-bold text-emerald-50 uppercase tracking-wider">
                        {{ Auth::user()->role == 'admin' ? 'Administrator' : 'Anggota Resmi' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="px-5 -mt-12 relative z-20 space-y-6">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-emerald-50 px-5 py-3 border-b border-emerald-100 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <h3 class="font-bold text-emerald-800 text-sm">Informasi Pribadi</h3>
                </div>
                <div class="p-5">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-orange-50 px-5 py-3 border-b border-orange-100 flex items-center gap-2">
                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <h3 class="font-bold text-orange-800 text-sm">Keamanan Akun</h3>
                </div>
                <div class="p-5">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-white text-gray-600 font-bold py-4 rounded-2xl shadow-sm border border-gray-200 flex items-center justify-center gap-2 hover:bg-gray-50 active:scale-[0.98] transition">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar dari Aplikasi
                </button>
            </form>

            <div class="pt-6 pb-4">
                <div class="bg-red-50 rounded-2xl border border-red-100 p-5 opacity-80 hover:opacity-100 transition">
                    <h4 class="text-red-800 font-bold text-sm mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        Zona Bahaya
                    </h4>
                    <div class="text-red-600 text-sm">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>