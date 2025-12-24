<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📅 Kalender Job
        </h2>
    </x-slot>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

    <div class="py-6 md:py-12 pb-24"> <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">Periksa Inputan!</strong>
                <ul class="list-disc ml-5 mt-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

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

    <button onclick="openAddModal()" class="fixed bottom-16 right-8 z-40 bg-emerald-600 hover:bg-emerald-700 text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center transition transform hover:scale-110 focus:outline-none focus:ring-4 focus:ring-emerald-300" title="Tambah Jadwal Manual">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
    </button>


    <div id="eventModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                
                <div id="modalHeader" class="bg-emerald-600 px-4 py-3 sm:px-6 flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-bold text-white" id="modalTitle">Detail Acara</h3>
                    <button type="button" onclick="closeModal()" class="text-white hover:text-gray-200">
                        <span class="text-2xl">&times;</span>
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


    <div id="addEventModal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-900 bg-opacity-80 transition-opacity" onclick="closeAddModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
                
                <div class="bg-emerald-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Tambah Booking Manual
                    </h3>
                    <button type="button" onclick="closeAddModal()" class="text-emerald-100 hover:text-white text-2xl font-bold">&times;</button>
                </div>

                <form action="{{ route('admin.bookings.store') }}" method="POST">
                    @csrf
                    <div class="px-6 py-6 max-h-[70vh] overflow-y-auto">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div class="space-y-4">
                                <h4 class="text-emerald-800 font-bold border-b pb-1 text-sm uppercase">1. Data Pemesan & Waktu</h4>
                                
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Pemesan (CP)</label>
                                    <input type="text" name="booker_name" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">No. WhatsApp</label>
                                    <input type="number" name="booker_phone" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1">Tanggal</label>
                                        <input type="date" name="event_date" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 mb-1">Jam Mulai</label>
                                        <input type="time" name="event_time" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Alamat Lokasi</label>
                                    <textarea name="venue_address" rows="2" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500"></textarea>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Link Gmaps (Opsional)</label>
                                    <input type="text" name="location_gmaps" class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500 text-blue-600">
                                </div>
                            </div>

                            <div class="space-y-4">
                                <h4 class="text-emerald-800 font-bold border-b pb-1 text-sm uppercase">2. Data Mempelai (Opsional)</h4>
                                
                                <div class="bg-blue-50 p-3 rounded-lg border border-blue-100 space-y-2">
                                    <p class="text-xs font-bold text-blue-800">Mempelai Pria</p>
                                    <input type="text" name="groom_name" placeholder="Nama Pria" class="w-full rounded border-gray-200 text-xs py-1.5">
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="text" name="groom_father" placeholder="Ayah Pria" class="w-full rounded border-gray-200 text-xs py-1.5">
                                        <input type="text" name="groom_mother" placeholder="Ibu Pria" class="w-full rounded border-gray-200 text-xs py-1.5">
                                    </div>
                                </div>

                                <div class="bg-pink-50 p-3 rounded-lg border border-pink-100 space-y-2">
                                    <p class="text-xs font-bold text-pink-800">Mempelai Wanita</p>
                                    <input type="text" name="bride_name" placeholder="Nama Wanita" class="w-full rounded border-gray-200 text-xs py-1.5">
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="text" name="bride_father" placeholder="Ayah Wanita" class="w-full rounded border-gray-200 text-xs py-1.5">
                                        <input type="text" name="bride_mother" placeholder="Ibu Wanita" class="w-full rounded border-gray-200 text-xs py-1.5">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1">Tema / Request</label>
                                    <input type="text" name="event_theme" class="w-full rounded-lg border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse gap-2 border-t border-gray-200">
                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-6 py-2 bg-emerald-700 text-base font-bold text-white hover:bg-emerald-800 focus:outline-none sm:w-auto sm:text-sm">
                            Simpan Booking
                        </button>
                        <button type="button" onclick="closeAddModal()" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        // Modal Detail (View)
        function closeModal() {
            document.getElementById('eventModal').classList.add('hidden');
        }

        // Modal Tambah (Form)
        function openAddModal() {
            document.getElementById('addEventModal').classList.remove('hidden');
        }
        function closeAddModal() {
            document.getElementById('addEventModal').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'today'
                },
                height: 'auto',
                contentHeight: 'auto',
                dayMaxEvents: true, 
                events: @json($events),

                // KLIK EVENT -> Buka Modal View
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    
                    var props = info.event.extendedProps;
                    var dateObj = info.event.start;
                    
                    document.getElementById('modalTitle').innerText = info.event.title;
                    document.getElementById('modalTheme').innerText = props.theme || '-';
                    document.getElementById('modalLocation').innerText = props.location || 'Lokasi tidak tersedia';
                    document.getElementById('modalLink').href = props.detail_url;
                    
                    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    var dateStr = dateObj.toLocaleDateString('id-ID', options);
                    document.getElementById('modalDate').innerText = dateStr + ' • ' + props.time;

                    var statusEl = document.getElementById('modalStatus');
                    var headerEl = document.getElementById('modalHeader');
                    
                    statusEl.innerText = props.status;
                    
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
        /* Tweak tampilan Calendar agar serasi dengan modal */
        .fc-toolbar-title { font-size: 1.25rem !important; font-weight: 700; color: #065F46; }
        .fc-button-primary { background-color: #059669 !important; border-color: #059669 !important; }
        .fc-button-primary:hover { background-color: #047857 !important; border-color: #047857 !important; }
        .fc-daygrid-day-number { color: #374151; font-weight: 500; text-decoration: none !important; }
    </style>
</x-app-layout>