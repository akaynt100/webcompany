<?php

namespace App\Providers;

use App\Exceptions\PermissionDeniedException;
use App\Models\ACL\Role;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ACLServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //Enter your gates rule

        //
        Gate::define('account.access', function (User $user) {
            return $user->accessToAccount();
        });


        /**
         * Orders
         */
        Gate::define('order.create', function (User $user) {
            return $user->canCreateOrder();
        });

        Gate::define('order.update', function (User $user, $orderId) {
            return $user->canUpdateOrder($orderId);
        });

        Gate::define('order.delete', function (User $user, $orderId) {
            return $user->canDeleteOrder($orderId);
        });

        Gate::define('order.file.download', function (User $user) {
            return true;
        });


        /**
         * Responses to order
         */
        Gate::define('response-to-order.create', function (User $user, $orderId) {
            return $user->canCreateResponseToOrder($orderId);
        });

        Gate::define('response-to-order.delete', function (User $user, $responseId) {
            return $user->canDeleteResponse($responseId);
        });


        Gate::define('review.create', function (User $user, $orderId, $responseId) {
            return true;
        });


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
