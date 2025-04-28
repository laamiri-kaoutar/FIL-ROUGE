<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
       
    }

    public function broadcastOn()
    {
        Log::info("Broadcasting MessageSent event for conversation ID: " . $this->message->conversation->id . 
                  " to channels: private-chat." . $this->message->conversation->client_id . 
                  " and private-chat." . $this->message->conversation->freelancer_id);

        // return [
        //     new PrivateChannel('chat.' . $this->message->conversation->client_id),
        //     new PrivateChannel('chat.' . $this->message->conversation->freelancer_id),
        // ];
        return [
            new Channel('public-chat.' . $this->message->conversation->client_id),
            new Channel('public-chat.' . $this->message->conversation->freelancer_id),
        ];
    }

    public function broadcastWith()
    {
        return [
            'message' => [
                'id' => $this->message->id,
                'content' => $this->message->content,
                'sender_id' => $this->message->sender_id,
                'sender' => [
                    'name' => $this->message->sender->name,
                ],
                'conversation_id' => $this->message->conversation_id,
                'created_at' => $this->message->created_at->toDateTimeString(),
            ],
        ];
    }

    public function broadcastAs()
    {
        return 'MessageSent';
    }
}