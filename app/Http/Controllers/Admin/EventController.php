<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
  

    // عرض جميع الفعاليات
    public function index()
    {
        $events = Event::latest()->paginate(10);

        return response()->json([
            'status' => true,
            'events' => $events
        ]);
    }

    // حفظ فعالية جديدة في قاعدة البيانات
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'event_date'  => 'required|date',
            'capacity'    => 'required|integer|min:1',
        ]);

        $event = Event::create($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Event created successfully.',
            'event'   => $event
        ], 201);
    }

    // عرض تفاصيل فعالية معينة
    public function show(Event $event)
    {
        return response()->json([
            'status' => true,
            'event'  => $event
        ]);
    }

    // تعديل فعالية
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'event_date'  => 'required|date',
            'capacity'    => 'required|integer|min:1',
        ]);

        $event->update($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Event updated successfully.',
            'event'   => $event
        ]);
    }

    // حذف فعالية
    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Event deleted successfully.'
        ]);
    }
}
