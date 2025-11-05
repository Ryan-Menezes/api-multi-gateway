<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

$roles = collect(config('roles.clients'))->implode('|');

Route::group([
    'prefix' => '/clients',
    'middleware' => ['auth:api', "roles:{$roles}"]
], function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::get('/{id}', [ClientController::class, 'show']);
});
