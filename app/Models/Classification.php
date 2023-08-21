<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $fillable = [
        'team_id', 'score', 'matches_played', 'wins', 'defeats', 'ties',
        'goals_conceded', 'goals_sum', 'championships_id', 'position',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function championship()
    {
        return $this->belongsTo(Championship::class);
    }
}
