@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Calender View -->
<div id='calendar'></div>
    
    
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ FullCalendar.dayGridPlugin ],
        initialView: 'dayGridWeek',
        events: '/api/events',
        dateClick: function(info) {
            // Example of adding an event on date click
            var title = prompt('Event Title:');
            if (title) {
                var eventData = {
                    title: title,
                    start: info.dateStr,
                    // You might want to include end date or other properties
                };
                // Call your API to add the event
                fetch('/api/events', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(eventData)
                })
                .then(response => response.json())
                .then(data => {
                    // Add the event to the calendar
                    calendar.addEvent(data);
                })
                .catch(error => console.error('Error:', error));
            }
        },
        eventClick: function(info) {
            var title = prompt('Edit event title:', info.event.title);
            if (title && title !== info.event.title) {
                var eventData = {
                    id: info.event.id,
                    title: title,
                    start: info.event.start.toISOString(),
                    end: info.event.end ? info.event.end.toISOString() : null
                };
                fetch('/api/events/' + info.event.id, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(eventData)
                })
                .then(response => response.json())
                .then(data => {
                    info.event.setProp('title', title);
                })
                .catch(error => console.error('Error:', error));
            }
            if (confirm("Do you want to delete this event?")) {
        fetch('/api/events/' + info.event.id, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (response.ok) {
                info.event.remove(); // Removes the event from the calendar
            }
        })
        .catch(error => console.error('Error:', error));
    }
        },
        eventDrop: function(info) {
            var eventData = {
                id: info.event.id,
                start: info.event.start.toISOString(),
                end: info.event.end ? info.event.end.toISOString() : null
            };
            fetch('/api/events/' + info.event.id, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(eventData)
            })
            .then(response => response.json())
            .then(data => {
                // Event updated
            })
            .catch(error => console.error('Error:', error));
        },
    });

    calendar.render();
});
</script>
@endpush
