
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Vue initiale du calendrier (mois, semaine, jour)
        events: [
            {
                title: 'Économie MA2A',
                start: '2024-07-16T08:00:00',
                end: '2024-07-16T12:00:00'
            },
            {
                title: 'Comptabilité CFIC',
                start: '2024-07-24T08:00:00',
                end: '2024-07-24T12:00:00'
            }
        ]
    });

    calendar.render();
});

