<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgrammerController;
use App\Http\Controllers\ProjectController;

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

/****************************
    Programmers 
*****************************/

// assign project to programmer
Route::post('programmers/{id}/assign-project/{projectId}', [ProgrammerController::class, 'assignProject']);

// remove project from programmer
Route::post('programmers/{id}/remove-project/{projectId}', [ProgrammerController::class, 'removeProject']);

// api resource
Route::apiResource('programmers', ProgrammerController::class);


/****************************
    Projects
*****************************/
// api resource
Route::apiResource('projects', ProjectController::class);