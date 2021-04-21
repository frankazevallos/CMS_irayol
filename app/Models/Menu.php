<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table='menu';
    
    protected $fillable = [
        'title',
    ];

    public function menu_items()
    {
        return $this->hasMany(MenuItem::class);
    }
}
