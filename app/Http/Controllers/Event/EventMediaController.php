<?php

namespace App\Http\Controllers\Event;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventMediaController extends Controller
{
    public function store(Request $request, Event $event)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'files' => 'required|array',
            'files.*' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $uploadedMedia = [];

        foreach ($request->file('files') as $file) {
            $media = $event->addMedia($file)
                           ->toMediaCollection('images');

            $uploadedMedia[] = [
                'id' => $media->id,
                'file_name' => $media->file_name,
                'url' => $media->getUrl(),
                'thumbnail' => $media->getUrl('thumb'),
            ];
        }

        return response()->json([
            'message' => 'Media uploaded successfully',
            'media' => $uploadedMedia
        ], 200);
    }

    public function destroy(Event $event, $mediaId)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $media = $event->getMedia('images')->where('id', $mediaId)->first();

        if (!$media) {
            return response()->json(['message' => 'Media not found'], 404);
        }

        $media->delete();

        return response()->json(['message' => 'Media deleted successfully']);
    }
}
