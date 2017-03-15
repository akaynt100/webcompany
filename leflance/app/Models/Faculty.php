<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EloquentModelTrait;

class Faculty extends Model
{

    use EloquentModelTrait;

    protected $table = 'faculties';

    protected $guarded = ['id'];
}
