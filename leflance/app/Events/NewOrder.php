<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewOrder implements ShouldBroadcast, ShouldQueue
{
    use InteractsWithSockets, SerializesModels;

    public $data;

    public function __construct()
    {
        $this->data = [
            'notification' => 'Some message 22',
            'date' => '01 мая 2016'
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('notification-channel');
    }

    public function broadcastAs()
    {
        return 'new-order';
    }

    public function via()
    {
        return ['broadcast'];
    }
}
