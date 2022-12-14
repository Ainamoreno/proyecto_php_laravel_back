<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $fillable = [
        'play_id',
        'name',
        'is_inside',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
