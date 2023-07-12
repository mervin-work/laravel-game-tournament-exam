<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamPoint extends Model
{
    use HasFactory;

    protected $fillable = ['team_code','points'];

    /**
     * The accessors to append to the model's array form
     * @var array
     */
    public function team() {
        return $this->belongsTo(Team::class,'team_code');
    }
}
