<?php

namespace App\Http\Controllers\Api;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    // Upload and attach media
    public function store(Request $request)
    {
        $request->validate([
            'mediaable_id'   => 'required|integer',
            'mediaable_type' => 'required|string',
            'media_type'     => 'required|string',
            'url'            => 'required|string',
        ]);

        $media = Media::create($request->all());

        return response()->json(['media' => $media], 201);
    }

    // Get all media for a model
    public function index($type, $id)
    {
        $media = Media::where('mediaable_type', $type)
                      ->where('mediaable_id', $id)
                      ->get();

        return response()->json($media);
    }
    
}
