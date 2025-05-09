<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\EventController as AdminEventController;


class EventController extends Controller
{
     // 🟢 GET /api/events
     public function index()
     {
         return response()->json(Event::all());
     }
 
     // 🟢 GET /api/events/{id}
     public function show($id)
     {
         $event = Event::find($id);
 
         if (!$event) {
             return response()->json(['message' => 'Event not found'], 404);
         }
 
         return response()->json($event);
     }
 
     // 🟢 POST /api/events (Admin only)
     public function store(Request $request)
     {
         $validated = $request->validate([
             'title' => 'required|string|max:255',
             'description' => 'nullable|string',
             'event_date' => 'required|date',
             'location' => 'required|string|max:255',
             'capacity' => 'required|integer|min:1',
         ]);
 
         $event = Event::create($validated);
 
         return response()->json($event, 201);
     }
 
     // 🟡 PUT /api/events/{id}
     public function update(Request $request, $id)
     {
         $event = Event::find($id);
 
         if (!$event) {
             return response()->json(['message' => 'Event not found'], 404);
         }
 
         $validated = $request->validate([
             'title' => 'sometimes|required|string|max:255',
             'description' => 'nullable|string',
             'start_time' => 'sometimes|required|date',
             'end_time' => 'sometimes|required|date|after:start_time',
             'location' => 'sometimes|required|string|max:255',
             'capacity' => 'sometimes|required|integer|min:1',
         ]);
 
         $event->update($validated);
 
         return response()->json($event);
     }
 
     // 🔴 DELETE /api/events/{id}
     public function destroy($id)
     {
         $event = Event::find($id);
 
         if (!$event) {
             return response()->json(['message' => 'Event not found'], 404);
         }
 
         $event->delete();
 
         return response()->json(['message' => 'Event deleted']);
     }
}
