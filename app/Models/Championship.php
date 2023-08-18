<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Championship extends Model
{
    protected $fillable = ['title', 'year', 'position', 'award_id', 'regulation_id'];

    public function award()
    {
        return $this->belongsTo(Award::class);
    }

    public function regulation()
    {
        return $this->belongsTo(Regulation::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class, 'championships_id');
    }

    public function classification()
    {
        return $this->hasMany(Classification::class);
    }
}
