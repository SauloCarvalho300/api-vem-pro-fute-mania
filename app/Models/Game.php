<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'team_one_id', 'team_two_id', 'score_team_one', 'score_team_two',
        'championships_id', 'referees_id', 'stadiums_id',
    ];

    public function teamOne()
    {
        return $this->belongsTo(Team::class, 'team_one_id');
    }

    public function teamTwo()
    {
        return $this->belongsTo(Team::class, 'team_two_id');
    }

    public function championship()
    {
        return $this->belongsTo(Championship::class, 'championships_id');
    }

    public function referee()
    {
        return $this->belongsTo(Referee::class, 'referees_id');
    }

    public function stadium()
    {
        return $this->belongsTo(Stadium::class, 'stadiums_id');
    }

    public function players()
    {
        return $this->belongsToMany(Player::class, 'player_game');
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
