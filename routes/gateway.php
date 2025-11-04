<?php

use App\Http\Controllers\GatewayController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/gateways',
    'middleware' => ['auth:api', 'can:USER']
], function () {
    Route::patch('/{id}/toggle-is-active', [GatewayController::class, 'toggleIsActive']);
    Route::patch('/{id}/update-priority', [GatewayController::class, 'updatePriority']);
});
