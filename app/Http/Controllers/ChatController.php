<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Conversation $conversation = null)
    {
        $conversations = Auth::user()->clientConversations()
            ->with(['client', 'freelancer'])
            ->get()
            ->merge(Auth::user()->freelancerConversations()->with(['client', 'freelancer'])->get());
            

        return view('chat', compact('conversations', 'conversation'));
    }

    public function getConversations(Request $request)
    {
        $conversations = Auth::user()->clientConversations()
            ->with(['client', 'freelancer', 'messages' => function ($query) {
                $query->latest()->first();
            }])
            ->get()
            ->merge(Auth::user()->freelancerConversations()->with(['client', 'freelancer', 'messages' => function ($query) {
                $query->latest()->first();
            }])->get());

        return response()->json($conversations);
    }

    public function getMessages(Conversation $conversation)
    {
        // Ensure the user is part of the conversation
        if ($conversation->client_id != Auth::id() && $conversation->freelancer_id != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $messages = $conversation->messages()->with('sender')->orderBy('created_at', 'asc')->get();

        // Mark messages as read
        $messages->where('sender_id', '!=', Auth::id())->each(function ($message) {
            $message->update(['is_read' => true]);
        });

        return response()->json($messages);
    }

    public function sendMessage(Request $request, Conversation $conversation)
    {
        // Ensure the user is part of the conversation
        if ($conversation->client_id != Auth::id() && $conversation->freelancer_id != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        $message = $conversation->messages()->create([
            'sender_id' => Auth::id(),
            'content' => $request->input('content'),
            'is_read' => false,
        ]);

        return response()->json($message->load('sender'));
    }

    public function startConversation(Request $request)
{
    $request->validate([
        'client_id' => 'required|exists:users,id',
        'freelancer_id' => 'required|exists:users,id',
    ]);

    $clientId = $request->input('client_id');
    $freelancerId = $request->input('freelancer_id');

    // Ensure the logged-in user is either the client or freelancer
    if (!in_array(Auth::id(), [$clientId, $freelancerId])) {
        abort(403, 'Unauthorized');
    }

    // Check for an existing conversation
    $conversation = Conversation::where('client_id', $clientId)
        ->where('freelancer_id', $freelancerId)
        ->first();

    // If no conversation exists, create one
    if (!$conversation) {
        $conversation = Conversation::create([
            'client_id' => $clientId,
            'freelancer_id' => $freelancerId,
        ]);
    }

    // Redirect to the chat page for this conversation
    return redirect()->route('chat.index', $conversation);
}
}