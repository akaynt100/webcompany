<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EloquentModelTrait;

class EducationInstitution extends Model
{
    use EloquentModelTrait;

    protected $table = 'educational_institutions';

    protected $guarded = ['id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
