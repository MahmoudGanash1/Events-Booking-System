<?php

namespace App\Http\Controllers\Booking;

use App\Models\User;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BookingResource;

class BookingController extends Controller
{
    public function book(Request $request, Event $event)
    {
        $request->validate([
            'seats' => 'required|integer|min:1',
        ]);

        if ($request->seats > $event->available_seats) {
            return response()->json(['message' => 'Not enough seats available'], 400);
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'seats' => $request->seats,
            'status' => 'pending',
        ]);

        $event->decrement('available_seats', $request->seats);

        return new BookingResource($booking->load('event'));
    }

    public function myBookings()
    {
        $user = Auth::user();
        $bookings = $user->bookings()->with('event')->get();

        return BookingResource::collection($bookings);
    }

    public function cancelBooking(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($booking->status !== 'pending') {
            return response()->json(['message' => 'Cannot cancel booking unless it is pending'], 400);
        }

        $booking->status = 'cancelled';
        $booking->save();

        $booking->event->increment('available_seats', $booking->seats);

        return response()->json(['message' => 'Booking cancelled successfully']);
    }
}
