<?php

namespace App\Notifications;

use App\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;


class BaseUserNotification extends Notification implements ShouldQueue, ShouldBroadcast
{
    use Queueable;

    /**
     * @param $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast', 'database'];
    }

    /**
     * @return PrivateChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('base-user-notification');
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'base-user-notification';
    }
}