<?php

namespace App\Models\Order;

use App\Models\EducationInstitution;
use App\Models\Faculty;
use App\Models\ResponseToOrder;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Order\File as OrderFile;

class Order extends Model
{
    use StatusTrait;
    use SoftDeletes;

    protected $table = 'orders';

    protected $guarded = ['id'];

    /**
     * Relations
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'order_type_id');
    }

    public function file()
    {
        return $this->hasMany(OrderFile::class);
    }

    public function responses()
    {
        return $this->hasMany(ResponseToOrder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function educational()
    {
        return $this->belongsTo(EducationInstitution::class, 'educational_institution_id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }


    /**
     * Model
     */
    public function allowed(): Collection
    {
        return (Order::all())
            ->where('is_banned', false)
            ->where('status_id', $this->getStatusWaiting()->get('id'));
    }

    public function custom(): Collection
    {
        return $this->where('user_id', \Auth::user()->id)->get();
    }

    public function getFile($orderId, $fileId)
    {
        return (new OrderFile)->getFile($orderId, $fileId);
    }
}
