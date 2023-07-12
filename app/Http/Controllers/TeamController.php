<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\TeamPoint;
use App\Http\Controllers\TeamPointController;
use CustomRequest;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{   

    protected $teamPoints;

    public function __construct(TeamPointController $teamPoints) {
        $this->teamPoints = $teamPoints;
    }

    public function addTeam(Request $request) {
        $validationMessage = CustomRequest::validateAddTeam($request);
        if($validationMessage['status'] == RESPONSE::HTTP_OK) {
    
            $team = Team::create([
                'team_name'    => $request->teamName,
                'organization' => $request->organization
            ]);

            //Create Team Point
            $teamPoints = TeamPoint::create([
                'team_code' => $team->id,
                'points'    => 0,
            ]);
            
            return ($team) ?  "Successfully Created" : "Something Went Wrong"; 
        } else {
            return response()->json($validationMessage['message']);
        }
    }

    public function viewTeams() {
        $team = Team::all();
        if($team) {
            return response()->json($team);
        } else {
            return "No Records";
        }
        
    }

    public function viewTeamById(Request $request, $teamCode = null) {
        $validationMessage = CustomRequest::validateViewByTeamCode($request->merge(['teamCode' => $teamCode]));
        if($validationMessage['status'] == RESPONSE::HTTP_OK) {
            $team = Team::find($teamCode);
            if($team) {
                return response()->json($team);
            } else {
                return "No Records";
            }
        } else {
            return response()->json($validationMessage['message']);
        }
    }

    public function viewTeamByTeamName(Request $request,$teamName = null) {
        $validationMessage = CustomRequest::validateViewByTeamName($request->merge(['teamName' => $teamName]));

        if($validationMessage['status'] == RESPONSE::HTTP_OK) {
            $ranks = Team::withSum('teamPoints as total_points','points')->orderBy('total_points', 'DESC')->get();
            $team = Team::where('team_name', $teamName)->withSum('teamPoints as total_points','points')->orderBy('total_points', 'DESC')->first();
            if($team) {
                $ranks->each(function($rank, $key) use($team) {

                    $key++;
                    if($rank['id'] == $team->id) {
                        $team->rank = $key;
                    }
                    
                });
               
                return response()->json($team);
            } else {
                return "No Records";
            }
            
        } else {
            return response()->json($validationMessage['message']);
        }
    }

    public function editTeam(Request $request, $teamCode = null) {
        $validationMessage = CustomRequest::validateEditTeam($request->merge(['teamCode' => $teamCode]));
        if($validationMessage['status'] == RESPONSE::HTTP_OK) {
            $team = Team::where('id', $teamCode)->update([
                'team_name' => $request->teamName,
                'organization' => $request->organization
            ]);

            if($team) {
                return "Successfully Edited";
            } else {
                return "Invalid Team code";
            }
            
        }  else {
            return response()->json($validationMessage['message']);
        }
    }

    public function deleteTeam(Request $request, $teamCode = null) {
        $validationMessage = CustomRequest::validateDeleteTeam($request->merge(['teamCode' => $teamCode]));
        if($validationMessage['status'] == RESPONSE::HTTP_OK) {
            $team = Team::where('id', $teamCode)->delete();
            return ($team) ? 'Successfully Deleted' : 'Invalid Team Code';
        } else {
            return response()->json($validationMessage['message']); 
        }
    }
 }
