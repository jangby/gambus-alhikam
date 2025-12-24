<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name', 'Gambus Al-Hikam') }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Background Image */
        .bg-login {
            /* Gambar background tetap sama, atau bisa diganti gambar tekstur kayu/batik */
            background-image: url('https://images.unsplash.com/photo-1519744531200-c1115e416d74?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }

        /* Efek Kaca (Glassmorphism) */
        .glass-card {
            background: rgba(255, 255, 255, 0.9); /* Sedikit lebih solid agar kontras dengan teks coklat */
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-top: 4px solid #D4A373; /* Aksen Emas di atas */
        }
    </style>
</head>
<body class="antialiased text-gambus-text bg-login min-h-screen flex items-center justify-center relative overflow-hidden">

    <div class="absolute inset-0 bg-[#2C1810]/70 z-0"></div>

    <div class="absolute top-10 left-10 w-72 h-72 bg-gambus-secondary rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-pulse z-0"></div>
    <div class="absolute bottom-10 right-10 w-72 h-72 bg-gambus-primary rounded-full mix-blend-screen filter blur-3xl opacity-30 animate-pulse z-0" style="animation-delay: 2s"></div>

    <div class="relative z-10 w-full max-w-sm px-4">
        
        <div class="flex justify-center mb-6">
            <div class="bg-white p-3 rounded-2xl shadow-xl shadow-black/20">
                <x-application-logo class="w-12 h-12 object-contain" />
            </div>
        </div>

        <div class="glass-card rounded-[2.5rem] p-8 shadow-2xl">
            
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gambus-primary">Selamat Datang</h2>
                <p class="text-sm text-gray-500 mt-1">Masuk untuk mengelola Gambus Al-Hikam</p>
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-gambus-primary bg-[#FEFAE0] p-3 rounded-xl text-center border border-gambus-secondary/30">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 bg-red-50 text-red-600 p-3 rounded-xl text-xs border border-red-100">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-gambus-primary transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        class="w-full pl-12 pr-4 py-4 rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-gambus-secondary focus:ring-gambus-secondary text-sm font-medium transition-all shadow-sm placeholder-gray-400 text-gambus-text"
                        placeholder="Email Address">
                </div>

                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-gambus-primary transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input id="password" type="password" name="password" required
                        class="w-full pl-12 pr-12 py-4 rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-gambus-secondary focus:ring-gambus-secondary text-sm font-medium transition-all shadow-sm placeholder-gray-400 text-gambus-text"
                        placeholder="Password">
                    
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gambus-primary focus:outline-none transition-colors">
                        <svg id="eyeIcon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label for="remember_me" class="inline-flex items-center text-gray-600 cursor-pointer hover:text-gambus-primary">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-gambus-primary shadow-sm focus:ring-gambus-secondary" name="remember">
                        <span class="ml-2 font-medium">Ingat Saya</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-bold text-gambus-primary hover:text-[#2C1810] transition-colors">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-gambus-primary to-[#8B6E4E] text-white font-bold py-4 rounded-xl shadow-lg shadow-gambus-primary/30 hover:shadow-gambus-primary/50 hover:scale-[1.02] transition-all duration-200 text-sm uppercase tracking-wide">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-gambus-primary transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
        
        <p class="text-center text-[#FEFAE0]/70 text-xs mt-8 font-light">
            &copy; {{ date('Y') }} Gambus Al-Hikam Management
        </p>
    </div>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.getElementById("eyeIcon");
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                passwordInput.type = "password";
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }
    </script>
</body>
</html>