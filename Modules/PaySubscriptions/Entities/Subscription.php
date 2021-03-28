<?php

namespace Modules\PaySubscriptions\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'status',
        'start_date',
        'trial_end_date',
        'end_date',
        'created_id',
        'package_price',
        'package_details',
        'paid_via',
        'payment_transaction_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package() {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
