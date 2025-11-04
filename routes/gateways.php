<?php

use App\Http\Controllers\GatewayController;
use Illuminate\Support\Facades\Route;

$roles = collect(config('roles.gateways'))->implode('|');

Route::group([
    'prefix' => '/gateways',
    'middleware' => ['auth:api', "check-roles:{$roles}"]
], function () {
    Route::patch('/{id}/toggle-is-active', [GatewayController::class, 'toggleIsActive']);
    Route::patch('/{id}/update-priority', [GatewayController::class, 'updatePriority']);
});
