<?php
namespace App\Http\Requests\Custom;
use Validator;
use Symfony\Component\HttpFoundation\Response;

class CustomRequest {
    
    public static function validateAddTeam($request) {
        $team = Validator::make($request->all(), [
            'teamName' => 'required',
            'organization' => 'required'
        ]);

        if ($team->fails()){
            return ['status' => RESPONSE::HTTP_NO_CONTENT , 'message' => $team->errors()->all()];
        }
        else { return ['status' => RESPONSE::HTTP_OK]; }
    }

    public static function validateViewByTeamCode($request) {
        $team = Validator::make($request->all(), [
            'teamCode' => 'required|integer',
        ]);

        if ($team->fails()){
            return ['status' => RESPONSE::HTTP_NO_CONTENT , 'message' => $team->errors()->all()];
        }
        else { return ['status' => RESPONSE::HTTP_OK]; }
    }

    public static function validateViewByTeamName($request) {
        $team = Validator::make($request->all(), [
            'teamName' => 'required',
        ]);

        if ($team->fails()){
            return ['status' => RESPONSE::HTTP_NO_CONTENT , 'message' => $team->errors()->all()];
        }
        else { return ['status' => RESPONSE::HTTP_OK]; }
    }

    public static function validateEditTeam($request) {
        $team = Validator::make($request->all(), [
            'teamCode' => 'required|integer',
            'teamName' => 'required',
            'organization' => 'required'
        ]);

        if ($team->fails()){
            return ['status' => RESPONSE::HTTP_NO_CONTENT , 'message' => $team->errors()->all()];
        }
        else { return ['status' => RESPONSE::HTTP_OK]; }
    }

    public static function validateDeleteTeam($request) {
        $team = Validator::make($request->all(), [
            'teamCode' => 'required|integer',
        ]);

        if ($team->fails()){
            return ['status' => RESPONSE::HTTP_NO_CONTENT , 'message' => $team->errors()->all()];
        }
        else { return ['status' => RESPONSE::HTTP_OK]; }
    }

    public static function validateAddPlayer($request) {
        $team = Validator::make($request->all(), [
            'teamCode'  => 'required|integer',
            'firstname' => 'required',
            'lastname'  => 'required',
            'username'  => 'required',
            'email'     => 'required',
            'role'      => 'required',
        ]);

        if ($team->fails()){
            return ['status' => RESPONSE::HTTP_NO_CONTENT , 'message' => $team->errors()->all()];
        }
        else { return ['status' => RESPONSE::HTTP_OK]; }
    }

    public static function validateviewPlayerByTeamCode($request) {
        $team = Validator::make($request->all(), [
            'teamCode' => 'required|integer',
        ]);

        if ($team->fails()){
            return ['status' => RESPONSE::HTTP_NO_CONTENT , 'message' => $team->errors()->all()];
        }
        else { return ['status' => RESPONSE::HTTP_OK]; }
    }

    public static function validateviewPlayerById($request) {
        $team = Validator::make($request->all(), [
            'playerId' => 'required|integer',
        ]);

        if ($team->fails()){
            return ['status' => RESPONSE::HTTP_NO_CONTENT , 'message' => $team->errors()->all()];
        }
        else { return ['status' => RESPONSE::HTTP_OK]; }
    }

    public static function validateEditPlayer($request) {
        $team = Validator::make($request->all(), [
            'playerId'  => 'required|integer',
            'teamCode'  => 'required|integer',
            'firstname' => 'required',
            'lastname'  => 'required',
            'username'  => 'required',
            'email'     => 'required',
            'role'      => 'required',
        ]);

        if ($team->fails()){
            return ['status' => RESPONSE::HTTP_NO_CONTENT , 'message' => $team->errors()->all()];
        }
        else { return ['status' => RESPONSE::HTTP_OK]; }
    }

    public static function validateDeletePlayer($request) {
        $team = Validator::make($request->all(), [
            'playerId' => 'required|integer',
        ]);

        if ($team->fails()){
            return ['status' => RESPONSE::HTTP_NO_CONTENT , 'message' => $team->errors()->all()];
        }
        else { return ['status' => RESPONSE::HTTP_OK]; }
    }

    public static function validateTeamPoints($request) {
        $team = Validator::make($request->all(), [
            'teamCode' => 'required|integer',
            'points'   => 'integer'
        ]);

        if ($team->fails()){
            return ['status' => RESPONSE::HTTP_NO_CONTENT , 'message' => $team->errors()->all()];
        }
        else { return ['status' => RESPONSE::HTTP_OK]; }
    }
}
