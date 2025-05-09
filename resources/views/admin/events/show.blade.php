@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Event Details</h1>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $event->title }}</h4>
            <p class="card-text"><strong>Description:</strong> {{ $event->description }}</p>
            <p class="card-text"><strong>Date:</strong> {{ $event->event_date }}</p>
            <p class="card-text"><strong>Capacity:</strong> {{ $event->capacity }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $event->created_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
