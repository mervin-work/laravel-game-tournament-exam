<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['team_name','organization'];

    /**
     * The accessors to append to the model's array form
     * @var array
     */
    public function teamPlayers() {
        return $this->hasMany(TeamPlayer::class, 'team_code');
    }

    public function teamPoints() {
        return $this->hasMany(TeamPoint::class, 'team_code');
    }

}
