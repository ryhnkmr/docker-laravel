<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function characters() {
        return $this->belogsToMasy('App\Models\Character');
    }
}
