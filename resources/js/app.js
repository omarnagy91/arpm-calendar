import './bootstrap';

// Import FullCalendar core and plugins
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import bootstrapPlugin from '@fullcalendar/bootstrap5';

// Assuming you're handling CSS imports elsewhere or through Laravel Mix

document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin, bootstrapPlugin],
        themeSystem: 'bootstrap5',
        initialView: 'dayGridWeek',
        editable: true, // Allow event dragging & resizing
        events: '/api/events',
        // Ensure CSRF token is included in headers for requests that modify data
        eventAdd: function (addInfo) {
            fetch('/api/events', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    title: addInfo.event.title,
                    start_time: addInfo.event.start.toISOString(),
                    end_time: addInfo.event.end.toISOString(),
                    // Include other event fields as necessary
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        },
        // Similarly handle eventChange and eventRemove
    });

    calendar.render();
});