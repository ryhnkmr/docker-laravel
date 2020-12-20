<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'hp',
        'ap',
        'dp',
        'exp',
        'lv',
        'thumnailURL',
        'pictoURL'
    ];

    public function user()
    { 
        return $this->belongsTo('App\Models\User');
    }

    public function teams() {
        return $this->belogsToMasy('App\Models\Team');
    }
}
