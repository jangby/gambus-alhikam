<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Layanan Berhenti Sementara - Gambus Al-Hikam</title>
    
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
    <div class="relative flex items-top justify-center min-h-screen sm:items-center sm:pt-0">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col items-center pt-8 sm:justify-start sm:pt-0">
                
                <div class="mb-6 text-[#4A3728]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <div class="text-center px-4">
                    <h1 class="text-3xl font-bold tracking-tight text-[#2C1810] sm:text-4xl mb-4">
                        Masa Trial Berakhir
                    </h1>
                    
                    <p class="text-lg text-[#4A3728] leading-relaxed mb-8">
                        Mohon maaf, akses ke sistem pengelolaan <strong>Gambus Al-Hikam</strong> saat ini dinonaktifkan karena masa trial telah habis.
                    </p>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#D4A373] mb-8">
                        <p class="text-sm font-medium text-[#2C1810] mb-2">Informasi Perpanjangan:</p>
                        <p class="text-[#4A3728] text-sm leading-relaxed">
                            Silakan hubungi developer sistem untuk proses aktivasi kembali agar data dan layanan dapat diakses normal kembali.
                        </p>
                    </div>

                    <a href="https://wa.me/6281234567890" target="_blank" 
                       class="inline-flex items-center px-8 py-3 bg-[#4A3728] hover:bg-[#D4A373] text-[#FEFAE0] font-semibold rounded-full transition duration-300 ease-in-out shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                        Hubungi Tim Develover
                    </a>
                </div>

                <div class="mt-12 text-sm text-[#D4A373]">
                    &copy; {{ date('Y') }} Gambus Al-Hikam.
                </div>
            </div>
        </div>
    </div>
</body>
</html>