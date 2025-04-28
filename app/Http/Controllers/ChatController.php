<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

        $message->load('sender', 'conversation');

    event(new \App\Events\MessageSent($message));
    Log::info("Dispatching MessageSent event");

    broadcast(new \App\Events\MessageSent($message));

    event(new \App\Events\TestEvent());


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

    

//     public function pusherAuth(Request $request)
// {
//     $user = auth()->user();
//     $channelName = $request->input('channel_name');
//     $socketId = $request->input('socket_id');

//     $userId = explode('.', $channelName)[1];
//     if ($user->id != $userId) {
//         return response()->json(['error' => 'Unauthorized'], 403);
//     }

//     $pusher = new \Pusher\Pusher(
//         env('PUSHER_APP_KEY'),
//         env('PUSHER_APP_SECRET'),
//         env('PUSHER_APP_ID'),
//         ['cluster' => env('PUSHER_APP_CLUSTER')]
//     );

//     $auth = $pusher->authorizeChannel($channelName, $socketId);
//     return response()->json($auth);
// }

public function pusherAuth(Request $request)
{
    $user = auth()->user();
    $channelName = $request->input('channel_name');
    $socketId = $request->input('socket_id');

    \Log::info('Received /pusher/auth request', [
        'user_id' => $user ? $user->id : 'Not authenticated',
        'channel_name' => $channelName,
        'socket_id' => $socketId,
    ]);

    $parts = explode('.', $channelName);
    if (count($parts) !== 2) {
        \Log::error('Invalid channel name format: ' . $channelName);
        return response()->json(['error' => 'Invalid channel name'], 400);
    }
    $userId = $parts[1];
    \Log::info('Extracted userId from channel: ' . $userId);

    if (!$user) {
        \Log::warning('User not authenticated for channel ' . $channelName);
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    if ((int) $user->id !== (int) $userId) {
        \Log::warning('Unauthorized access to channel ' . $channelName . ' by user ' . $user->id);
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $pusherKey = env('PUSHER_APP_KEY');
    $pusherSecret = env('PUSHER_APP_SECRET');
    \Log::info('Pusher credentials', [
        'PUSHER_APP_KEY' => $pusherKey,
        'PUSHER_APP_SECRET' => $pusherSecret ? 'Set' : 'Not set',
    ]);

    // Manually calculate the signature
    $stringToSign = $socketId . ':' . $channelName;
    $manualSignature = hash_hmac('sha256', $stringToSign, $pusherSecret, false);
    \Log::info('Manually calculated signature', [
        'string_to_sign' => $stringToSign,
        'signature' => $manualSignature,
    ]);

    $pusher = new \Pusher\Pusher(
        env('PUSHER_APP_KEY'),
        env('PUSHER_APP_SECRET'),
        env('PUSHER_APP_ID'),
        ['cluster' => env('PUSHER_APP_CLUSTER')]
    );

    $auth = $pusher->authorizeChannel($channelName, $socketId);
    \Log::info('Pusher auth response: ' . json_encode($auth));

    return response()->json($auth);
}

}