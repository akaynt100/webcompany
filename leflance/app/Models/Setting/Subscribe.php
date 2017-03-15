<?php

namespace App\Models\Setting;

use App\Traits\EloquentModelTrait;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use EloquentModelTrait;

    protected $table = 'user_subscriptions';

    protected $guarded = ['id'];

    public function getConfig(): Collection
    {
        return collect(config('leflance.subscribe'));
    }

    public function subscribe($data)
    {
        $userId = \Auth::user()->getAttribute('id');

        $events = array_except($data, ['_token', 'notify_via']);
        $config = $this->getConfig();

        $this->unsubscribe($userId);

        foreach ($events as $event => $value) {

            $eventSettings = $config->get($event);
            $eventId = SubscribeType::findBy('name', $event);

            if (!is_null($eventId)) {
                $userSubscribe = [
                    'user_id' => $userId,
                    'subscription_type_id' => $eventId,
                    'options' => ($eventSettings['is_empty']) ? null : json_encode([$eventSettings['key'] => $value])
                ];

                Subscribe::create(
                    $userSubscribe
                );
            }
        }

        return $this;
    }


    public function unsubscribe($userId = null)
    {
        $userId = !is_null($userId) ? $userId : \Auth::user()->getAttribute('id');
        Subscribe::where('user_id', $userId)->delete();

        return $this;
    }
}
