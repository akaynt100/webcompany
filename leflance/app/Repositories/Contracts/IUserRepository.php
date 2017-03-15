<?php

namespace App\Repositories\Contracts;


interface IUserRepository
{
    public function getAuthUser();

    public function hasRole($roleName): bool;

    public function getFullName(): string;

    public function getCountOrders(): int;

    public function getCountCompletedDeals(): int;

    public function getCountReviews(): int;

    public function getCountViews(): int;

    public function createdAt();
}