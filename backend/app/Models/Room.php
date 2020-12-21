<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'betting_flg',
        'active_flg',
        'name',
        'secret_flg',
        'password'
    ];

    public function users()
    { 
        return $this->belongsToMany('App\Models\User');
    }
}
