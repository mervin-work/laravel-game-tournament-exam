<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamPlayer extends Model
{
    use HasFactory;

    protected $fillable = ['team_code','firstname', 'lastname', 'email', 'username', 'role'];

    /**
     * Append full name
     * @var array
     */
    protected $appends = ['role_name'];

    /**
     * The accessors to append to the model's array form
     * @var array
     */
    public function team() {
        return $this->belongsTo(Team::class,'team_code');
    }

    /**SCOPES**/
    public function scopeSearchFirstname($query, $firstname) {
        if($firstname) $query->where('firstname','LIKE', '%'.$firstname.'%');
    }

    public function scopeSearchLastname($query, $lastname) {
        if($lastname) $query->where('lastname','LIKE', '%'.$lastname.'%');
    }

    public function scopeSearchUsername($query, $username) {
        if($username) $query->where('username','LIKE', '%'.$username.'%');
    }

    //Accessor
     /**
     * Get the user's full address
     * 
     * @return string
     * 
     */
    public function getRoleNameAttribute() {
        return "{$this->getRoleName($this->role)}";
    }

    //Tempory - Out of Time na
    public function getRoleName($role) {
        switch($role) {
            case 1 :
                return 'Jungler';
            break;
            case 2 :
                return 'Tank';
            break;
            case 3 :
                return 'Midlane';
            break;
            case 4 :
                return 'Turtle Lane';
            break;
            case 5 :
                return 'Non-Turtle Lane';
            break;
            default: 
            return "NO ROLE";
        }
    }
}
