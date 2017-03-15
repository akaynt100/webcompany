<?php

namespace App\Repositories;

use App\Repositories\Contracts\IUserRepository;
use App\User;

class UserRepository implements IUserRepository
{
    protected $instance;
    protected $authUser;

    public function __construct(User $instance)
    {
        $this->instance = $instance;
        $this->authUser = $this->getInstance()->findOrFail(\Auth::user()->id);
    }

    public function getInstance()
    {
        return $this->instance;
    }

    public function getAuthUser()
    {
        return $this->authUser;
    }

    public function hasRole($roleName): bool
    {
        $hasRole = false;
        foreach ($this->getAuthUser()->roles as $role) {
            if ($role->name === $roleName) {
                $hasRole = true;
                break;
            }
        }
        return $hasRole;
    }

    public function getCountOrders(): int
    {
        return $this->getAuthUser()->orders->count();
    }

    public function getCountCompletedDeals(): int
    {
        //Cnt deals where status_id = complete
        return rand(1, 25);
    }

    public function getFullName(): string
    {
        return $this->getAuthUser()->full_name;
    }

    public function getCountReviews(): int
    {
        return rand(1, 25);
    }

    public function getCountViews(): int
    {
        return rand(1, 25);
    }

    public function createdAt()
    {
        return \DateTimeHelper::parseDate($this->getAuthUser()->created_at, 'j F Y');
    }

}