<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
   // 🟢 إنشاء حجز
   // 🟢 إنشاء حجز
public function store(Request $request)
{
    Log::info('Request payload:', $request->all());

    // التحقق من صحة البيانات
    $request->validate([
        'event_id' => 'required|exists:events,id',
    ]);

    // البحث عن الفعالية
    $event = Event::find($request->event_id);

    // التحقق من وجود مقاعد شاغرة
    if ($event->capacity <= 0) {
        return response()->json(['message' => 'No available seats.'], 400);
    }

    // التحقق من أن المستخدم لم يحجز نفس الحدث مسبقًا
    $alreadyBooked = Booking::where('user_id', Auth::id())
        ->where('event_id', $event->id)
        ->exists();

    if ($alreadyBooked) {
        return response()->json(['message' => 'You have already booked this event.'], 409);
    }

    // إنشاء الحجز
    $booking = Booking::create([
        'user_id' => Auth::id(),
        'event_id' => $event->id,
    ]);

    // تقليل عدد المقاعد
    $event->decrement('capacity');

    return response()->json($booking, 201);
}

// 🔴 إلغاء حجز
public function destroy($id)
{
    // البحث عن الحجز
    $booking = Booking::where('id', $id)
        ->where('user_id', Auth::id())
        ->first();

    if (!$booking) {
        return response()->json(['message' => 'Booking not found.'], 404);
    }

    // استرجاع مقعد للفعالية
    $booking->event->increment('capacity');

    // حذف الحجز
    $booking->delete();

    return response()->json(['message' => 'Booking cancelled.']);
}

   // 🟢 عرض حجوزات المستخدم
   public function index()
{
    $bookings = Booking::with(['event', 'user'])
        ->where('user_id', Auth::id())
        ->get();

    return response()->json([
        'bookings' => $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'event' => [
                    'id' => $booking->event->id,
                    'title' => $booking->event->title,
                    'date' => $booking->event->date,
                    'location' => $booking->event->location,
                ],
                'user' => [
                    'name' => $booking->user->name,
                    'email' => $booking->user->email,
                    'avatar_url' => $booking->user->avatar_url,
                ],
            ];
        }),
    ]);
}

}
