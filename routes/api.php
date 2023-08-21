<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['jwt.auth']], function () {
    // Protected routes here:
    Route::post('/login', 'AuthController@login');

    Route::post('/trainers/register', 'TrainerController@register');
    Route::put('/trainers/{trainer}', 'TrainerController@update');
    Route::get('/trainers/{trainer}', 'TrainerController@show');
    Route::delete('/trainers/{trainer}', 'TrainerController@destroy');

    Route::post('/heroes', 'HeroController@create');
    Route::put('/heroes/{hero}', 'HeroController@assignToTrainer');
    Route::put('/heroes/{hero}', 'HeroController@update');
    Route::get('/heroes/{hero}', 'HeroController@show');
    Route::get('/trainers/{trainer}/heroes', 'HeroController@getAllByTrainer');
    Route::delete('/heroes/{hero}', 'HeroController@unassignFromTrainer');

});
