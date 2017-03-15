<?php

namespace App\Models;

use App\User;
use App\Models\Order\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StatusTrait;

class ResponseToOrder extends Model
{
    use StatusTrait;
    use SoftDeletes;

    protected $table = 'responses_to_orders';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}