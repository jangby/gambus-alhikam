<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"> 
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 pb-24"> 
        
        @if (isset($header))
            <header class="bg-emerald-900 shadow sticky top-0 z-40">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-white font-bold text-center text-lg">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main class="px-4 mt-4 pb-24"> 
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm relative" role="alert">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                    <button onclick="this.parentElement.style.display='none'" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </button>
                </div>
            @endif

            {{ $slot }} </main>

        <nav class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 flex justify-between px-2 md:justify-around items-center py-2 z-50 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] pb-safe safe-area-pb">
            
    {{-- ================= MENU ADMIN (4 ITEM SAJA) ================= --}}
    @if(Auth::user()->role == 'admin')
        
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center w-full p-1 {{ request()->routeIs('dashboard') ? 'text-emerald-600' : 'text-gray-400 hover:text-emerald-500' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-[10px] font-bold">Beranda</span>
        </a>

        <a href="{{ route('admin.bookings.index') }}" class="flex flex-col items-center w-full p-1 {{ request()->routeIs('admin.bookings.*') || request()->routeIs('calendar.*') ? 'text-emerald-600' : 'text-gray-400 hover:text-emerald-500' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <span class="text-[10px] font-bold">Jadwal</span>
        </a>

        <a href="{{ route('finance.index') }}" class="flex flex-col items-center w-full p-1 {{ request()->routeIs('finance.*') ? 'text-emerald-600' : 'text-gray-400 hover:text-emerald-500' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-[10px] font-bold">Kas</span>
        </a>

        <a href="{{ route('members.index') }}" class="flex flex-col items-center w-full p-1 {{ request()->routeIs('members.*') ? 'text-emerald-600' : 'text-gray-400 hover:text-emerald-500' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span class="text-[10px] font-bold">Anggota</span>
        </a>

        <form method="POST" action="{{ route('logout') }}" class="w-10 border-l pl-2 ml-1">
            @csrf
            <button type="submit" class="text-red-300 hover:text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
            </button>
        </form>
    
    {{-- ================= MENU MEMBER ================= --}}
    @elseif(Auth::user()->role == 'member')

    <a href="{{ route('member.dashboard') }}" class="flex flex-col items-center w-full p-1 {{ request()->routeIs('member.dashboard') ? 'text-emerald-600' : 'text-gray-400 hover:text-emerald-500' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="text-[10px] font-bold">Beranda</span>
    </a>

    <a href="{{ route('member.schedule') }}" class="flex flex-col items-center w-full p-1 {{ request()->routeIs('member.schedule') ? 'text-emerald-600' : 'text-gray-400 hover:text-emerald-500' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <span class="text-[10px] font-bold">Jadwal</span>
    </a>

    <a href="{{ route('member.finance') }}" class="flex flex-col items-center w-full p-1 {{ request()->routeIs('member.finance') ? 'text-emerald-600' : 'text-gray-400 hover:text-emerald-500' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-[10px] font-bold">Kas</span>
    </a>

    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center w-full p-1 {{ request()->routeIs('profile.*') ? 'text-emerald-600' : 'text-gray-400 hover:text-emerald-500' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        <span class="text-[10px] font-bold">Akun</span>
    </a>

@endif
</nav>
    </body>
</html>