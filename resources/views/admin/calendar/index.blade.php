<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📅 Kalender Job
        </h2>
    </x-slot>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-4 md:p-6 relative">

                <div class="flex flex-wrap gap-3 mb-4 text-xs border-b pb-4 justify-center md:justify-start">
                    <div class="flex items-center gap-1">
                        <div class="w-2 h-2 rounded-full bg-yellow-500"></div><span>Pending</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div><span>Confirmed</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <div class="w-2 h-2 rounded-full bg-gray-500"></div><span>Selesai</span>
                    </div>
                </div>

                <div id='calendar' class="font-sans text-gray-800"></div>

            </div>
        </div>
    </div>

    <div id="eventModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                
                <div id="modalHeader" class="bg-emerald-600 px-4 py-3 sm:px-6 flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-bold text-white" id="modalTitle">Detail Acara</h3>
                    <button type="button" onclick="closeModal()" class="text-white hover:text-gray-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center border-b pb-2">
                            <span id="modalDate" class="text-sm font-bold text-gray-500"></span>
                            <span id="modalStatus" class="px-2 py-1 text-xs font-bold rounded bg-gray-100 text-gray-800"></span>
                        </div>

                        <div class="grid grid-cols-1 gap-3 text-sm">
                            <div>
                                <p class="text-xs text-gray-400 uppercase font-bold">Tema / Kostum</p>
                                <p id="modalTheme" class="font-medium text-gray-800">-</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase font-bold">Lokasi</p>
                                <p id="modalLocation" class="font-medium text-gray-800 leading-relaxed">-</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                    <a id="modalLink" href="#" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-emerald-900 text-base font-medium text-white hover:bg-emerald-800 focus:outline-none sm:w-auto sm:text-sm">
                        Lihat Detail Lengkap
                    </a>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi Buka Tutup Modal
        function closeModal() {
            document.getElementById('eventModal').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            
            // Konfigurasi Layar Kecil (Mobile)
            var isMobile = window.innerWidth < 768;

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // HANYA GRID
                locale: 'id',
                
                // Toolbar Sederhana
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'today' // Hapus tombol List/Grid
                },
                
                // Tinggi Otomatis agar tidak gepeng di HP
                height: 'auto',
                contentHeight: 'auto',

                // Styling Grid di Mobile
                dayMaxEvents: true, // Jika event banyak, muncul "+ more"
                fixedWeekCount: false, // Tinggi bulan menyesuaikan jumlah minggu

                events: @json($events),

                // LOGIKA SAAT EVENT DIKLIK (POP-UP)
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // Jangan buka link dulu
                    
                    var props = info.event.extendedProps;
                    var dateObj = info.event.start;
                    
                    // 1. Isi Data ke Modal
                    document.getElementById('modalTitle').innerText = info.event.title;
                    document.getElementById('modalTheme').innerText = props.theme || '-';
                    document.getElementById('modalLocation').innerText = props.location || 'Lokasi tidak tersedia';
                    document.getElementById('modalLink').href = props.detail_url;
                    
                    // Format Tanggal & Jam (Contoh: Senin, 20 Des - 19:00)
                    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    var dateStr = dateObj.toLocaleDateString('id-ID', options);
                    document.getElementById('modalDate').innerText = dateStr + ' • ' + props.time;

                    // Set Status Badge & Warna Header
                    var statusEl = document.getElementById('modalStatus');
                    var headerEl = document.getElementById('modalHeader');
                    
                    statusEl.innerText = props.status;
                    
                    // Reset Kelas Warna
                    headerEl.classList.remove('bg-emerald-600', 'bg-yellow-500', 'bg-gray-600');
                    statusEl.classList.remove('text-emerald-800', 'bg-emerald-100', 'text-yellow-800', 'bg-yellow-100');

                    if(props.status === 'Confirmed') {
                        headerEl.classList.add('bg-emerald-600');
                        statusEl.classList.add('bg-emerald-100', 'text-emerald-800');
                    } else if (props.status === 'Pending') {
                        headerEl.classList.add('bg-yellow-500');
                        statusEl.classList.add('bg-yellow-100', 'text-yellow-800');
                    } else {
                        headerEl.classList.add('bg-gray-600');
                        statusEl.classList.add('bg-gray-100', 'text-gray-800');
                    }

                    // 2. Munculkan Modal
                    document.getElementById('eventModal').classList.remove('hidden');
                },

                eventTimeFormat: { 
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false
                }
            });

            calendar.render();
        });
    </script>

    <style>
        /* CSS KHUSUS MOBILE */
        
        /* Font Judul Bulan lebih kecil di HP */
        @media (max-width: 768px) {
            .fc-toolbar-title { font-size: 1.25rem !important; }
            .fc-header-toolbar { margin-bottom: 1rem !important; }
        }

        /* Tombol Kalender Hijau */
        .fc-button-primary {
            background-color: #064E3B !important; 
            border-color: #064E3B !important;
            padding: 0.4rem 0.8rem !important; /* Padding tombol pas di jari */
        }
        
        /* Event Bar di Kalender */
        .fc-daygrid-event {
            border-radius: 4px !important;
            padding: 2px 4px !important;
            font-size: 0.75rem !important; /* Font event kecil agar muat */
        }
    </style>
</x-app-layout>