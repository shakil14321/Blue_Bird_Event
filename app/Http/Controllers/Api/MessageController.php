<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    // Send reply in a conversation
    public function store(Request $request, $conversation_id)
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'nullable|exists:users,id',
            'message' => 'required|string',
        ]);

        $conversation = Conversation::findOrFail($conversation_id);

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        // Assign admin if first reply from admin
        if ($conversation->admin_id === null && $request->receiver_id != null) {
            $conversation->update(['admin_id' => $request->sender_id]);
        }

        return response()->json(['message' => $message], 201);
    }

    // Get messages of a conversation
    public function index($conversation_id)
    {
        $conversation = Conversation::with('messages.sender')->findOrFail($conversation_id);
        return response()->json($conversation->messages);
    }
    
}
