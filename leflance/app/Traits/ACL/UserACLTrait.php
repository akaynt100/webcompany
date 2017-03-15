<?php

namespace App\Traits\ACL;

use App\Models\ACL\Role;

trait UserACLTrait
{
    /**
     * @return bool
     */
    public function accessToAccount(): bool
    {
        if ($this->isBanned()) {
            return false;
        }

        if (
            (int)\Request::route('user_id') === $this->getAttribute('id')
            ||
            $this->hasRole(Role::ADMIN_ROLE)
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasRole($key): bool
    {
        $hasRole = false;
        foreach ($this->roles as $role) {
            if ($role->name === $key) {
                $hasRole = true;
                break;
            }
        }
        return $hasRole;
    }

    /**
     * @return bool
     */
    public function isBanned(): bool
    {
        return $this->getAttribute('is_banned') ? true : false;
    }

    /**
     * @return bool
     */
    public function canCreateOrder(): bool
    {
        return true;
    }

    /**
     * @param $orderId
     * @return bool
     */
    public function canUpdateOrder($orderId): bool
    {
        $order = $this->orders()->find($orderId);

        return !is_null($order) && $order->status()->waiting();
    }

    /**
     * @param $orderId
     * @return bool
     */
    public function canDeleteOrder($orderId)
    {
        $order = $this->orders()->find($orderId);

        return !is_null($order) && !$order->status()->work();
    }

    /**
     * @param $orderId
     * @return bool
     */
    public function canCreateResponseToOrder($orderId): bool
    {
        $user = $this->load('orders.responses');

        $response = $user->responses->where('order_id', $orderId)->first();
        $order = $user->orders->find($orderId);

        return is_null($response) && is_null($order);
    }

    /**
     * @param $responseId
     * @return bool
     */
    public function canDeleteResponse($responseId): bool
    {
        $response = $this->responses()->findOrFail($responseId);

        return !$response->status()->work();
    }

}