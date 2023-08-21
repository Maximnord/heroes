<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'email',
        'password',
        'full_name'
    ];

    public function heroes()
    {
        return $this->hasMany(Hero::class);
    }
}
