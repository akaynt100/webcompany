<?php

namespace App\Notifications;



class CreateOrder extends BaseUserNotification
{
    /**
     * @param $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'token' => csrf_token(),
            'amount' => 'gg',
        ];
    }


}
