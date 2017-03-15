<?php

namespace App;


use App\Models\ACL\Role;
use App\Models\ACL\Permission;
use App\Models\Setting\Subscribe;
use App\Traits\ACL\UserACLTrait;
use App\Traits\ACL\ACLTrait;
use App\Models\Order\Order;
use App\Models\ResponseToOrder;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use ACLTrait;
    use UserACLTrait;
    use Notifiable;

    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(ResponseToOrder::class);
    }

    public function subscribe()
    {
        return $this->hasMany(Subscribe::class);
    }
}
