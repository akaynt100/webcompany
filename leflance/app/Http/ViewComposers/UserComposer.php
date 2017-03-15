<?php

namespace App\Http\ViewComposers;

use App\Repositories\Contracts\IUserRepository;
use Illuminate\View\View;

class UserComposer
{
    protected $userRepo;

    public function __construct(IUserRepository $user)
    {
        $this->userRepo = $user;
    }

    public function compose(View $view)
    {
        $view->with('fullName', $this->userRepo->getFullName());
        $view->with('cntOrders', $this->userRepo->getCountOrders());
        $view->with('cntDeals', $this->userRepo->getCountCompletedDeals());
        $view->with('cntReviews', $this->userRepo->getCountReviews());
        $view->with('cntViews', $this->userRepo->getCountViews());
        $view->with('createdAt', $this->userRepo->createdAt());
    }
}