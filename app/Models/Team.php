<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['title', 'picture'];

    public function coaches()
    {
        return $this->belongsToMany(Coach::class, 'coach_team');
    }

    public function games()
    {
        return $this->hasMany(Game::class, 'team_one_id');
    }

    public function gamesAsTeamTwo()
    {
        return $this->hasMany(Game::class, 'team_two_id');
    }

    public function classification()
    {
        return $this->hasOne(Classification::class);
    }
}
