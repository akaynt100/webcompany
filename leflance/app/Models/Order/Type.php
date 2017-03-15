<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EloquentModelTrait;

class Type extends Model
{
    use EloquentModelTrait;

    protected $table = 'order_types';

}