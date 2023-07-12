<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamPointController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/team/register', [TeamController::class, 'addTeam']);
Route::get('/team/{teamCode?}', [TeamController::class, 'viewTeamById']);
Route::get('/teams', [TeamController::class, 'viewTeams']);

Route::put('/team/edit/{teamCode?}', [TeamController::class, 'editTeam']);
Route::delete('/team/{teamCode?}', [TeamController::class, 'deleteTeam']);
Route::get('/search/team/{teamName?}' , [TeamController::class, 'viewTeamByTeamName']);

Route::post('/player/register', [PlayerController::class, 'addPlayer']);
Route::get('/player/{playerId?}', [PlayerController::class, 'viewPlayerById']);
Route::get('/team/player/{teamCode?}', [PlayerController::class, 'viewPlayerByTeamCode']);
Route::get('/players', [PlayerController::class, 'viewPlayers']);
Route::put('/player/edit/{playerId?}', [PlayerController::class, 'editPlayer']);
Route::delete('/player/{playerId?}', [PlayerController::class, 'deletePlayer']);
Route::get('/search/player', [PlayerController::class, 'searchPlayer']);

Route::post('/team/add-points', [TeamPointController::class, 'addTeamPoints']);

Route::get('/team/points/ranking', [TeamPointController::class, 'viewTeamPoints']);