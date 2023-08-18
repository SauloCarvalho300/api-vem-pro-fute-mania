<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $fillable = ['name', 'document', 'picture'];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'coach_team');
    }
}
