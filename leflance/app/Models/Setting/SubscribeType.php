<?php

namespace App\Models\Setting;

use App\Traits\EloquentModelTrait;
use Illuminate\Database\Eloquent\Model;

class SubscribeType extends Model
{
    use EloquentModelTrait;

    protected $table = 'subscription_types';

}
