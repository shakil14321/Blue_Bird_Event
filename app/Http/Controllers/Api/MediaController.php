<?php

namespace App\Http\Controllers\Api;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    public function index()
    {
        return Media::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'mediaable_id' => 'required|integer',
            'mediaable_type' => 'required|string',
            'media_type' => 'required|string',
            'url' => 'required|string'
        ]);

        return Media::create($request->all());
    }

    public function show($id)
    {
        return Media::findOrFail($id);
    }

    public function destroy($id)
    {
        return Media::destroy($id);
    }
}
