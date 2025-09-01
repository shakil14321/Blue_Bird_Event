<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Support\Str;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConversationController extends Controller
{
    // Start a new conversation
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $conversation = Conversation::create([
            'unique_id' => Str::random(12),
            'user_id' => $request->user_id,
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $request->user_id,
            'message' => $request->message,
        ]);

        return response()->json(['conversation' => $conversation->load('messages')], 201);
    }

    // List conversations
    public function index()
    {
        return Conversation::with(['user', 'admin', 'messages'])->get();
    }

    // Show single conversation
    public function show($id)
    {
        return Conversation::with('messages.sender')->findOrFail($id);
    }
}
