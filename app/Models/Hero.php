<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = ['name', 'ability', 'trainer_id', 'started_training', 'suit_colors', 'starting_power', 'current_power'];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}
