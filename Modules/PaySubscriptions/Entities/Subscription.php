<?php

namespace Modules\PaySubscriptions\Entities;

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
}
