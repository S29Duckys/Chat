<?php

// app/Events/MessageSent.php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly string $message,
        public readonly string $senderId,
        public readonly string $receiverId,
        public readonly string $time,
    ) {}

    public function broadcastOn(): array
    {
        $ids = [$this->senderId, $this->receiverId];
        sort($ids);
        $channel = 'chat.' . implode('.', $ids);

        return [new Channel($channel)];
    }

    public function broadcastAs(): string
    {
        return 'MessageSent';
    }
}