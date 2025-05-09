@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Event List</h1>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary mb-3">+ Add Event</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Event Date</th>
                    <th>Seats</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->description }}</td>
                    <td>{{ $event->event_date }}</td>
                    <td>{{ $event->seats }}</td>
                    <td>
                        <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
