<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mobile',
        'gender',
        'date_of_birth',
        'url_website',
        'url_facebook',
        'url_twitter',
        'url_instagram',
        'url_linkedin',
        'url_github',
        'country',
        'state',
        'city',
        'avatar'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
