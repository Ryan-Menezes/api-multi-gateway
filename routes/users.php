<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

$roles = collect(config('roles.users'))->implode('|');

Route::group([
    'prefix' => '/users',
    'middleware' => ['auth:api', "roles:{$roles}"]
], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'delete']);
});
