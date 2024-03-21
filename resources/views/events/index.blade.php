@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Event Calendar</h2>
    <a href="{{ route('events.create') }}" class="btn btn-success">Add New Event</a>
<a href="{{ route('events.edit', $event->id) }}" class="btn btn-secondary">Edit</a>
    <div class="row">
        <div class="col text-center font-weight-bold">Sunday</div>
        <div class="col text-center font-weight-bold">Monday</div>
        <div class="col text-center font-weight-bold">Tuesday</div>
        <div class="col text-center font-weight-bold">Wednesday</div>
        <div class="col text-center font-weight-bold">Thursday</div>
        <div class="col text-center font-weight-bold">Friday</div>
        <div class="col text-center font-weight-bold">Saturday</div>
    </div>
    @foreach($events as $event)
        <div class="row border-top">
            <div class="col">
                @if($event->start_time->dayOfWeek == 0) {{-- Sunday --}}
                    <p>{{ $event->title }}</p>
                    <small>{{ $event->start_time->format('g:i A') }}</small>
                @endif
            </div>
            <div class="col">
                @if($event->start_time->dayOfWeek == 1) {{-- Monday --}}
                    <p>{{ $event->title }}</p>
                    <small>{{ $event->start_time->format('g:i A') }}</small>
                @endif
            </div>
            <form method="POST" action="{{ route('events.destroy', $event->id) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
            <!-- Repeat for each day -->
            <div class="col">
                @if($event->start_time->dayOfWeek == 6) {{-- Saturday --}}
                    <p>{{ $event->title }}</p>
                    <small>{{ $event->start_time->format('g:i A') }}</small>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection

@push('scripts')
<script>
    // JavaScript code to initialize a weekly calendar view using Bootstrap
    // and handle adding and deleting events.
    // You might want to use a library like FullCalendar (https://fullcalendar.io/)
    // or implement your own custom calendar logic.
</script>
@endpush
