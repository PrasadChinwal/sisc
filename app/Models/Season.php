<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    /** @use HasFactory<\Database\Factories\SeasonFactory> */
    use HasFactory;

    protected $guarded = [];

    public function players(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Player::class);
    }
}
