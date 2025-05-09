@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Event</h1>

    <form action="{{ route('admin.events.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label>Event Date</label>
            <input type="datetime-local" name="event_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Capacity</label>
            <input type="number" name="capacity" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Create Event</button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
