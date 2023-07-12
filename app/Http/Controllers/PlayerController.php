<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamPlayer;
use CustomRequest;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends Controller
{   


    public function addPlayer(Request $request) {
        $validationMessage = CustomRequest::validateAddPlayer($request);
        if($validationMessage['status'] == RESPONSE::HTTP_OK) {

            $player = TeamPlayer::create([
                'team_code' => $request->teamCode,
                'firstname' => $request->firstname,
                'lastname'  => $request->lastname,
                'username'  => $request->username,
                'email'     => $request->email,
                'role'      => $this->getRoleId($request->role),
            ]);

            return ($player) ?  "Successfully Created" : "Something Went Wrong";
        } else {
            return response()->json($validationMessage['message']);
        }
    }

    public function viewPlayers() {
        $player = TeamPlayer::all();
    
        if($player) {
            return response()->json($player);
        } else {
            return "No Record";
        }
    }

    public function viewPlayerByTeamCode(Request $request, $teamCode = null) {
        $validationMessage = CustomRequest::validateviewPlayerByTeamCode($request->merge(['teamCode' => $teamCode]));
        if($validationMessage['status'] == RESPONSE::HTTP_OK) {
            $player = TeamPlayer::where('team_code' , $teamCode)->get();
            return response()->json($player);
        } else {
            return response()->json($validationMessage['message']);
        }
    }

    public function viewPlayerById(Request $request, $playerId = null) {
        $validationMessage = CustomRequest::validateviewPlayerById($request->merge(['playerId' => $playerId]));
        if($validationMessage['status'] == RESPONSE::HTTP_OK) {
            $player = TeamPlayer::find($playerId);
            if($player) {
                return response()->json($player);
            } else {
                return "No Record";
            }
        } else {
            return response()->json($validationMessage['message']);
        }
    }

    public function searchPlayer(Request $request) {
        $player = TeamPlayer::searchFirstname($request->firstname)
                ->searchLastname($request->lastname)
                ->searchUsername($request->username)
                ->get();
        
        if($player) {
            return response()->json($player);
        } else {
            return "No Record";
        }
    }

    public function editPlayer(Request $request, $playerId = null) {
        $validationMessage = CustomRequest::validateEditPlayer($request->merge(['playerId' => $playerId]));
        if($validationMessage['status'] == RESPONSE::HTTP_OK) {
            $player = TeamPlayer::where('id', $playerId)->update([
                'team_code'    => $request->teamCode,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'username' => $request->username,
                'email' => $request->email,
                'role' => $this->getRoleId($request->role),
            ]);

            return "Successfully Edited";
        }
        else {
            return response()->json($validationMessage['message']);
        }
    }

    public function deletePlayer(Request $request, $playerId = null) {
        $validationMessage = CustomRequest::validateDeletePlayer($request->merge(['playerId' => $playerId]));
        if($validationMessage['status'] == RESPONSE::HTTP_OK) {
            $player = TeamPlayer::findOrFail($playerId)->delete();
            return ($player) ? 'Successfully Deleted' : 'Something Went Wrong';
        }
        else {
            return response()->json($validationMessage['message']);
        }
    }
    //Temporary - Out of Time :D
    public function getRoleId($role) {
        switch($role) {
            case 'Jungler' :
                return 1;
            break;
            case 'Tank' :
                return 2;
            break;
            case 'Midlane' :
                return 3;
            break;
            case 'Turtle Lane' :
                return 4;
            break;
            case 'Non-Turtle Lane' :
                return 5;
            break;
            default: 
            
            return 0;
        }
    }

 }
