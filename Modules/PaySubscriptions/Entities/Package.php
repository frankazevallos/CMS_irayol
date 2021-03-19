<?php

namespace Modules\PaySubscriptions\Entities;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'interval',
        'interval_count',
        'trial_days',
        'price',
        'sort_order',
        'is_active',
        'is_private',
        'is_one_time',
        'enable_custom_link',
        'custom_link',
        'custom_link_text',
    ];
}
