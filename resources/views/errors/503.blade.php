<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>System Maintenance - Cloud Service Suspension</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #FEFAE0; /* gambus.bg */
            color: #2C1810;           /* gambus.text */
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
    <div class="relative flex items-center justify-center min-h-screen p-6">
        <div class="max-w-md w-full bg-white rounded-xl shadow-2xl overflow-hidden border-t-4 border-[#4A3728]">
            
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <span class="text-xs font-mono text-gray-500">SYS_ID: ALHIKAM-PRJ-01</span>
                <span class="px-2 py-1 bg-red-100 text-red-600 text-[10px] font-bold rounded uppercase">Suspended</span>
            </div>

            <div class="p-8">
                <div class="flex justify-center mb-6">
                    <div class="p-4 bg-orange-50 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#D4A373]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>

                <div class="text-center">
                    <h2 class="text-xl font-extrabold text-[#2C1810] mb-2 uppercase tracking-wide">
                        Layanan Dinonaktifkan
                    </h2>
                    <p class="text-sm text-gray-600 mb-6">
                        Akses ke database dan penyimpanan awan (Cloud Storage) untuk proyek <strong>Gambus Al-Hikam</strong> telah dihentikan secara otomatis oleh sistem.
                    </p>

                    <div class="text-left bg-gray-50 rounded-lg p-4 mb-6 border border-gray-200">
                        <h3 class="text-xs font-bold text-gray-400 uppercase mb-3 tracking-widest">Detail Status Server:</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center justify-between text-sm">
                                <span class="text-gray-600 font-medium">Core VPS Node</span>
                                <span class="text-red-500 font-bold italic">Expired</span>
                            </li>
                            <li class="flex items-center justify-between text-sm">
                                <span class="text-gray-600 font-medium">Database Management</span>
                                <span class="text-red-500 font-bold italic">Suspended</span>
                            </li>
                            <li class="flex items-center justify-between text-sm">
                                <span class="text-gray-600 font-medium">Storage & Assets</span>
                                <span class="text-red-500 font-bold italic">Locked</span>
                            </li>
                        </ul>
                    </div>

                    <p class="text-[13px] text-gray-500 leading-relaxed mb-6">
                        Data Anda tetap aman di server kami. Harap segera hubungi departemen teknis (Developer) untuk sinkronisasi ulang billing server dan pemulihan data.
                    </p>

                    <a href="https://wa.me/628xxxxxxx" 
                       class="block w-full py-3 bg-[#4A3728] hover:bg-[#D4A373] text-white text-sm font-bold rounded-lg transition duration-200 shadow-md">
                        HUBUNGI TEKNISI SISTEM
                    </a>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-3 text-center border-t border-gray-100">
                <p class="text-[10px] text-gray-400 italic">
                    Automated System Message - Please do not reply directly to this server.
                </p>
            </div>
        </div>
    </div>
</body>
</html>