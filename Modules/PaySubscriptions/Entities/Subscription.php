<?php

namespace Modules\PaySubscriptions\Entities;

use App\Models\User;
use Carbon\Carbon;
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

    public function subscribed($user_id)
    {
        $subscription_end = $this->where('user_id', $user_id)->latest('end_date')->first();

        if (is_null($subscription_end)) {
            return false;
        }

        return Carbon::parse($subscription_end->end_date)->isFuture();
    }

    public function onTrial($user_id)
    {
        $subscription_trial = $this->where('user_id', $user_id)->latest('trial_end_date')->first();
        if (is_null($subscription_trial)) {
            return false;
        }

        return Carbon::parse($subscription_trial->trial_end_date)->isFuture();
    }
}
