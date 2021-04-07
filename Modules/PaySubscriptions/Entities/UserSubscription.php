<?php

namespace Modules\PaySubscriptions\Entities;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    protected $table = 'users';

    public function subscription()
    {
        return $this->hasMany(Subscription::class, 'user_id', 'id');
    }

    public function subscribed()
    {
        dd($this->subscription()->end_date);

        if (is_null($this->subscription()->end_date)) {
            return false;
        }

        return $this->subscription()->end_date->isFuture();
    }

    public function onTrial()
    {
        if (is_null($this->subscription()->trial_end_date)) {
            return false;
        }

        return $this->subscription()->trial_end_date->isFuture();
    }
}
