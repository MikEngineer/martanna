<div>
    @if (session()->has('message'))
        <div class="alert alert-info">{{ session('message') }}</div>
    @endif

    <div id="calendar"></div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($bookingsJson),
                dateClick: function (info) {
                    if (confirm("Richiedi prenotazione per il " + info.dateStr + "?")) {
                        @this.requestBooking(info.dateStr);
                    }
                }
            });
            calendar.render();
        });

        Livewire.on('bookingUpdated', function () {
            location.reload();
        });
    </script>
</div>