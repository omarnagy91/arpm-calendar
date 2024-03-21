@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Event</h2>
    <form method="POST" action="{{ route('events.store') }}">
        @csrf
        <!-- Form fields for event details -->
        <div class="form-group">
            <label for="title">Event Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <!-- Include other fields like start_time, end_time, etc. -->
        <button type="submit" class="btn btn-primary">Add Event</button>
    </form>
</div>
@endsection