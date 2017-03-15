<?php

namespace App\Models\ACL;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EloquentModelTrait;

class Role extends Model
{
    use EloquentModelTrait;

    const USER_ROLE = 'user';
    const ADMIN_ROLE = 'admin';

    public function getUserRole()
    {
        return $this->where('name', self::USER_ROLE)->first();
    }

}
