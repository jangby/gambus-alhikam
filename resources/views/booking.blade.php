<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"> 
    <title>Booking Gambus Al-Hikam</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    
    <style>
        /* Hide Scrollbar */
        ::-webkit-scrollbar { width: 0px; background: transparent; }
        
        body { 
            font-family: 'Figtree', -apple-system, BlinkMacSystemFont, sans-serif; 
            background-color: #FEFAE0; /* Krem Gading */
            color: #4A3728; /* Coklat Tua */
        }
        
        /* Bottom Sheet Animation */
        .bottom-sheet {
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            transform: translateY(100%);
        }
        .bottom-sheet.open {
            transform: translateY(0);
        }
        
        /* FullCalendar Customization for Brown Theme */
        .fc-toolbar-title { font-size: 1rem !important; font-weight: 800; color: #4A3728; text-transform: uppercase; letter-spacing: 1px; }
        .fc-button-primary { background-color: #4A3728 !important; border-color: #4A3728 !important; border-radius: 0.5rem !important; }
        .fc-button-primary:hover { background-color: #3E2D20 !important; }
        .fc-daygrid-day-number { font-size: 0.85rem; font-weight: 600; color: #4A3728; text-decoration: none !important; }
        .fc-col-header-cell-cushion { color: #D4A373; font-weight: 700; text-transform: uppercase; font-size: 0.7rem; }
        .fc-day-today { background-color: #FAF3E0 !important; }
    </style>
</head>
<body class="pb-28"> 
    
    <nav class="fixed top-0 w-full bg-[#FEFAE0]/90 backdrop-blur-md z-40 border-b border-[#EFEAD8] px-5 h-16 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-3">
            <a href="{{ url('/') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-[#EFEAD8] hover:bg-[#EFEAD8] transition active:scale-95 shadow-sm">
                <svg class="w-5 h-5 text-gambus-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <div class="flex items-center gap-2">
                <img src="{{ asset('logo.jpeg') }}" class="w-8 h-8 rounded-full border border-gambus-secondary/50 shadow-sm object-cover" alt="Logo">
                <div>
                    <h1 class="font-bold text-base text-gambus-primary leading-tight">Form Booking</h1>
                    <p class="text-[10px] text-gambus-secondary font-bold uppercase tracking-wide">Gambus Al-Hikam</p>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-24 px-6 max-w-lg mx-auto">

        @if(session('success'))
        <div class="mb-6 bg-[#FEFAE0] border-l-4 border-gambus-secondary rounded-r-xl p-4 flex items-start gap-3 shadow-md relative overflow-hidden">
            <div class="absolute right-0 top-0 opacity-10">
                <svg class="w-20 h-20 text-gambus-secondary" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div class="bg-gambus-primary p-2 rounded-full text-white z-10">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <div class="z-10">
                <h3 class="font-bold text-gambus-primary text-sm">Alhamdulillah, Berhasil!</h3>
                <p class="text-xs text-gambus-text mt-1 leading-relaxed">{{ session('success') }}</p>
                <a href="{{ url('/') }}" class="text-xs font-bold text-gambus-secondary underline mt-2 inline-block hover:text-gambus-primary">Kembali ke Beranda</a>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-r-xl p-4 flex items-start gap-3 shadow-sm">
            <div class="bg-red-100 p-2 rounded-full text-red-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-red-800 text-sm">Mohon Maaf</h3>
                <p class="text-xs text-red-700 mt-1">{{ session('error') }}</p>
            </div>
        </div>
        @endif
        
        <form action="{{ route('booking.store') }}" method="POST" id="bookingForm" class="space-y-6">
            @csrf
            
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#EFEAD8] relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-16 h-16 bg-gambus-secondary/10 rounded-bl-full -mr-8 -mt-8 transition group-hover:scale-110"></div>
                
                <h3 class="text-gambus-primary font-bold text-sm uppercase tracking-wider mb-5 flex items-center gap-2">
                    <span class="w-1 h-4 bg-gambus-secondary rounded-full"></span> Data Pemesan
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="text-[11px] font-bold text-gambus-secondary uppercase ml-1 mb-1 block">Nama Lengkap</label>
                        <input type="text" name="booker_name" value="{{ old('booker_name') }}" required 
                            class="w-full bg-[#FEFAE0]/30 border-gray-200 focus:border-gambus-secondary focus:bg-white focus:ring-gambus-secondary/20 rounded-xl px-4 py-3 text-sm font-medium transition-all placeholder-gray-400 text-gambus-primary"
                            placeholder="Nama Pemesan / CP">
                    </div>
                    <div>
                        <label class="text-[11px] font-bold text-gambus-secondary uppercase ml-1 mb-1 block">No. WhatsApp</label>
                        <input type="tel" name="booker_phone" value="{{ old('booker_phone') }}" required 
                            class="w-full bg-[#FEFAE0]/30 border-gray-200 focus:border-gambus-secondary focus:bg-white focus:ring-gambus-secondary/20 rounded-xl px-4 py-3 text-sm font-medium transition-all placeholder-gray-400 text-gambus-primary"
                            placeholder="08xxxxxxxxxx">
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-[#FEFAE0] to-white rounded-3xl p-6 shadow-sm border border-gambus-secondary/30 relative">
                <h3 class="text-gambus-primary font-bold text-sm uppercase tracking-wider mb-5 flex items-center gap-2">
                    <span class="w-1 h-4 bg-gambus-secondary rounded-full"></span> Waktu & Tempat
                </h3>

                <div class="space-y-4">
                    <div>
                        <label class="text-[11px] font-bold text-gambus-secondary uppercase ml-1 mb-1 block">Tanggal Acara</label>
                        <div class="relative group" onclick="openCalendar()">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-lg group-hover:scale-110 transition">📅</span>
                            </div>
                            <input type="text" id="display_date" readonly 
                                class="w-full bg-white border border-gambus-secondary/40 text-gambus-primary rounded-xl pl-12 pr-4 py-3 text-sm font-bold shadow-sm focus:ring-2 focus:ring-gambus-secondary cursor-pointer placeholder-gambus-primary/40"
                                placeholder="Ketuk untuk memilih tanggal...">
                            
                            <input type="hidden" id="event_date" name="event_date" value="{{ old('event_date') }}">
                        </div>
                        
                        <div id="date-status" class="ml-1 mt-1"></div>
                        <div id="loading-status" class="hidden ml-1 mt-2 text-xs text-gambus-secondary flex items-center gap-2">
                            <svg class="animate-spin h-3 w-3" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Mengecek ketersediaan jadwal...
                        </div>
                    </div>

                    <div>
                        <label class="text-[11px] font-bold text-gambus-secondary uppercase ml-1 mb-1 block">Jam Mulai</label>
                        <input type="time" name="event_time" value="{{ old('event_time') }}" required 
                            class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-sm font-medium focus:border-gambus-secondary focus:ring-gambus-secondary/20 text-gambus-primary">
                    </div>

                    <div>
                        <label class="text-[11px] font-bold text-gambus-secondary uppercase ml-1 mb-1 block">Lokasi (Alamat)</label>
                        <textarea name="venue_address" rows="2" required 
                            class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 text-sm font-medium focus:border-gambus-secondary focus:ring-gambus-secondary/20 placeholder-gray-400 text-gambus-primary"
                            placeholder="Nama Gedung / Jalan lengkap...">{{ old('venue_address') }}</textarea>
                    </div>

                    <div>
                        <div class="flex justify-between items-end mb-2 ml-1">
                            <label class="text-[11px] font-bold text-gambus-secondary uppercase">Link Google Maps</label>
                            <button type="button" onclick="openMapsHelp()" class="flex items-center gap-1 text-[10px] text-gambus-primary font-bold bg-[#EFEAD8] px-3 py-1.5 rounded-full hover:bg-gambus-secondary hover:text-white transition active:scale-95 shadow-sm">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Bantuan Salin
                            </button>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <input type="url" name="location_gmaps" value="{{ old('location_gmaps') }}" 
                                class="w-full bg-white border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-sm text-blue-600 underline placeholder-gray-400 focus:border-gambus-secondary focus:ring-gambus-secondary/20"
                                placeholder="https://maps.app.goo.gl/...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="bg-white rounded-3xl p-5 shadow-sm border border-l-4 border-l-blue-400 border-gray-100">
                    <h3 class="text-blue-800 font-bold text-sm uppercase tracking-wider mb-4 pl-1">🤵 Mempelai Pria</h3>
                    <div class="space-y-3">
                        <input type="text" name="groom_name" placeholder="Nama Pria" class="w-full bg-blue-50/30 border-gray-100 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-blue-400 focus:ring-0 transition-all placeholder-gray-400 text-gambus-primary">
                        <div class="grid grid-cols-2 gap-3">
                            <input type="text" name="groom_father" placeholder="Nama Ayah" class="w-full bg-blue-50/30 border-gray-100 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-blue-400 focus:ring-0 transition-all placeholder-gray-400 text-gambus-primary">
                            <input type="text" name="groom_mother" placeholder="Nama Ibu" class="w-full bg-blue-50/30 border-gray-100 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-blue-400 focus:ring-0 transition-all placeholder-gray-400 text-gambus-primary">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-5 shadow-sm border border-l-4 border-l-pink-400 border-gray-100">
                    <h3 class="text-pink-800 font-bold text-sm uppercase tracking-wider mb-4 pl-1">👰 Mempelai Wanita</h3>
                    <div class="space-y-3">
                        <input type="text" name="bride_name" placeholder="Nama Wanita" class="w-full bg-pink-50/30 border-gray-100 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-pink-400 focus:ring-0 transition-all placeholder-gray-400 text-gambus-primary">
                        <div class="grid grid-cols-2 gap-3">
                            <input type="text" name="bride_father" placeholder="Nama Ayah" class="w-full bg-pink-50/30 border-gray-100 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-pink-400 focus:ring-0 transition-all placeholder-gray-400 text-gambus-primary">
                            <input type="text" name="bride_mother" placeholder="Nama Ibu" class="w-full bg-pink-50/30 border-gray-100 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-pink-400 focus:ring-0 transition-all placeholder-gray-400 text-gambus-primary">
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 mb-8">
                 <h3 class="text-gambus-primary font-bold text-sm uppercase tracking-wider mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-gambus-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                    Request / Tema Khusus
                 </h3>
                 <input type="text" name="event_theme" class="w-full bg-gray-50 border-transparent focus:border-gambus-secondary focus:bg-white focus:ring-gambus-secondary/20 rounded-xl px-4 py-3.5 text-sm text-gambus-primary placeholder-gray-400" placeholder="Contoh: Nuansa Putih / Lagu Arabic...">
            </div>

        </form>
    </div>

    <div class="fixed bottom-0 left-0 w-full bg-white/90 backdrop-blur-md border-t border-[#EFEAD8] p-4 z-30 shadow-[0_-5px_15px_rgba(74,55,40,0.05)]">
        <div class="max-w-lg mx-auto">
            <button type="submit" form="bookingForm" id="submitBtn" class="w-full bg-gradient-to-r from-gambus-primary to-[#6D5440] text-white font-bold text-base py-4 rounded-2xl shadow-lg shadow-gambus-primary/30 active:scale-[0.98] transition-all flex justify-center items-center gap-2 disabled:bg-gray-300 disabled:from-gray-300 disabled:to-gray-400 disabled:shadow-none disabled:cursor-not-allowed border border-gambus-primary/50">
                <span>Kirim Booking</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </div>
    </div>

    <div id="calendarOverlay" class="fixed inset-0 bg-[#2C1810]/60 backdrop-blur-sm z-50 hidden transition-opacity opacity-0" onclick="closeCalendar()"></div>
    
    <div id="calendarSheet" class="fixed bottom-0 left-0 right-0 bg-white z-[60] rounded-t-3xl shadow-2xl bottom-sheet max-h-[85vh] flex flex-col w-full max-w-lg mx-auto border-t-4 border-gambus-secondary">
        
        <div class="w-full flex justify-center pt-3 pb-1" onclick="closeCalendar()">
            <div class="w-12 h-1.5 bg-gray-300 rounded-full"></div>
        </div>

        <div class="p-5 overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gambus-primary flex items-center gap-2">
                    <span class="bg-[#FEFAE0] p-1.5 rounded-lg text-xl">📅</span> Pilih Tanggal
                </h3>
                <button onclick="closeCalendar()" class="bg-gray-100 p-2 rounded-full text-gray-500 hover:bg-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="flex gap-3 mb-4 text-xs font-medium justify-center bg-gray-50 p-2 rounded-xl">
                <div class="flex items-center gap-1.5 text-red-600">
                    <div class="w-2.5 h-2.5 bg-red-500 rounded-full"></div> Penuh
                </div>
                <div class="w-px h-4 bg-gray-300"></div>
                <div class="flex items-center gap-1.5 text-gambus-primary">
                    <div class="w-2.5 h-2.5 border-2 border-gambus-primary rounded-full"></div> Kosong (Bisa)
                </div>
            </div>

            <div id='calendar' class="text-xs font-medium text-gray-700"></div>
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
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.remove('opacity-0'), 10);

            sheet.classList.remove('hidden');
            setTimeout(() => sheet.classList.add('open'), 10);

            if (!calendar) {
                const calendarEl = document.getElementById('calendar');
                calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'id',
                    height: 'auto',
                    headerToolbar: { left: 'prev', center: 'title', right: 'next' },
                    dayCellClassNames: 'cursor-pointer hover:bg-[#FEFAE0]',
                    events: '{{ route("api.check_availability") }}', 
                    
                    // Style Event (Background Merah untuk Booked)
                    eventDidMount: function(info) {
                        if(info.event.display === 'background') {
                            info.el.style.backgroundColor = '#FECACA'; // Red-200
                            info.el.style.opacity = '0.7';
                        }
                    },

                    dateClick: function(info) {
                        let allEvents = calendar.getEvents();
                        // Cek jika ada event background (Booked) di tanggal tsb
                        let isBooked = allEvents.some(e => 
                            e.startStr === info.dateStr && e.display === 'background'
                        );

                        if(!isBooked) {
                            inputDate.value = info.dateStr;
                            let dateObj = new Date(info.dateStr);
                            let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                            displayDate.value = dateObj.toLocaleDateString('id-ID', options);
                            checkDateAvailability(info.dateStr);
                            closeCalendar();
                        } else {
                            // Shake Effect sederhana
                            calendarEl.classList.add('animate-pulse');
                            setTimeout(() => calendarEl.classList.remove('animate-pulse'), 200);
                            alert('⚠️ Yah, tanggal ini sudah penuh. Silakan pilih tanggal lain ya!');
                        }
                    }
                });
                calendar.render();
            } else {
                setTimeout(() => calendar.updateSize(), 200);
            }
        }

        function closeCalendar() {
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

            statusDiv.innerHTML = '';
            loadingDiv.classList.remove('hidden');
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            displayInput.classList.add('animate-pulse');

            fetch(`{{ route("api.check_availability") }}?date=${date}`)
                .then(response => response.json())
                .then(data => {
                    loadingDiv.classList.add('hidden');
                    displayInput.classList.remove('animate-pulse');
                    
                    if (data.status === 'booked') {
                        statusDiv.innerHTML = `<span class="text-red-600 text-xs font-bold flex items-center bg-red-50 p-2 rounded-lg border border-red-100">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            ${data.message}
                        </span>`;
                        submitBtn.disabled = true;
                    } else {
                        statusDiv.innerHTML = `<span class="text-gambus-primary text-xs font-bold flex items-center bg-[#FEFAE0] p-2 rounded-lg border border-gambus-secondary/50">
                            <svg class="w-4 h-4 mr-1 text-gambus-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            ${data.message}
                        </span>`;
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                })
                .catch(error => {
                    loadingDiv.classList.add('hidden');
                    submitBtn.disabled = false; 
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                });
        }
        
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
        <div class="fixed inset-0 bg-[#2C1810]/70 backdrop-blur-sm transition-opacity opacity-0 scale-95" id="mapsHelpOverlay" onclick="closeMapsHelp()"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div id="mapsHelpContent" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-sm opacity-0 translate-y-4 scale-95 border-t-4 border-gambus-secondary">
                
                <div class="bg-[#FEFAE0] px-4 py-3 border-b border-[#EFEAD8] flex justify-between items-center">
                    <h3 class="text-sm font-bold text-gambus-primary flex items-center gap-2">
                        <span class="bg-white text-gambus-secondary p-1 rounded-md border border-gambus-secondary/20"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></span>
                        Panduan Google Maps
                    </h3>
                    <button onclick="closeMapsHelp()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="px-5 py-5 space-y-4">
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-gambus-primary text-white flex items-center justify-center text-xs font-bold shadow-sm">1</div>
                        <div>
                            <p class="text-xs font-semibold text-gray-800">Buka Aplikasi Google Maps</p>
                            <p class="text-[10px] text-gray-500">Cari nama gedung / lokasi acara Anda.</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-gambus-primary text-white flex items-center justify-center text-xs font-bold shadow-sm">2</div>
                        <div>
                            <p class="text-xs font-semibold text-gray-800">Klik "Bagikan" (Share)</p>
                            <div class="mt-1 inline-flex items-center gap-1 bg-gray-50 border border-gray-200 px-2 py-1 rounded text-[10px] text-gray-500">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                                <span>Icon Share</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-gambus-primary text-white flex items-center justify-center text-xs font-bold shadow-sm">3</div>
                        <div>
                            <p class="text-xs font-semibold text-gray-800">Pilih "Salin Link" (Copy)</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-gambus-secondary text-white flex items-center justify-center text-xs font-bold shadow-sm">4</div>
                        <div>
                            <p class="text-xs font-bold text-gambus-secondary">Tempel (Paste) di Form</p>
                            <p class="text-[10px] text-gray-500">Kembali ke sini dan tempel di kolom Link.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="closeMapsHelp()" class="w-full inline-flex justify-center rounded-xl border border-transparent bg-gambus-primary px-4 py-2 text-sm font-bold text-white shadow-sm hover:bg-[#3E2D20] focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
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
            overlay.classList.add('opacity-0', 'scale-95');
            content.classList.add('opacity-0', 'translate-y-4', 'scale-95');
            content.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
            setTimeout(() => { modal.classList.add('hidden'); }, 300);
        }
    </script>
</body>
</html>