<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EloquentModelTrait;
class City extends Model
{
    use EloquentModelTrait;

    protected $table = 'cities';

    protected $guarded = ['id'];

}
