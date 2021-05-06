<?php

namespace Modules\PaySubscriptions\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;

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

    protected static function newFactory()
    {
        return \Modules\PaySubscriptions\Database\Factories\PackageFactory::new();
    }
}
