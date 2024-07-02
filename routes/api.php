<?php

use App\Http\Controllers\PlayersController;
use App\Http\Controllers\TournamentController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->name('v1.')->middleware('url.param')->group(function(){
    Route::prefix('players')->group(function(){
        Route::patch('update/{id}', [PlayersController::class,"updatePartial"]);
    });

    Route::apiResource('players', PlayersController::class)->parameter('players', 'id');

    Route::resource('tournament', TournamentController::class)->parameter('tournament', 'id')->only(['index','show','store']);
});