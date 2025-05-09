@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Event</h1>

    <form action="{{ route('admin.events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $event->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $event->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Event Date</label>
            <input type="datetime-local" name="event_date" value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d\TH:i') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Capacity</label>
            <input type="number" name="capacity" value="{{ $event->capacity }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
