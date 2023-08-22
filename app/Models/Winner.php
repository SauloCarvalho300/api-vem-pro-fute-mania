<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $fillable = ['team_id', 'championship_id'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function championship()
    {
        return $this->belongsTo(Championship::class);
    }
}
