<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerSeason extends Model
{
    /** @use HasFactory<\Database\Factories\PlayerSeasonFactory> */
    use HasFactory;

    protected $table = 'player_season';
}
