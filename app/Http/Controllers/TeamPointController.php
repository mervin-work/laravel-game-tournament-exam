<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamPoint;
use App\Models\Team;
use CustomRequest;
use Symfony\Component\HttpFoundation\Response;
class TeamPointController extends Controller
{   


    public function addTeamPoints(Request $request) {
        $validationMessage = CustomRequest::validateTeamPoints($request);
        if($validationMessage['status'] == RESPONSE::HTTP_OK) {

            $team = TeamPoint::create([
                'team_code' => $request->teamCode,
                'points'    => $request->points,
            ]);

            return "Successfully Added";
        } else {
            return response()->json($validationMessage['message']);
        }
    }

    public function editTeamPoints($teamCode, Request $request) {

        $team = TeamPoint::where('team_code', $teamCode)->update([
            'points' => $request->points
        ]);

        return "Successfully Edited";
    }

    public function viewTeamPoints() {

        $teams = Team::withSum('teamPoints as total_points','points')->orderBy('total_points', 'DESC')->get();
        if($teams) {
            $teams->each(function($team, $key) {
                $key++;
                $team->rank = $key;
            });
    
            return response()->json($teams);
        } else {
            return "No Records";
        }
        
    }
 }
