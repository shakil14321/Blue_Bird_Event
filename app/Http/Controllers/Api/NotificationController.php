<?php

namespace App\Http\Controllers\Api;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    // List all notifications
    public function index()
    {
        return Notification::with('user')->get();
    }

    // Create a notification
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title'   => 'required|string|max:255',
            'body'    => 'required|string',
        ]);

        return Notification::create($request->all());
    }

    // Show single notification
    public function show($id)
    {
        return Notification::with('user')->findOrFail($id);
    }

    // Update notification
    public function update(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update($request->all());
        return $notification;
    }

    // Delete notification
    public function destroy($id)
    {
        return Notification::destroy($id);
    }
}
