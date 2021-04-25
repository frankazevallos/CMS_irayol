<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the blogs for this model.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function blogs()
    {
        return $this->hasMany('App\Models\Blog', 'user_id', 'id');
    }

    /**
     * Get the media for this model.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function media()
    {
        return $this->hasMany('App\Models\Medium', 'user_id', 'id');
    }

    /**
     * Get the pages for this model.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function pages()
    {
        return $this->hasMany('App\Models\Page', 'user_id', 'id');
    }

    /**
     * Set the email_verified_at.
     *
     * @param  string  $value
     * @return void
     */
    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = !empty($value) ? \DateTime::createFromFormat('[% date_format %]', $value) : null;
    }

    /**
     * Get email_verified_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getEmailVerifiedAtAttribute($value)
    {
        if ($value !== null) {
            return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('Y-m-d h:i:s');
        } else {
            return '';
        }
    }

    public function page()
    {
        return $this->hasMany('App\Models\Page');
    }

    public function blog()
    {
        return $this->hasMany('App\Models\Blog');
    }

    public function profile(){
        return $this->hasOne(UserProfile::class);
    }

    public function userProfile(){
        return $this->hasOne(UserProfile::class);
    }
}
