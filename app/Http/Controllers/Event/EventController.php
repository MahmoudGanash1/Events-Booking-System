<?php

namespace App\Http\Controllers\Event;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EventResource;

class EventController extends Controller
{

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'date' => 'required|date',
            'available_seats' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'date' => $request->date,
            'available_seats' => $request->available_seats,
            'category_id' => $request->category_id,
            'created_by' => Auth::id(),
        ]);

        return response()->json('Event created successfully', 201);
    }


    public function update(Request $request, Event $event)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'date' => 'sometimes|date',
            'available_seats' => 'sometimes|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

           $event->update($request->only([
            'title',
            'description',
            'location',
            'date',
            'available_seats',
            'category_id'

    ]));

        return response()->json('Event updated successfully', 200);

    }


    public function destroy(Event $event)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }


    public function index()
    {
        $events = Event::all();
       return EventResource::collection($events);
    }

    
    public function show(Event $event)
    {
       return new EventResource($event);

    }
}
