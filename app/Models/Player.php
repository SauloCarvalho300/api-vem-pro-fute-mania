<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'name', 'document', 'position', 'player_number', 'birthday', 'picture',
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class, 'player_game');
    }
}
