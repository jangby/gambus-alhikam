<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"> <title>Booking Acara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    
    <style>
        /* Hide Scrollbar for cleaner look */
        ::-webkit-scrollbar { width: 0px; background: transparent; }
        
        /* Custom Font sizing for mobile */
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }
        
        /* Status Colors */
        .status-available { color: #10b981; font-weight: 600; font-size: 0.85rem; display: flex; align-items: center; gap: 4px; margin-top: 6px; }
        .status-booked { color: #ef4444; font-weight: 600; font-size: 0.85rem; display: flex; align-items: center; gap: 4px; margin-top: 6px; }

        /* Bottom Sheet Animation */
        .bottom-sheet {
            transition: transform 0.3s ease-out;
            transform: translateY(100%);
        }
        .bottom-sheet.open {
            transform: translateY(0);
        }
        
        /* FullCalendar Mobile Tweaks */
        .fc-toolbar-title { font-size: 1.1rem !important; font-weight: 700; }
        .fc-button { padding: 4px 8px !important; font-size: 0.8rem !important; }
        .fc-daygrid-day-number { font-size: 0.9rem; text-decoration: none !important; color: #374151; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 pb-24"> <nav class="fixed top-0 w-full bg-white/90 backdrop-blur-md z-40 border-b border-gray-100 px-4 h-16 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-3">
            <a href="{{ url('/') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 transition active:scale-95">
                <svg class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <div>
                <h1 class="font-bold text-lg text-gray-900 leading-tight">Form Booking</h1>
                <p class="text-[10px] text-gray-500 leading-tight">Isi data acara Anda</p>
            </div>
        </div>
        </nav>

    <div class="pt-20 px-7 max-w-lg mx-auto">

        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-2xl p-4 flex items-start gap-3 shadow-sm">
            <div class="bg-green-100 p-2 rounded-full text-green-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-green-800 text-sm">Berhasil!</h3>
                <p class="text-xs text-green-700 mt-1 leading-relaxed">{{ session('success') }}</p>
                <a href="{{ url('/') }}" class="text-xs font-bold text-green-800 underline mt-2 inline-block">Kembali ke Home</a>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4 flex items-start gap-3 shadow-sm">
            <div class="bg-red-100 p-2 rounded-full text-red-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-red-800 text-sm">Gagal!</h3>
                <p class="text-xs text-red-700 mt-1">{{ session('error') }}</p>
            </div>
        </div>
        @endif
        
        <form action="{{ route('booking.store') }}" method="POST" id="bookingForm" class="space-y-6">
            @csrf
            
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <h3 class="text-emerald-800 font-bold text-sm uppercase tracking-wider mb-4 border-l-4 border-emerald-500 pl-3">Data Pemesan</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-semibold text-gray-500 ml-1 mb-1 block">Nama Lengkap</label>
                        <input type="text" name="booker_name" value="{{ old('booker_name') }}" required 
                            class="w-full bg-gray-50 border-transparent focus:border-emerald-500 focus:bg-white focus:ring-0 rounded-2xl px-4 py-3.5 text-sm font-medium transition-all"
                            placeholder="Nama Pemesan / CP">
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-gray-500 ml-1 mb-1 block">No. WhatsApp</label>
                        <input type="tel" name="booker_phone" value="{{ old('booker_phone') }}" required 
                            class="w-full bg-gray-50 border-transparent focus:border-emerald-500 focus:bg-white focus:ring-0 rounded-2xl px-4 py-3.5 text-sm font-medium transition-all"
                            placeholder="08xxxxxxxxxx">
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-emerald-50 to-white rounded-3xl p-5 shadow-sm border border-emerald-100">
                <h3 class="text-emerald-800 font-bold text-sm uppercase tracking-wider mb-4 border-l-4 border-emerald-500 pl-3">Waktu & Tempat</h3>

                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-semibold text-gray-500 ml-1 mb-1 block">Tanggal Acara</label>
                        <div class="relative" onclick="openCalendar()">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-lg">📅</span>
                            </div>
                            <input type="text" id="display_date" readonly 
                                class="w-full bg-white border border-emerald-200 text-emerald-900 rounded-2xl pl-12 pr-4 py-3.5 text-sm font-bold shadow-sm focus:ring-2 focus:ring-emerald-200 cursor-pointer placeholder-emerald-300"
                                placeholder="Pilih Tanggal...">
                            
                            <input type="hidden" id="event_date" name="event_date" value="{{ old('event_date') }}">
                        </div>
                        
                        <div id="date-status" class="ml-1"></div>
                        <div id="loading-status" class="hidden ml-1 mt-2 text-xs text-gray-500 flex items-center gap-2">
                            <svg class="animate-spin h-3 w-3" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Mengecek jadwal...
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-gray-500 ml-1 mb-1 block">Jam Mulai</label>
                        <input type="time" name="event_time" value="{{ old('event_time') }}" required 
                            class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3.5 text-sm font-medium focus:border-emerald-500 focus:ring-0">
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-gray-500 ml-1 mb-1 block">Lokasi (Alamat)</label>
                        <textarea name="venue_address" rows="2" required 
                            class="w-full bg-white border border-gray-200 rounded-2xl px-4 py-3 text-sm font-medium focus:border-emerald-500 focus:ring-0"
                            placeholder="Nama Gedung / Jalan...">{{ old('venue_address') }}</textarea>
                    </div>

                    <div>
                         <div>
    <div class="flex justify-between items-end mb-2 ml-1">
        <label class="text-xs font-semibold text-gray-500">Link Google Maps</label>
        
        <button type="button" onclick="openMapsHelp()" class="flex items-center gap-1 text-[10px] text-blue-600 font-bold bg-blue-50 px-3 py-1.5 rounded-full hover:bg-blue-100 transition active:scale-95">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Panduan Salin Link
        </button>
    </div>
</div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <input type="url" name="location_gmaps" value="{{ old('location_gmaps') }}" 
                                class="w-full bg-white border border-gray-200 rounded-2xl pl-10 pr-4 py-3.5 text-sm text-blue-600 underline placeholder-gray-400 focus:border-emerald-500 focus:ring-0"
                                placeholder="https://maps.google.com/...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="bg-white rounded-3xl p-5 shadow-sm border border-blue-100">
                    <h3 class="text-blue-800 font-bold text-sm uppercase tracking-wider mb-4 border-l-4 border-blue-500 pl-3">Mempelai Pria</h3>
                    <div class="space-y-3">
                        <input type="text" name="groom_name" placeholder="Nama Pria" class="w-full bg-blue-50/50 border-transparent rounded-2xl px-4 py-3 text-sm focus:bg-white focus:border-blue-400 focus:ring-0 transition-all">
                        <div class="grid grid-cols-2 gap-3">
                            <input type="text" name="groom_father" placeholder="Nama Ayah" class="w-full bg-blue-50/50 border-transparent rounded-2xl px-4 py-3 text-sm focus:bg-white focus:border-blue-400 focus:ring-0 transition-all">
                            <input type="text" name="groom_mother" placeholder="Nama Ibu" class="w-full bg-blue-50/50 border-transparent rounded-2xl px-4 py-3 text-sm focus:bg-white focus:border-blue-400 focus:ring-0 transition-all">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-5 shadow-sm border border-pink-100">
                    <h3 class="text-pink-800 font-bold text-sm uppercase tracking-wider mb-4 border-l-4 border-pink-500 pl-3">Mempelai Wanita</h3>
                    <div class="space-y-3">
                        <input type="text" name="bride_name" placeholder="Nama Wanita" class="w-full bg-pink-50/50 border-transparent rounded-2xl px-4 py-3 text-sm focus:bg-white focus:border-pink-400 focus:ring-0 transition-all">
                        <div class="grid grid-cols-2 gap-3">
                            <input type="text" name="bride_father" placeholder="Nama Ayah" class="w-full bg-pink-50/50 border-transparent rounded-2xl px-4 py-3 text-sm focus:bg-white focus:border-pink-400 focus:ring-0 transition-all">
                            <input type="text" name="bride_mother" placeholder="Nama Ibu" class="w-full bg-pink-50/50 border-transparent rounded-2xl px-4 py-3 text-sm focus:bg-white focus:border-pink-400 focus:ring-0 transition-all">
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-5 shadow-sm border border-gray-100 mb-8">
                 <h3 class="text-gray-800 font-bold text-sm uppercase tracking-wider mb-4 border-l-4 border-gray-500 pl-3">Request / Catatan</h3>
                 <input type="text" name="event_theme" class="w-full bg-gray-50 border-transparent focus:border-gray-400 focus:bg-white focus:ring-0 rounded-2xl px-4 py-3.5 text-sm" placeholder="Contoh: Nuansa Putih / Lagu Khusus...">
            </div>

        </form>
    </div>

    <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 p-4 z-30 shadow-[0_-5px_15px_rgba(0,0,0,0.05)]">
        <div class="max-w-lg mx-auto">
            <button type="submit" form="bookingForm" id="submitBtn" class="w-full bg-emerald-600 text-white font-bold text-base py-3.5 rounded-2xl shadow-lg shadow-emerald-200 active:scale-[0.98] transition-all flex justify-center items-center gap-2 disabled:bg-gray-300 disabled:shadow-none disabled:cursor-not-allowed">
                <span>Kirim Booking</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>
    </div>

    <div id="calendarOverlay" class="fixed inset-0 bg-black/50 z-50 hidden transition-opacity opacity-0" onclick="closeCalendar()"></div>
    
    <div id="calendarSheet" class="fixed bottom-0 left-0 right-0 bg-white z-[60] rounded-t-3xl shadow-2xl bottom-sheet max-h-[85vh] flex flex-col w-full max-w-lg mx-auto md:relative md:rounded-3xl md:h-auto md:max-h-none md:translate-y-0 md:hidden">
        
        <div class="w-full flex justify-center pt-3 pb-1" onclick="closeCalendar()">
            <div class="w-12 h-1.5 bg-gray-300 rounded-full"></div>
        </div>

        <div class="p-5 overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900">Pilih Tanggal</h3>
                <button onclick="closeCalendar()" class="bg-gray-100 p-2 rounded-full text-gray-500 hover:bg-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="flex gap-3 mb-4 text-xs font-medium">
                <div class="flex items-center gap-1.5 bg-red-50 text-red-700 px-2 py-1 rounded-lg border border-red-100">
                    <div class="w-2 h-2 bg-red-500 rounded-full"></div> Penuh
                </div>
                <div class="flex items-center gap-1.5 bg-emerald-50 text-emerald-700 px-2 py-1 rounded-lg border border-emerald-100">
                    <div class="w-2 h-2 border-2 border-emerald-500 rounded-full"></div> Kosong
                </div>
            </div>

            <div id='calendar' class="text-xs"></div>
        </div>
    </div>


    <script>
        // --- LOGIC UI & KALENDER ---

        const sheet = document.getElementById('calendarSheet');
        const overlay = document.getElementById('calendarOverlay');
        const displayDate = document.getElementById('display_date');
        const inputDate = document.getElementById('event_date');
        let calendar;

        function openCalendar() {
            // Tampilkan Overlay
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.remove('opacity-0'), 10);

            // Slide Up Sheet
            sheet.classList.remove('hidden'); // Hapus hidden dulu jika ada logic display none
            setTimeout(() => sheet.classList.add('open'), 10);

            // Render FullCalendar
            if (!calendar) {
                const calendarEl = document.getElementById('calendar');
                calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'id',
                    height: 'auto', // Agar tinggi menyesuaikan konten
                    headerToolbar: {
                        left: 'prev',
                        center: 'title',
                        right: 'next'
                    },
                    dayCellClassNames: 'cursor-pointer hover:bg-emerald-50', // UX
                    events: '{{ route("api.check_availability") }}', 
                    dateClick: function(info) {
                        // Cek Booking
                        let allEvents = calendar.getEvents();
                        let isBooked = allEvents.some(e => 
                            e.startStr === info.dateStr && e.display === 'background'
                        );

                        if(!isBooked) {
                            // Set Value
                            inputDate.value = info.dateStr;
                            
                            // Format Tanggal Tampilan (Indonesia)
                            let dateObj = new Date(info.dateStr);
                            let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                            displayDate.value = dateObj.toLocaleDateString('id-ID', options);

                            // Trigger Check
                            checkDateAvailability(info.dateStr);
                            closeCalendar();
                        } else {
                            // Efek getar atau alert soft
                            alert('⚠️ Tanggal ini sudah penuh, silakan pilih tanggal lain.');
                        }
                    }
                });
                calendar.render();
            } else {
                // Resize agar pas saat dibuka kembali
                setTimeout(() => calendar.updateSize(), 200);
            }
        }

        function closeCalendar() {
            // Slide Down
            sheet.classList.remove('open');
            overlay.classList.add('opacity-0');
            
            setTimeout(() => {
                overlay.classList.add('hidden');
            }, 300);
        }

        // --- LOGIC VALIDASI SERVER ---
        function checkDateAvailability(date) {
            if(!date) return;

            const statusDiv = document.getElementById('date-status');
            const loadingDiv = document.getElementById('loading-status');
            const submitBtn = document.getElementById('submitBtn');
            const displayInput = document.getElementById('display_date');

            // UI Loading State
            statusDiv.innerHTML = '';
            loadingDiv.classList.remove('hidden');
            submitBtn.disabled = true;
            submitBtn.classList.add('bg-gray-300', 'text-gray-500');
            submitBtn.classList.remove('bg-emerald-600', 'text-white');
            displayInput.classList.add('animate-pulse');

            // API Call
            fetch(`{{ route("api.check_availability") }}?date=${date}`)
                .then(response => response.json())
                .then(data => {
                    loadingDiv.classList.add('hidden');
                    displayInput.classList.remove('animate-pulse');
                    
                    if (data.status === 'booked') {
                        statusDiv.innerHTML = `<span class="text-red-600 text-xs font-bold flex items-center mt-1">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            ${data.message}
                        </span>`;
                        // Tombol tetap mati
                        submitBtn.disabled = true;
                    } else {
                        statusDiv.innerHTML = `<span class="text-emerald-600 text-xs font-bold flex items-center mt-1">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            ${data.message}
                        </span>`;
                        
                        // Hidupkan Tombol
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('bg-gray-300', 'text-gray-500');
                        submitBtn.classList.add('bg-emerald-600', 'text-white');
                    }
                })
                .catch(error => {
                    loadingDiv.classList.add('hidden');
                    console.error('Error:', error);
                    submitBtn.disabled = false; // Fallback jika error koneksi
                });
        }
        
        // Auto isi display jika back dari error validation laravel
        @if(old('event_date'))
            const oldDate = "{{ old('event_date') }}";
            if(oldDate) {
                let dateObj = new Date(oldDate);
                let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                document.getElementById('display_date').value = dateObj.toLocaleDateString('id-ID', options);
                checkDateAvailability(oldDate);
            }
        @endif

    </script>

    <div id="mapsHelpModal" class="fixed inset-0 z-[80] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity opacity-0 scale-95" id="mapsHelpOverlay" onclick="closeMapsHelp()"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div id="mapsHelpContent" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-sm opacity-0 translate-y-4 scale-95">
            
            <div class="bg-blue-50 px-4 py-3 border-b border-blue-100 flex justify-between items-center">
                <h3 class="text-sm font-bold text-blue-900 flex items-center gap-2">
                    <span class="bg-blue-200 text-blue-700 p-1 rounded-md"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>
                    Cara Menyalin Link Lokasi
                </h3>
                <button onclick="closeMapsHelp()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="px-5 py-5 space-y-4">
                
                <div class="flex gap-3">
                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs font-bold border border-gray-200">1</div>
                    <div>
                        <p class="text-xs font-semibold text-gray-800">Buka Google Maps</p>
                        <p class="text-[10px] text-gray-500">Cari nama gedung / lokasi acara Anda.</p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs font-bold border border-gray-200">2</div>
                    <div>
                        <p class="text-xs font-semibold text-gray-800">Klik Tombol Share (Bagikan)</p>
                        <p class="text-[10px] text-gray-500">Biasanya ada di bagian bawah detail lokasi.</p>
                        <div class="mt-1 inline-flex items-center gap-1 bg-gray-50 border border-gray-200 px-2 py-1 rounded text-[10px] text-gray-500">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                            <span>Icon Share</span>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3">
                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs font-bold border border-gray-200">3</div>
                    <div>
                        <p class="text-xs font-semibold text-gray-800">Pilih "Copy Link" / "Salin"</p>
                        <p class="text-[10px] text-gray-500">Link lokasi akan tersalin otomatis.</p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-xs font-bold border border-emerald-200">4</div>
                    <div>
                        <p class="text-xs font-bold text-emerald-700">Paste (Tempel) Disini</p>
                        <p class="text-[10px] text-emerald-600">Kembali ke form ini dan tempel di kolom.</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeMapsHelp()" class="w-full inline-flex justify-center rounded-xl border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                    Oke, Paham
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openMapsHelp() {
        const modal = document.getElementById('mapsHelpModal');
        const overlay = document.getElementById('mapsHelpOverlay');
        const content = document.getElementById('mapsHelpContent');

        modal.classList.remove('hidden');
        
        // Animasi Masuk
        setTimeout(() => {
            overlay.classList.remove('opacity-0', 'scale-95');
            content.classList.remove('opacity-0', 'translate-y-4', 'scale-95');
            content.classList.add('opacity-100', 'translate-y-0', 'scale-100');
        }, 10);
    }

    function closeMapsHelp() {
        const modal = document.getElementById('mapsHelpModal');
        const overlay = document.getElementById('mapsHelpOverlay');
        const content = document.getElementById('mapsHelpContent');

        // Animasi Keluar
        overlay.classList.add('opacity-0', 'scale-95');
        content.classList.add('opacity-0', 'translate-y-4', 'scale-95');
        content.classList.remove('opacity-100', 'translate-y-0', 'scale-100');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>
</body>
</html>